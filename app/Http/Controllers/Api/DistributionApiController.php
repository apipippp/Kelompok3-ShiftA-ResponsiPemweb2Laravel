<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DistributionResource;
use App\Models\Distribution;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DistributionApiController extends Controller
{
    /**
     * GET /api/distributions (Public list of distribution reports)
     */
    public function index(): JsonResponse
    {
        $distributions = Distribution::with('donation')
            ->latest('distribution_date')
            ->paginate(15);

        return response()->json([
            'status' => true,
            'message' => 'Laporan penyaluran berhasil diambil.',
            'data' => DistributionResource::collection($distributions),
            'pagination' => [
                'current_page' => $distributions->currentPage(),
                'last_page' => $distributions->lastPage(),
                'per_page' => $distributions->perPage(),
                'total' => $distributions->total(),
            ],
        ], 200);
    }

    /**
     * GET /api/distributions/{id}
     */
    public function show(Distribution $distribution): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => 'Detail laporan penyaluran berhasil diambil.',
            'data' => new DistributionResource($distribution->load('donation')),
        ], 200);
    }

    /**
     * POST /api/distributions (Admin only)
     */
    public function store(Request $request): JsonResponse
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['status' => false, 'message' => 'Akses khusus Admin.'], 403);
        }

        $validated = $request->validate([
            'donation_id' => 'nullable|exists:donations,id|unique:distributions,donation_id',
            'recipient_name' => 'required|string|max:255',
            'distribution_date' => 'required|date',
            'items_count' => 'required|integer|min:1',
            'proof_photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'description' => 'required|string',
        ]);

        if ($request->hasFile('proof_photo')) {
            $validated['proof_photo'] = $request->file('proof_photo')->store('distributions', 'public');
        }

        $distribution = Distribution::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Data penyaluran berhasil dicatat.',
            'data' => new DistributionResource($distribution),
        ], 201);
    }

    /**
     * PUT/PATCH /api/distributions/{id} (Admin only)
     */
    public function update(Request $request, Distribution $distribution): JsonResponse
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['status' => false, 'message' => 'Akses khusus Admin.'], 403);
        }

        $validated = $request->validate([
            'donation_id' => 'nullable|exists:donations,id|unique:distributions,donation_id,' . $distribution->id,
            'recipient_name' => 'sometimes|required|string|max:255',
            'distribution_date' => 'sometimes|required|date',
            'items_count' => 'sometimes|required|integer|min:1',
            'proof_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'description' => 'sometimes|required|string',
        ]);

        if ($request->hasFile('proof_photo')) {
            if ($distribution->proof_photo && Storage::disk('public')->exists($distribution->proof_photo)) {
                Storage::disk('public')->delete($distribution->proof_photo);
            }
            $validated['proof_photo'] = $request->file('proof_photo')->store('distributions', 'public');
        }

        $distribution->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Data penyaluran berhasil diperbarui.',
            'data' => new DistributionResource($distribution),
        ], 200);
    }

    /**
     * DELETE /api/distributions/{id} (Admin only)
     */
    public function destroy(Request $request, Distribution $distribution): JsonResponse
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['status' => false, 'message' => 'Akses khusus Admin.'], 403);
        }

        if ($distribution->proof_photo && Storage::disk('public')->exists($distribution->proof_photo)) {
            Storage::disk('public')->delete($distribution->proof_photo);
        }

        $distribution->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data penyaluran berhasil dihapus.',
        ], 200);
    }
}
