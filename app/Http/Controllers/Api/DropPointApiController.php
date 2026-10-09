<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DropPointResource;
use App\Models\DropPoint;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DropPointApiController extends Controller
{
    /**
     * GET /api/drop-points (Public list with search & filter)
     */
    public function index(Request $request): JsonResponse
    {
        $query = DropPoint::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%");
            });
        }

        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        $dropPoints = $query->paginate(15);

        return response()->json([
            'status' => true,
            'message' => 'Daftar titik posko berhasil diambil.',
            'data' => DropPointResource::collection($dropPoints),
            'pagination' => [
                'current_page' => $dropPoints->currentPage(),
                'last_page' => $dropPoints->lastPage(),
                'per_page' => $dropPoints->perPage(),
                'total' => $dropPoints->total(),
            ],
        ], 200);
    }

    /**
     * GET /api/drop-points/{id}
     */
    public function show(DropPoint $dropPoint): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => 'Detail posko berhasil diambil.',
            'data' => new DropPointResource($dropPoint),
        ], 200);
    }

    /**
     * POST /api/drop-points (Admin only)
     */
    public function store(Request $request): JsonResponse
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['status' => false, 'message' => 'Akses khusus Admin.'], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'pic_name' => 'required|string|max:255',
            'pic_phone' => 'required|string|max:20',
            'operating_hours' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'maps_url' => 'nullable|string',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('drop_points', 'public');
        }

        $dropPoint = DropPoint::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Posko berhasil ditambahkan.',
            'data' => new DropPointResource($dropPoint),
        ], 201);
    }

    /**
     * PUT/PATCH /api/drop-points/{id} (Admin only)
     */
    public function update(Request $request, DropPoint $dropPoint): JsonResponse
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['status' => false, 'message' => 'Akses khusus Admin.'], 403);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string',
            'city' => 'sometimes|required|string|max:100',
            'pic_name' => 'sometimes|required|string|max:255',
            'pic_phone' => 'sometimes|required|string|max:20',
            'operating_hours' => 'sometimes|required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'maps_url' => 'nullable|string',
        ]);

        if ($request->hasFile('photo')) {
            if ($dropPoint->photo && Storage::disk('public')->exists($dropPoint->photo)) {
                Storage::disk('public')->delete($dropPoint->photo);
            }
            $validated['photo'] = $request->file('photo')->store('drop_points', 'public');
        }

        $dropPoint->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Data posko berhasil diperbarui.',
            'data' => new DropPointResource($dropPoint),
        ], 200);
    }

    /**
     * DELETE /api/drop-points/{id} (Admin only)
     */
    public function destroy(Request $request, DropPoint $dropPoint): JsonResponse
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['status' => false, 'message' => 'Akses khusus Admin.'], 403);
        }

        if ($dropPoint->photo && Storage::disk('public')->exists($dropPoint->photo)) {
            Storage::disk('public')->delete($dropPoint->photo);
        }

        $dropPoint->delete();

        return response()->json([
            'status' => true,
            'message' => 'Posko berhasil dihapus.',
        ], 200);
    }
}
