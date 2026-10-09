<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreDonationRequest;
use App\Http\Requests\Api\UpdateDonationRequest;
use App\Http\Resources\DonationResource;
use App\Models\Donation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonationApiController extends Controller
{
    /**
     * GET /api/donations (Index with Pagination, Search, Filter)
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $query = $user->role === 'admin'
            ? Donation::with(['user', 'dropPoint', 'distribution'])->latest()
            : $user->donations()->with(['dropPoint', 'distribution'])->latest();

        // Search by tracking code, donor name, clothing type
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('tracking_code', 'like', "%{$search}%")
                    ->orWhere('donor_name', 'like', "%{$search}%")
                    ->orWhere('clothing_type', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        $donations = $query->paginate(10);

        return response()->json([
            'status' => true,
            'message' => 'Daftar donasi berhasil diambil.',
            'data' => DonationResource::collection($donations),
            'pagination' => [
                'current_page' => $donations->currentPage(),
                'last_page' => $donations->lastPage(),
                'per_page' => $donations->perPage(),
                'total' => $donations->total(),
            ],
        ], 200);
    }

    /**
     * POST /api/donations (Create data with Form Request)
     */
    public function store(StoreDonationRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('donations', 'public');
        }

        $donation = $request->user()->donations()->create([
            'drop_point_id' => $validated['drop_point_id'] ?? null,
            'tracking_code' => Donation::generateTrackingCode(),
            'donor_name' => $validated['donor_name'],
            'donor_phone' => $validated['donor_phone'],
            'clothing_type' => $validated['clothing_type'],
            'quantity' => $validated['quantity'],
            'condition' => $validated['condition'],
            'delivery_method' => $validated['delivery_method'],
            'photo' => $photoPath,
            'status' => 'menunggu',
            'notes' => $validated['notes'] ?? null,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Donasi berhasil diajukan.',
            'data' => new DonationResource($donation->load(['user', 'dropPoint'])),
        ], 201);
    }

    /**
     * GET /api/donations/{id} (Detail)
     */
    public function show(Request $request, Donation $donation): JsonResponse
    {
        $user = $request->user();

        if ($user->role !== 'admin' && $donation->user_id !== $user->id) {
            return response()->json([
                'status' => false,
                'message' => 'Akses ditolak. Anda tidak berhak melihat donasi ini.',
            ], 403);
        }

        return response()->json([
            'status' => true,
            'message' => 'Detail donasi berhasil diambil.',
            'data' => new DonationResource($donation->load(['user', 'dropPoint', 'distribution'])),
        ], 200);
    }

    /**
     * PUT/PATCH /api/donations/{id} (Update data with Form Request)
     */
    public function update(UpdateDonationRequest $request, Donation $donation): JsonResponse
    {
        $user = $request->user();

        if ($user->role !== 'admin' && $donation->user_id !== $user->id) {
            return response()->json([
                'status' => false,
                'message' => 'Akses ditolak.',
            ], 403);
        }

        if ($donation->status !== 'menunggu' && $user->role !== 'admin') {
            return response()->json([
                'status' => false,
                'message' => 'Donasi yang telah diproses tidak dapat diubah.',
            ], 422);
        }

        $validated = $request->validated();

        if ($request->hasFile('photo')) {
            if ($donation->photo && Storage::disk('public')->exists($donation->photo)) {
                Storage::disk('public')->delete($donation->photo);
            }
            $validated['photo'] = $request->file('photo')->store('donations', 'public');
        }

        $donation->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Data donasi berhasil diperbarui.',
            'data' => new DonationResource($donation->fresh(['user', 'dropPoint'])),
        ], 200);
    }

    /**
     * DELETE /api/donations/{id} (Delete / Cancel data)
     */
    public function destroy(Request $request, Donation $donation): JsonResponse
    {
        $user = $request->user();

        if ($user->role !== 'admin' && $donation->user_id !== $user->id) {
            return response()->json([
                'status' => false,
                'message' => 'Akses ditolak.',
            ], 403);
        }

        if ($donation->status !== 'menunggu' && $user->role !== 'admin') {
            return response()->json([
                'status' => false,
                'message' => 'Donasi yang sudah diproses tidak dapat dibatalkan.',
            ], 422);
        }

        if ($donation->photo && Storage::disk('public')->exists($donation->photo)) {
            Storage::disk('public')->delete($donation->photo);
        }

        $donation->delete();

        return response()->json([
            'status' => true,
            'message' => 'Donasi berhasil dibatalkan dan dihapus.',
        ], 200);
    }

    /**
     * PATCH /api/donations/{id}/status (Admin Only)
     */
    public function updateStatus(Request $request, Donation $donation): JsonResponse
    {
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'status' => false,
                'message' => 'Akses khusus Administrator.',
            ], 403);
        }

        $validated = $request->validate([
            'status' => ['required', 'in:menunggu,diverifikasi,diterima,disalurkan,dibatalkan'],
            'admin_notes' => ['nullable', 'string', 'max:500'],
        ]);

        $donation->status = $validated['status'];
        if (!empty($validated['admin_notes'])) {
            $donation->notes = ($donation->notes ? $donation->notes . "\n" : '') .
                "[Admin " . now()->format('d/m/Y H:i') . "]: " . $validated['admin_notes'];
        }
        $donation->save();

        return response()->json([
            'status' => true,
            'message' => "Status donasi berhasil diubah menjadi {$donation->status_label}.",
            'data' => new DonationResource($donation->fresh(['user', 'dropPoint'])),
        ], 200);
    }

    /**
     * GET /api/tracking/{code} (Public tracking endpoint)
     */
    public function track(string $code): JsonResponse
    {
        $donation = Donation::with(['dropPoint', 'distribution'])
            ->where('tracking_code', trim($code))
            ->first();

        if (! $donation) {
            return response()->json([
                'status' => false,
                'message' => 'Kode tracking tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data pelacakan ditemukan.',
            'data' => new DonationResource($donation),
        ], 200);
    }
}
