<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <nav class="flex items-center space-x-2 text-xs text-gray-500 mb-1">
                    <a href="{{ route('donations.index') }}" class="hover:text-dark-green transition">Donasi Pakaian</a>
                    <span>/</span>
                    <span class="text-dark-green font-semibold">Formulir Pengajuan</span>
                </nav>
                <h2 class="font-extrabold text-2xl text-dark-green leading-tight">
                    Ajukan Donasi Pakaian
                </h2>
            </div>
            <a href="{{ route('donations.index') }}"
               class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-semibold text-gray-700 bg-white border border-gray-200 hover:bg-gray-50 transition shadow-sm w-fit">
                <svg class="w-4 h-4 me-1.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Riwayat
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-cream/30 min-h-[calc(100vh-140px)]">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bezel-outer">
                <div class="bezel-inner overflow-hidden bg-white">
                <!-- Header Banner -->
                <div class="bg-dark-green px-6 sm:px-8 py-6 text-white flex items-center justify-between">
                    <div class="space-y-1">
                        <div class="inline-flex items-center space-x-1.5 px-2.5 py-0.5 rounded-full bg-sage/30 text-cream text-[11px] font-bold uppercase tracking-wider">
                            <span>🌱</span>
                            <span>Beri Manfaat Baru</span>
                        </div>
                        <h3 class="text-xl font-bold tracking-tight">Kirim Donasi Pakaian Anda</h3>
                        <p class="text-xs text-cream/90 max-w-lg">
                            Pakaian bekas layak pakai Anda akan disortir oleh posko dan disalurkan kepada mereka yang paling membutuhkan.
                        </p>
                    </div>
                    <div class="hidden sm:flex w-14 h-14 rounded-2xl bg-white/10 items-center justify-center text-3xl border border-white/10 flex-shrink-0">
                        👕
                    </div>
                </div>

                <!-- Formulir -->
                <form action="{{ route('donations.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-8">
                    @csrf

                    @if (isset($errors) && $errors->any())
                        <div class="p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-sm">
                            <div class="flex items-center space-x-2 font-bold mb-1">
                                <span>⚠️</span>
                                <span>Terdapat data yang belum lengkap:</span>
                            </div>
                            <ul class="list-disc list-inside space-y-1 text-xs">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- SEKSI 1: DATA DONATUR -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-2 border-b border-gray-100 pb-2">
                            <span class="w-6 h-6 rounded-full bg-dark-green text-white text-xs font-bold flex items-center justify-center">1</span>
                            <h4 class="font-bold text-dark-green text-sm uppercase tracking-wide">Data Kontak Donatur</h4>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="donor_name" class="block text-xs font-bold text-gray-700 mb-1.5">
                                    Nama Lengkap Donatur <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                       id="donor_name"
                                       name="donor_name"
                                       value="{{ old('donor_name', $user->name) }}"
                                       required
                                       placeholder="Contoh: Afif Nur Rahman"
                                       class="w-full rounded-xl border-gray-300 text-sm py-2.5 px-3.5 focus:border-sage focus:ring focus:ring-sage/20 transition">
                            </div>

                            <div>
                                <label for="donor_phone" class="block text-xs font-bold text-gray-700 mb-1.5">
                                    Nomor WhatsApp / Telepon <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                       id="donor_phone"
                                       name="donor_phone"
                                       value="{{ old('donor_phone', $user->phone ?? '') }}"
                                       required
                                       placeholder="Contoh: 081234567890"
                                       class="w-full rounded-xl border-gray-300 text-sm py-2.5 px-3.5 focus:border-sage focus:ring focus:ring-sage/20 transition font-mono">
                            </div>
                        </div>
                    </div>

                    <!-- SEKSI 2: SPESIFIKASI PAKAIAN -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-2 border-b border-gray-100 pb-2">
                            <span class="w-6 h-6 rounded-full bg-dark-green text-white text-xs font-bold flex items-center justify-center">2</span>
                            <h4 class="font-bold text-dark-green text-sm uppercase tracking-wide">Rincian Barang Pakaian</h4>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="clothing_type" class="block text-xs font-bold text-gray-700 mb-1.5">
                                    Kategori Pakaian <span class="text-red-500">*</span>
                                </label>
                                <select id="clothing_type"
                                        name="clothing_type"
                                        required
                                        class="w-full rounded-xl border-gray-300 text-sm py-2.5 px-3.5 focus:border-sage focus:ring focus:ring-sage/20 transition text-gray-700">
                                    <option value="">-- Pilih Jenis Pakaian --</option>
                                    <option value="Kaos & T-Shirt" {{ old('clothing_type') === 'Kaos & T-Shirt' ? 'selected' : '' }}>👕 Kaos & T-Shirt</option>
                                    <option value="Kemeja & Blus" {{ old('clothing_type') === 'Kemeja & Blus' ? 'selected' : '' }}>👔 Kemeja & Blus</option>
                                    <option value="Celana & Rok" {{ old('clothing_type') === 'Celana & Rok' ? 'selected' : '' }}>👖 Celana & Rok</option>
                                    <option value="Jaket, Sweater & Hoodie" {{ old('clothing_type') === 'Jaket, Sweater & Hoodie' ? 'selected' : '' }}>🧥 Jaket, Sweater & Hoodie</option>
                                    <option value="Pakaian Bayi & Anak" {{ old('clothing_type') === 'Pakaian Bayi & Anak' ? 'selected' : '' }}>👶 Pakaian Bayi & Anak</option>
                                    <option value="Seragam Sekolah" {{ old('clothing_type') === 'Seragam Sekolah' ? 'selected' : '' }}>🎒 Seragam Sekolah</option>
                                    <option value="Pakaian Muslim & Ibadah" {{ old('clothing_type') === 'Pakaian Muslim & Ibadah' ? 'selected' : '' }}>🧕 Pakaian Muslim & Ibadah</option>
                                    <option value="Lainnya (Campuran)" {{ old('clothing_type') === 'Lainnya (Campuran)' ? 'selected' : '' }}>📦 Campuran / Lainnya</option>
                                </select>
                            </div>

                            <div>
                                <label for="quantity" class="block text-xs font-bold text-gray-700 mb-1.5">
                                    Jumlah Potong (Pcs) <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="number"
                                           id="quantity"
                                           name="quantity"
                                           min="1"
                                           max="500"
                                           value="{{ old('quantity', 1) }}"
                                           required
                                           placeholder="1"
                                           class="w-full rounded-xl border-gray-300 text-sm py-2.5 ps-3.5 pe-12 focus:border-sage focus:ring focus:ring-sage/20 transition font-bold text-dark-green">
                                    <span class="absolute end-3.5 top-2.5 text-xs text-gray-400 font-semibold pointer-events-none">pcs</span>
                                </div>
                            </div>
                        </div>

                        <!-- Kondisi Pakaian -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1.5">
                                Kondisi Pakaian <span class="text-red-500">*</span>
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <label class="relative flex items-start p-4 border rounded-2xl cursor-pointer hover:border-sage transition has-[:checked]:border-dark-green has-[:checked]:bg-sage/10 bg-white shadow-2xs">
                                    <input type="radio" name="condition" value="sangat_baik" class="mt-1 text-dark-green focus:ring-sage" {{ old('condition', 'sangat_baik') === 'sangat_baik' ? 'checked' : '' }}>
                                    <div class="ms-3">
                                        <div class="flex items-center space-x-1.5">
                                            <span class="text-xs">✨</span>
                                            <span class="text-sm font-bold text-gray-800">Sangat Baik</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1 leading-relaxed">Seperti baru, warna cerah, tanpa noda, dan jahitan utuh.</p>
                                    </div>
                                </label>

                                <label class="relative flex items-start p-4 border rounded-2xl cursor-pointer hover:border-sage transition has-[:checked]:border-dark-green has-[:checked]:bg-sage/10 bg-white shadow-2xs">
                                    <input type="radio" name="condition" value="layak_pakai" class="mt-1 text-dark-green focus:ring-sage" {{ old('condition') === 'layak_pakai' ? 'checked' : '' }}>
                                    <div class="ms-3">
                                        <div class="flex items-center space-x-1.5">
                                            <span class="text-xs">👕</span>
                                            <span class="text-sm font-bold text-gray-800">Layak Pakai</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1 leading-relaxed">Sudah dicuci bersih, wangi, tanpa sobekan parah.</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- SEKSI 3: METODE & PENGIRIMAN -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-2 border-b border-gray-100 pb-2">
                            <span class="w-6 h-6 rounded-full bg-dark-green text-white text-xs font-bold flex items-center justify-center">3</span>
                            <h4 class="font-bold text-dark-green text-sm uppercase tracking-wide">Metode Penyerahan & Foto</h4>
                        </div>

                        <!-- Pilihan Metode -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1.5">
                                Metode Penyerahan <span class="text-red-500">*</span>
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <label class="relative flex items-start p-4 border rounded-2xl cursor-pointer hover:border-sage transition has-[:checked]:border-dark-green has-[:checked]:bg-sage/10 bg-white shadow-2xs">
                                    <input type="radio" name="delivery_method" value="antar_posko" class="mt-1 text-dark-green focus:ring-sage" {{ old('delivery_method', 'antar_posko') === 'antar_posko' ? 'checked' : '' }}>
                                    <div class="ms-3">
                                        <div class="flex items-center space-x-1.5">
                                            <span class="text-xs">📍</span>
                                            <span class="text-sm font-bold text-gray-800">Antar ke Posko Drop-Off</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1 leading-relaxed">Bawa paket langsung ke titik posko Lemari Peduli terdekat.</p>
                                    </div>
                                </label>

                                <label class="relative flex items-start p-4 border rounded-2xl cursor-pointer hover:border-sage transition has-[:checked]:border-dark-green has-[:checked]:bg-sage/10 bg-white shadow-2xs">
                                    <input type="radio" name="delivery_method" value="ekspedisi" class="mt-1 text-dark-green focus:ring-sage" {{ old('delivery_method') === 'ekspedisi' ? 'checked' : '' }}>
                                    <div class="ms-3">
                                        <div class="flex items-center space-x-1.5">
                                            <span class="text-xs">📦</span>
                                            <span class="text-sm font-bold text-gray-800">Kirim via Ekspedisi</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1 leading-relaxed">Kirim paket melalui JNE, J&T, SiCepat, atau kurir pilihan.</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Upload Foto Modern (Unified Card) -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">
                                Foto Pakaian (Opsional)
                            </label>
                            <p class="text-[11px] text-gray-500 mb-3">Membantu petugas memverifikasi kelayakan pakaian. Format: JPG, PNG, WEBP (Maksimal 2 MB).</p>

                            <!-- Hidden File Input -->
                            <input type="file"
                                   id="photo"
                                   name="photo"
                                   accept="image/*"
                                   class="hidden"
                                   onchange="handlePreviewPhoto(this)">

                            <!-- Status 1: Dropzone Saat Belum Ada Foto -->
                            <div id="dropzone-empty"
                                 onclick="document.getElementById('photo').click()"
                                 class="border-2 border-dashed border-sage/50 hover:border-dark-green bg-cream/20 hover:bg-cream/40 rounded-2xl p-6 text-center cursor-pointer transition flex flex-col items-center justify-center space-y-2 group">
                                <div class="w-12 h-12 rounded-2xl bg-sage/20 text-dark-green flex items-center justify-center text-2xl group-hover:scale-105 transition">
                                    📷
                                </div>
                                <div>
                                    <span class="text-xs sm:text-sm font-bold text-dark-green block">Klik atau Seret Foto Pakaian ke Sini</span>
                                    <span class="text-[11px] text-gray-400 mt-0.5 block">Format: JPG, PNG, WEBP (Maks. 2 MB)</span>
                                </div>
                                <span class="inline-flex items-center px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 text-xs font-semibold text-gray-700 shadow-2xs group-hover:border-sage">
                                    Pilih dari Perangkat
                                </span>
                            </div>

                            <!-- Status 2: Kartu Preview Saat Foto Sudah Dipilih -->
                            <div id="preview-card" class="hidden bg-cream/30 border border-sage/40 rounded-2xl p-4 flex flex-col sm:flex-row items-center gap-4 transition">
                                <!-- Thumbnail Foto Utuh -->
                                <div class="w-full sm:w-36 h-36 rounded-xl overflow-hidden bg-white border border-sage/30 flex-shrink-0 flex items-center justify-center shadow-2xs p-1">
                                    <img id="preview-image" src="" alt="Preview Foto" class="w-full h-full object-contain">
                                </div>

                                <!-- Info File & Aksi -->
                                <div class="flex-1 w-full space-y-2 text-center sm:text-left">
                                    <div class="inline-flex items-center space-x-1 px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[11px] font-bold">
                                        <span>✓</span>
                                        <span>Foto Berhasil Dipilih</span>
                                    </div>
                                    <h5 id="preview-filename" class="text-sm font-bold text-gray-900 break-all">
                                        nama_file.png
                                    </h5>
                                    <p id="preview-filesize" class="text-xs text-gray-500 font-mono">
                                        0 KB
                                    </p>

                                    <!-- Tombol Aksi Bersih -->
                                    <div class="pt-1 flex items-center justify-center sm:justify-start gap-2.5">
                                        <button type="button"
                                                onclick="document.getElementById('photo').click()"
                                                class="px-3.5 py-1.5 rounded-xl bg-white border border-gray-300 text-xs font-semibold text-gray-700 hover:bg-gray-50 transition shadow-2xs">
                                            🔄 Ganti Foto
                                        </button>
                                        <button type="button"
                                                onclick="cancelPreviewPhoto()"
                                                class="px-3.5 py-1.5 rounded-xl bg-rose-50 border border-rose-200 text-xs font-bold text-rose-700 hover:bg-rose-100 transition shadow-2xs">
                                            🗑️ Hapus Foto
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Catatan Tambahan -->
                        <div>
                            <label for="notes" class="block text-xs font-bold text-gray-700 mb-1.5">
                                Catatan Tambahan (Opsional)
                            </label>
                            <textarea id="notes"
                                      name="notes"
                                      rows="3"
                                      placeholder="Contoh: Sudah dikemas rapi dalam plastik, pakaian untuk remaja usia 13-17 tahun."
                                      class="w-full rounded-xl border-gray-300 text-sm py-2.5 px-3.5 focus:border-sage focus:ring focus:ring-sage/20 transition">{{ old('notes') }}</textarea>
                        </div>
                    </div>

                    <!-- Tombol Aksi Bawah -->
                    <div class="pt-6 border-t border-gray-100 flex items-center justify-end space-x-3">
                        <a href="{{ route('donations.index') }}"
                           class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 font-semibold text-xs hover:bg-gray-50 transition">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-6 py-2.5 rounded-xl bg-dark-green text-white font-bold text-xs hover:bg-sage transition shadow-sm flex items-center space-x-1.5">
                            <span>Kirim Donasi</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>

                </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Live Preview & Filename update -->
    <script>
        function handlePreviewPhoto(input) {
            const dropzoneEmpty = document.getElementById('dropzone-empty');
            const previewCard = document.getElementById('preview-card');
            const previewImage = document.getElementById('preview-image');
            const previewFilename = document.getElementById('preview-filename');
            const previewFilesize = document.getElementById('preview-filesize');

            if (input.files && input.files[0]) {
                const file = input.files[0];
                previewFilename.textContent = file.name;
                previewFilesize.textContent = Math.round(file.size / 1024) + ' KB';

                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    dropzoneEmpty.classList.add('hidden');
                    previewCard.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                cancelPreviewPhoto();
            }
        }

        function cancelPreviewPhoto() {
            const input = document.getElementById('photo');
            const dropzoneEmpty = document.getElementById('dropzone-empty');
            const previewCard = document.getElementById('preview-card');
            const previewImage = document.getElementById('preview-image');

            if (input) input.value = '';
            if (previewImage) previewImage.src = '';
            if (previewCard) previewCard.classList.add('hidden');
            if (dropzoneEmpty) dropzoneEmpty.classList.remove('hidden');
        }
    </script>
</x-app-layout>
