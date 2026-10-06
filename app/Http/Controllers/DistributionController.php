<?php

namespace App\Http\Controllers;

use App\Models\Distribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DistributionController extends Controller
{
    public function index()
    {
        $distributions = Distribution::latest('distribution_date')->get();

        return view('distributions.index', compact('distributions'));
    }

    public function create()
    {
        return view('distributions.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'recipient_name' => ['required', 'string', 'max:255'],
            'distribution_date' => ['required', 'date'],
            'items_count' => ['required', 'integer', 'min:1'],
            'proof_photo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'description' => ['required', 'string'],
        ]);

        $data['proof_photo'] = $request
            ->file('proof_photo')
            ->store('distributions', 'public');

        Distribution::create($data);

        return redirect()
            ->route('admin.distributions.index')
            ->with('success', 'Data penyaluran berhasil ditambahkan.');
    }

    public function edit(Distribution $distribution)
    {
        return view('distributions.edit', compact('distribution'));
    }

    public function update(Request $request, Distribution $distribution)
    {
        $data = $request->validate([
            'recipient_name' => ['required', 'string', 'max:255'],
            'distribution_date' => ['required', 'date'],
            'items_count' => ['required', 'integer', 'min:1'],
            'proof_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'description' => ['required', 'string'],
        ]);

        if ($request->hasFile('proof_photo')) {
            if ($distribution->proof_photo) {
                Storage::disk('public')->delete($distribution->proof_photo);
            }

            $data['proof_photo'] = $request
                ->file('proof_photo')
                ->store('distributions', 'public');
        }

        $distribution->update($data);

        return redirect()
            ->route('admin.distributions.index')
            ->with('success', 'Data penyaluran berhasil diperbarui.');
    }

    public function destroy(Distribution $distribution)
    {
        if ($distribution->proof_photo) {
            Storage::disk('public')->delete($distribution->proof_photo);
        }

        $distribution->delete();

        return redirect()
            ->route('admin.distributions.index')
            ->with('success', 'Data penyaluran berhasil dihapus.');
    }

    public function publicIndex()
    {
        $distributions = Distribution::latest('distribution_date')->get();

        return view('distributions.gallery', compact('distributions'));
    }
}
