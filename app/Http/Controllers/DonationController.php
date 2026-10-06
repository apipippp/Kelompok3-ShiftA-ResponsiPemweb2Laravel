<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DonationController extends Controller
{
    /**
     * Tampilkan daftar donasi (Donatur melihat miliknya, Admin melihat semua).
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $query = $user->role === 'admin'
            ? Donation::with('user')->latest()
            : $user->donations()->latest();

        // Filter pencarian berdasarkan kode tracking atau nama
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('tracking_code', 'like', "%{$search}%")
                    ->orWhere('donor_name', 'like', "%{$search}%")
                    ->orWhere('clothing_type', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan status
        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        $donations = $query->paginate(10)->withQueryString();

        // Statistik ringkas untuk tab filter
        $baseCountQuery = $user->role === 'admin' ? Donation::query() : $user->donations();
        $stats = [
            'total' => (clone $baseCountQuery)->count(),
            'menunggu' => (clone $baseCountQuery)->where('status', 'menunggu')->count(),
            'diverifikasi' => (clone $baseCountQuery)->where('status', 'diverifikasi')->count(),
            'diterima' => (clone $baseCountQuery)->where('status', 'diterima')->count(),
            'disalurkan' => (clone $baseCountQuery)->where('status', 'disalurkan')->count(),
        ];

        return view('donations.index', compact('donations', 'stats', 'user'));
    }

    /**
     * Tampilkan form pengajuan donasi baru.
     */
    public function create(Request $request): View
    {
        $user = $request->user();
        return view('donations.create', compact('user'));
    }

    /**
     * Simpan donasi pakaian ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'donor_name' => ['required', 'string', 'max:255'],
            'donor_phone' => ['required', 'string', 'max:20'],
            'clothing_type' => ['required', 'string', 'max:100'],
            'quantity' => ['required', 'integer', 'min:1', 'max:500'],
            'condition' => ['required', 'in:sangat_baik,layak_pakai'],
            'delivery_method' => ['required', 'in:antar_posko,ekspedisi'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ], [
            'donor_name.required' => 'Nama donatur wajib diisi.',
            'donor_phone.required' => 'Nomor WhatsApp / telepon wajib diisi.',
            'clothing_type.required' => 'Jenis pakaian wajib dipilih.',
            'quantity.min' => 'Jumlah pakaian minimal 1 potong.',
            'condition.in' => 'Kondisi pakaian tidak valid.',
            'delivery_method.in' => 'Metode penyerahan tidak valid.',
            'photo.image' => 'File foto harus berupa gambar.',
            'photo.max' => 'Ukuran foto maksimal 2 MB.',
        ]);

        // Handle upload foto pakaian jika ada
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('donations', 'public');
        }

        // Buat donasi baru terikat ke user yang login
        $donation = $request->user()->donations()->create([
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

        return redirect()->route('donations.show', $donation)->with(
            'success',
            "Donasi berhasil didaftarkan! Simpan kode tracking Anda: {$donation->tracking_code}"
        );
    }

    /**
     * Tampilkan detail donasi dan status tracking.
     */
    public function show(Request $request, Donation $donation): View
    {
        $user = $request->user();

        // Otorisasi: hanya admin atau pemilik donasi yang boleh melihat
        if ($user->role !== 'admin' && $donation->user_id !== $user->id) {
            abort(403, 'Anda tidak berhak melihat data donasi ini.');
        }

        return view('donations.show', compact('donation', 'user'));
    }

    /**
     * Form edit donasi (hanya jika status masih menunggu).
     */
    public function edit(Request $request, Donation $donation): View|RedirectResponse
    {
        $user = $request->user();

        if ($user->role !== 'admin' && $donation->user_id !== $user->id) {
            abort(403, 'Anda tidak berhak mengedit donasi ini.');
        }

        if ($donation->status !== 'menunggu' && $user->role !== 'admin') {
            return redirect()->route('donations.show', $donation)->with(
                'error',
                'Donasi yang sudah diverifikasi tidak dapat diubah kembali.'
            );
        }

        return view('donations.edit', compact('donation', 'user'));
    }

    /**
     * Perbarui data donasi.
     */
    public function update(Request $request, Donation $donation): RedirectResponse
    {
        $user = $request->user();

        if ($user->role !== 'admin' && $donation->user_id !== $user->id) {
            abort(403, 'Anda tidak berhak memperbarui donasi ini.');
        }

        if ($donation->status !== 'menunggu' && $user->role !== 'admin') {
            return redirect()->route('donations.show', $donation)->with(
                'error',
                'Donasi yang sudah diverifikasi tidak dapat diubah kembali.'
            );
        }

        $validated = $request->validate([
            'donor_name' => ['required', 'string', 'max:255'],
            'donor_phone' => ['required', 'string', 'max:20'],
            'clothing_type' => ['required', 'string', 'max:100'],
            'quantity' => ['required', 'integer', 'min:1', 'max:500'],
            'condition' => ['required', 'in:sangat_baik,layak_pakai'],
            'delivery_method' => ['required', 'in:antar_posko,ekspedisi'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            if ($donation->photo && Storage::disk('public')->exists($donation->photo)) {
                Storage::disk('public')->delete($donation->photo);
            }
            $validated['photo'] = $request->file('photo')->store('donations', 'public');
        }

        $donation->update($validated);

        return redirect()->route('donations.show', $donation)->with(
            'success',
            'Data donasi berhasil diperbarui.'
        );
    }

    /**
     * Hapus / Batalkan donasi.
     */
    public function destroy(Request $request, Donation $donation): RedirectResponse
    {
        $user = $request->user();

        if ($user->role !== 'admin' && $donation->user_id !== $user->id) {
            abort(403, 'Anda tidak berhak menghapus donasi ini.');
        }

        // Donatur hanya boleh menghapus/membatalkan jika status masih menunggu
        if ($donation->status !== 'menunggu' && $user->role !== 'admin') {
            return redirect()->route('donations.show', $donation)->with(
                'error',
                'Donasi yang telah diproses tidak dapat dibatalkan.'
            );
        }

        if ($donation->photo && Storage::disk('public')->exists($donation->photo)) {
            Storage::disk('public')->delete($donation->photo);
        }

        $donation->delete();

        return redirect()->route('donations.index')->with(
            'success',
            'Data donasi berhasil dibatalkan/dihapus.'
        );
    }

    /**
     * Khusus Admin: Update status donasi (menunggu -> diverifikasi -> diterima -> disalurkan).
     */
    public function updateStatus(Request $request, Donation $donation): RedirectResponse
    {
        if ($request->user()->role !== 'admin') {
            abort(403, 'Akses khusus Administrator.');
        }

        $validated = $request->validate([
            'status' => ['required', 'in:menunggu,diverifikasi,diterima,disalurkan,dibatalkan'],
            'admin_notes' => ['nullable', 'string', 'max:500'],
        ]);

        $donation->status = $validated['status'];
        if (!empty($validated['admin_notes'])) {
            $donation->notes = ($donation->notes ? $donation->notes . "\n" : '') .
                "[Catatan Admin " . now()->format('d/m/Y H:i') . "]: " . $validated['admin_notes'];
        }
        $donation->save();

        return redirect()->route('donations.show', $donation)->with(
            'success',
            "Status donasi berhasil diubah menjadi: {$donation->status_label}."
        );
    }

    /**
     * Pelacakan publik: Siapa saja bisa cek resi donasi dengan kode tracking.
     */
    public function track(Request $request): View
    {
        $donation = null;
        if ($request->filled('code')) {
            $code = trim($request->code);
            $donation = Donation::where('tracking_code', $code)->first();
        }

        return view('donations.track', compact('donation'));
    }

    /**
     * Tampilan cetak label paket pakaian (Print View).
     */
    public function printLabel(Request $request, Donation $donation): View
    {
        $user = $request->user();
        if ($user->role !== 'admin' && $donation->user_id !== $user->id) {
            abort(403, 'Akses ditolak.');
        }

        return view('donations.print', compact('donation'));
    }
}
