<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center space-x-3">
                    <span class="text-xs font-mono font-bold uppercase tracking-wider text-warm-brown bg-cream px-2.5 py-1 rounded-md border border-warm-brown/30">
                        {{ $donation->tracking_code }}
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border {{ $donation->status_badge_class }}">
                        {{ $donation->status_label }}
                    </span>
                </div>
                <h2 class="font-bold text-2xl text-dark-green leading-tight mt-1">
                    Detail & Pelacakan Donasi Pakaian
                </h2>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('donations.print', $donation) }}"
                   target="_blank"
                   class="inline-flex items-center px-4 py-2 bg-warm-brown text-white rounded-xl text-sm font-semibold hover:bg-dark-green transition shadow-sm">
                    <svg class="w-4 h-4 me-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Cetak Label Paket
                </a>
                <a href="{{ route('donations.index') }}"
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-xl text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 transition">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-cream/40 min-h-[calc(100vh-140px)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Alert Notification -->
            @if (session('success'))
                <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center justify-between shadow-sm">
                    <div class="flex items-center space-x-2">
                        <span class="text-lg">✅</span>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900 font-bold">&times;</button>
                </div>
            @endif

            @if (session('error'))
                <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm flex items-center justify-between shadow-sm">
                    <div class="flex items-center space-x-2">
                        <span class="text-lg">⚠️</span>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-rose-600 hover:text-rose-900 font-bold">&times;</button>
                </div>
            @endif

            <!-- Banner Dibatalkan jika status dibatalkan -->
            @if ($donation->status === 'dibatalkan')
                <div class="p-4 rounded-2xl bg-rose-100 border border-rose-300 text-rose-800 text-sm flex items-center space-x-3">
                    <span class="text-2xl">🚫</span>
                    <div>
                        <h4 class="font-bold">Pengajuan Donasi Ini Telah Dibatalkan</h4>
                        <p class="text-xs text-rose-700 mt-0.5">Donasi yang dibatalkan tidak akan diproses lebih lanjut oleh posko.</p>
                    </div>
                </div>
            @endif

            <!-- Timeline Status Progres (Visual Stepper) -->
            @php
                $steps = [
                    'menunggu' => ['label' => 'Diajukan', 'desc' => 'Menunggu verifikasi admin posko'],
                    'diverifikasi' => ['label' => 'Diverifikasi', 'desc' => 'Disetujui untuk dikirim/diantar'],
                    'diterima' => ['label' => 'Diterima di Posko', 'desc' => 'Pakaian disortir & siap disalurkan'],
                    'disalurkan' => ['label' => 'Telah Disalurkan', 'desc' => 'Diserahkan ke penerima manfaat'],
                ];
                $statusOrder = ['menunggu' => 1, 'diverifikasi' => 2, 'diterima' => 3, 'disalurkan' => 4, 'dibatalkan' => 0];
                $currentStepLevel = $statusOrder[$donation->status] ?? 1;
            @endphp

            @if ($donation->status !== 'dibatalkan')
                <div class="bg-white rounded-2xl border border-sage/30 p-6 shadow-sm">
                    <h3 class="text-sm font-bold text-dark-green uppercase tracking-wider mb-6">
                        Progress Pelacakan Status
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 relative">
                        @foreach ($steps as $key => $step)
                            @php
                                $stepLevel = $statusOrder[$key];
                                $isCompleted = $currentStepLevel >= $stepLevel;
                                $isCurrent = $currentStepLevel === $stepLevel;
                            @endphp

                            <div class="flex flex-col items-center sm:items-start p-4 rounded-xl transition {{ $isCurrent ? 'bg-sage/10 border-2 border-dark-green' : ($isCompleted ? 'bg-cream/40 border border-sage/30' : 'bg-gray-50 border border-gray-200 opacity-60') }}">
                                <div class="flex items-center space-x-2 mb-2">
                                    <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold {{ $isCompleted ? 'bg-dark-green text-white' : 'bg-gray-300 text-gray-700' }}">
                                        @if ($isCompleted && !$isCurrent)
                                            ✓
                                        @else
                                            {{ $stepLevel }}
                                        @endif
                                    </div>
                                    <span class="font-bold text-sm {{ $isCurrent ? 'text-dark-green' : ($isCompleted ? 'text-gray-900' : 'text-gray-500') }}">
                                        {{ $step->label ?? $step['label'] }}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500 text-center sm:text-left">
                                    {{ $step->desc ?? $step['desc'] }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Konten Grid 2 Kolom -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Kolom Kiri (2 Kolom): Spesifikasi Donasi & Foto -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Kartu Spesifikasi Pakaian -->
                    <div class="bg-white rounded-2xl border border-sage/30 p-6 shadow-sm">
                        <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-4">
                            <h3 class="font-bold text-lg text-dark-green">Informasi Pakaian yang Didonasikan</h3>
                            @if ($donation->status === 'menunggu' || $user->role === 'admin')
                                <a href="{{ route('donations.edit', $donation) }}"
                                   class="text-xs font-semibold text-blue-600 hover:text-blue-800 underline">
                                    Edit Data
                                </a>
                            @endif
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                            <div class="p-3 bg-cream/30 rounded-xl">
                                <span class="text-xs text-gray-500 block">Jenis Pakaian</span>
                                <span class="font-bold text-gray-900 text-base">{{ $donation->clothing_type }}</span>
                            </div>

                            <div class="p-3 bg-cream/30 rounded-xl">
                                <span class="text-xs text-gray-500 block">Jumlah Donasi</span>
                                <span class="font-bold text-dark-green text-base">{{ $donation->quantity }} Potong (Pcs)</span>
                            </div>

                            <div class="p-3 bg-cream/30 rounded-xl">
                                <span class="text-xs text-gray-500 block">Kondisi Pakaian</span>
                                <span class="font-semibold text-gray-800">{{ $donation->condition_label }}</span>
                            </div>

                            <div class="p-3 bg-cream/30 rounded-xl">
                                <span class="text-xs text-gray-500 block">Metode Penyerahan</span>
                                <span class="font-semibold text-gray-800">{{ $donation->delivery_method_label }}</span>
                            </div>

                            <div class="p-3 bg-cream/30 rounded-xl">
                                <span class="text-xs text-gray-500 block">Nama Donatur</span>
                                <span class="font-semibold text-gray-800">{{ $donation->donor_name }}</span>
                            </div>

                            <div class="p-3 bg-cream/30 rounded-xl">
                                <span class="text-xs text-gray-500 block">Nomor Kontak</span>
                                <span class="font-mono font-semibold text-warm-brown">{{ $donation->donor_phone }}</span>
                            </div>
                        </div>

                        <!-- Catatan Donatur -->
                        @if ($donation->notes)
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <span class="text-xs font-semibold text-gray-500 block mb-1">Catatan / Keterangan:</span>
                                <div class="p-3 rounded-xl bg-gray-50 text-gray-700 text-sm whitespace-pre-line border border-gray-200">
                                    {{ $donation->notes }}
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Kartu Dokumentasi Foto Pakaian -->
                    <div class="bg-white rounded-2xl border border-sage/30 p-6 shadow-sm">
                        <h3 class="font-bold text-lg text-dark-green mb-4">Dokumentasi Foto Pakaian</h3>

                        @if ($donation->photo)
                            <div class="rounded-xl overflow-hidden border border-sage/30 bg-cream/20">
                                <img src="{{ asset('storage/' . $donation->photo) }}"
                                     alt="Foto Pakaian {{ $donation->tracking_code }}"
                                     class="w-full max-h-96 object-contain mx-auto">
                            </div>
                        @else
                            <div class="p-8 text-center bg-gray-50 rounded-xl border border-dashed border-gray-300 text-gray-400">
                                <span class="text-4xl block mb-2">📷</span>
                                <p class="text-sm">Donatur tidak melampirkan foto pada pengajuan ini.</p>
                            </div>
                        @endif
                    </div>

                </div>

                <!-- Kolom Kanan (1 Kolom): Aksi Admin & Instruksi Donatur -->
                <div class="space-y-6">

                    <!-- KHUSUS ADMIN: Form Update Status RBAC -->
                    @if ($user->role === 'admin')
                        <div class="bg-white rounded-2xl border-2 border-dark-green p-6 shadow-md">
                            <div class="flex items-center space-x-2 text-dark-green font-bold text-lg mb-2">
                                <span>🛡️</span>
                                <h3>Panel Kelola Status (Admin)</h3>
                            </div>
                            <p class="text-xs text-gray-500 mb-4">
                                Ubah status verifikasi dan sertakan catatan progres untuk donatur.
                            </p>

                            <form action="{{ route('admin.donations.status', $donation) }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PATCH')

                                <div>
                                    <label for="status" class="block text-xs font-bold text-gray-700 uppercase mb-1">
                                        Pilih Status Baru
                                    </label>
                                    <select name="status"
                                            id="status"
                                            required
                                            class="w-full rounded-xl border-gray-300 text-sm focus:border-sage focus:ring focus:ring-sage/20">
                                        <option value="menunggu" {{ $donation->status === 'menunggu' ? 'selected' : '' }}>1. Menunggu Verifikasi</option>
                                        <option value="diverifikasi" {{ $donation->status === 'diverifikasi' ? 'selected' : '' }}>2. Diverifikasi (Disetujui)</option>
                                        <option value="diterima" {{ $donation->status === 'diterima' ? 'selected' : '' }}>3. Diterima di Posko</option>
                                        <option value="disalurkan" {{ $donation->status === 'disalurkan' ? 'selected' : '' }}>4. Telah Disalurkan</option>
                                        <option value="dibatalkan" {{ $donation->status === 'dibatalkan' ? 'selected' : '' }}>Batalkan Donasi</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="admin_notes" class="block text-xs font-bold text-gray-700 uppercase mb-1">
                                        Catatan Admin (Opsional)
                                    </label>
                                    <textarea name="admin_notes"
                                              id="admin_notes"
                                              rows="2"
                                              placeholder="Contoh: Paket telah sampai di Posko Kampus dan selesai disortir."
                                              class="w-full rounded-xl border-gray-300 text-xs focus:border-sage focus:ring focus:ring-sage/20"></textarea>
                                </div>

                                <button type="submit"
                                        class="w-full py-2.5 bg-dark-green text-white font-semibold text-sm rounded-xl hover:bg-sage transition shadow-sm">
                                    Simpan Perubahan Status
                                </button>
                            </form>
                        </div>
                    @endif

                    <!-- Petunjuk Pengiriman untuk Donatur -->
                    <div class="bg-white rounded-2xl border border-sage/30 p-6 shadow-sm">
                        <h4 class="font-bold text-dark-green text-base mb-3 flex items-center space-x-2">
                            <span>📌</span>
                            <span>Panduan Pengiriman Paket</span>
                        </h4>

                        <ol class="space-y-3 text-xs text-gray-600 list-decimal list-inside">
                            <li>
                                <strong class="text-gray-800">Cetak Label Resi:</strong> Klik tombol
                                <span class="font-bold text-warm-brown">"Cetak Label Paket"</span> di atas, lalu cetak di kertas A4 atau tulis nomor resi
                                <span class="font-mono font-bold text-dark-green">[{{ $donation->tracking_code }}]</span> secara jelas.
                            </li>
                            <li>
                                <strong class="text-gray-800">Kemas Pakaian:</strong> Masukkan pakaian bersih ke dalam kardus atau plastik tebal untuk melindungi dari debu/hujan.
                            </li>
                            <li>
                                <strong class="text-gray-800">Tempelkan Label:</strong> Tempelkan kertas resi pada bagian luar paket pakaian.
                            </li>
                            <li>
                                <strong class="text-gray-800">Serahkan Paket:</strong> Antarkan ke alamat posko drop-off terdekat atau kirimkan via jasa ekspedisi.
                            </li>
                        </ol>

                        <div class="mt-4 pt-4 border-t border-gray-100 flex justify-center">
                            <a href="{{ route('donations.print', $donation) }}"
                               target="_blank"
                               class="w-full text-center py-2 px-4 rounded-xl border border-warm-brown text-warm-brown hover:bg-warm-brown hover:text-white transition font-semibold text-xs">
                                🖨️ Buka Label Siap Cetak
                            </a>
                        </div>
                    </div>

                    <!-- Batalkan Donasi (Jika masih menunggu) -->
                    @if ($donation->status === 'menunggu')
                        <div class="bg-white rounded-2xl border border-rose-200 p-5 shadow-sm">
                            <h4 class="font-bold text-rose-800 text-sm mb-1">Batalkan Donasi</h4>
                            <p class="text-xs text-gray-500 mb-3">
                                Jika ada perubahan rencana, Anda dapat membatalkan pengajuan ini selama belum diverifikasi oleh petugas posko.
                            </p>
                            <form action="{{ route('donations.destroy', $donation) }}"
                                  method="POST"
                                  onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pengajuan donasi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full py-2 bg-rose-50 text-rose-700 hover:bg-rose-600 hover:text-white rounded-xl text-xs font-bold transition">
                                    Batalkan Pengajuan Ini
                                </button>
                            </form>
                        </div>
                    @endif

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
