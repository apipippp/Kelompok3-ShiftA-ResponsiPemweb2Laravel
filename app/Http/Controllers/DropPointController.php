<?php

namespace App\Http\Controllers;

use App\Models\DropPoint;
use Illuminate\Http\Request;

class DropPointController extends Controller
{
    public function index()
    {
        $dropPoints = DropPoint::latest()->get();

        return view('drop_points.index', compact('dropPoints'));
    }

    public function create()
    {
        return view('drop_points.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'pic_name' => 'required',
            'pic_phone' => 'required',
            'operating_hours' => 'required',
            'photo' => 'nullable|image|max:2048',
            'maps_url' => 'nullable',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')
                ->store('drop_points', 'public');
        }

        DropPoint::create($validated);

        return redirect()
            ->route('admin.drop-points.index')
            ->with('success', 'Posko berhasil ditambahkan');
    }

    public function show(DropPoint $dropPoint)
    {
        return view('drop_points.show', compact('dropPoint'));
    }

    public function edit(DropPoint $dropPoint)
    {
        return view('drop_points.edit', compact('dropPoint'));
    }

    public function update(Request $request, DropPoint $dropPoint)
    {
        $validated = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'pic_name' => 'required',
            'pic_phone' => 'required',
            'operating_hours' => 'required',
            'photo' => 'nullable|image|max:2048',
            'maps_url' => 'nullable',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')
                ->store('drop_points', 'public');
        }

        $dropPoint->update($validated);

        return redirect()
            ->route('admin.drop-points.index')
            ->with('success', 'Posko berhasil diperbarui');
    }

    public function publicIndex(Request $request)
    {
        $query = DropPoint::latest();

        // Pencarian berdasarkan nama posko, alamat, atau kota
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('address', 'like', "%{$search}%")
                ->orWhere('city', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan kota
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        $dropPoints = $query->get();

        // Mengambil daftar kota yang tersedia
        $cities = DropPoint::select('city')
            ->distinct()
            ->orderBy('city')
            ->pluck('city');

        return view('drop_points.public', compact('dropPoints', 'cities'));
    }

    public function destroy(DropPoint $dropPoint)
    {
        $dropPoint->delete();

        return redirect()
            ->route('admin.drop-points.index')
            ->with('success', 'Posko berhasil dihapus');
    }
}