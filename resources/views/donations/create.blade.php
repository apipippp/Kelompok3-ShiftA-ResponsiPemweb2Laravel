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

            <div class="bg-white rounded-3xl shadow-sm border border-sage/30 overflow-hidden">

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

                        <!-- Upload Foto Modern -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">
                                Foto Pakaian (Opsional)
                            </label>
                            <p class="text-[11px] text-gray-500 mb-3">Membantu petugas memverifikasi kategori pakaian. Format: JPG, PNG, WEBP (Maksimal 2 MB).</p>

                            <div class="flex flex-col sm:flex-row items-center gap-4">
                                <!-- Area Dropzone -->
                                <div class="flex-1 w-full space-y-2">
                                    <label for="photo" class="block w-full border-2 border-dashed border-sage/50 hover:border-dark-green bg-cream/20 hover:bg-cream/40 rounded-2xl p-5 text-center cursor-pointer transition flex flex-col items-center justify-center">
                                        <span class="text-2xl mb-1">📷</span>
                                        <span class="text-xs font-bold text-dark-green">Pilih atau Seret Foto Pakaian</span>
                                        <span class="text-[10px] text-gray-400 mt-0.5" id="file-chosen-text">Klik untuk telusuri berkas dari perangkat</span>
                                        <input type="file"
                                               id="photo"
                                               name="photo"
                                               accept="image/*"
                                               class="hidden"
                                               onchange="handlePreviewPhoto(this)">
                                    </label>
                                    <button type="button"
                                            id="btn-cancel-file"
                                            onclick="cancelPreviewPhoto()"
                                            class="hidden text-xs font-semibold text-rose-600 hover:text-rose-800 transition items-center space-x-1 py-1">
                                        <span>✕ Batal / Hapus Foto Ini</span>
                                    </button>
                                </div>

                                <!-- Kotak Preview -->
                                <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden bg-gray-50 flex-shrink-0 relative group" id="preview-container">
                                    <img id="preview-image" src="" alt="Preview" class="w-full h-full object-cover hidden">
                                    <span id="preview-placeholder" class="text-[11px] text-center text-gray-400 px-2 leading-tight">
                                        Preview foto
                                    </span>
                                    <button type="button"
                                            id="btn-remove-photo"
                                            onclick="cancelPreviewPhoto()"
                                            class="hidden absolute top-1.5 right-1.5 w-6 h-6 bg-rose-600 hover:bg-rose-700 text-white rounded-full flex items-center justify-center text-xs font-black shadow-md transition"
                                            title="Batalkan foto yang dipilih">
                                        ✕
                                    </button>
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

    <!-- Script Live Preview & Filename update -->
    <script>
        function handlePreviewPhoto(input) {
            const previewImage = document.getElementById('preview-image');
            const previewPlaceholder = document.getElementById('preview-placeholder');
            const fileChosenText = document.getElementById('file-chosen-text');
            const btnRemovePhoto = document.getElementById('btn-remove-photo');
            const btnCancelFile = document.getElementById('btn-cancel-file');

            if (input.files && input.files[0]) {
                const file = input.files[0];
                fileChosenText.textContent = file.name + ' (' + Math.round(file.size / 1024) + ' KB)';
                fileChosenText.classList.add('text-dark-green', 'font-bold');

                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                    previewPlaceholder.classList.add('hidden');
                    if (btnRemovePhoto) btnRemovePhoto.classList.remove('hidden');
                    if (btnCancelFile) {
                        btnCancelFile.classList.remove('hidden');
                        btnCancelFile.classList.add('inline-flex');
                    }
                };
                reader.readAsDataURL(file);
            } else {
                cancelPreviewPhoto();
            }
        }

        function cancelPreviewPhoto() {
            const input = document.getElementById('photo');
            const previewImage = document.getElementById('preview-image');
            const previewPlaceholder = document.getElementById('preview-placeholder');
            const fileChosenText = document.getElementById('file-chosen-text');
            const btnRemovePhoto = document.getElementById('btn-remove-photo');
            const btnCancelFile = document.getElementById('btn-cancel-file');

            if (input) input.value = '';
            if (fileChosenText) {
                fileChosenText.textContent = 'Klik untuk telusuri berkas dari perangkat';
                fileChosenText.classList.remove('text-dark-green', 'font-bold');
            }
            if (previewImage) {
                previewImage.src = '';
                previewImage.classList.add('hidden');
            }
            if (previewPlaceholder) {
                previewPlaceholder.classList.remove('hidden');
            }
            if (btnRemovePhoto) btnRemovePhoto.classList.add('hidden');
            if (btnCancelFile) {
                btnCancelFile.classList.add('hidden');
                btnCancelFile.classList.remove('inline-flex');
            }
        }
    </script>
</x-app-layout>
