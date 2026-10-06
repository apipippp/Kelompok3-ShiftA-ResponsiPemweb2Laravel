<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-dark-green leading-tight">
                {{ __('Formulir Donasi Pakaian') }}
            </h2>
            <a href="{{ route('donations.index') }}"
               class="inline-flex items-center text-sm font-semibold text-warm-brown hover:text-dark-green transition">
                <svg class="w-4 h-4 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Riwayat
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-cream/50 min-h-[calc(100vh-140px)]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Card Formulir -->
            <div class="bg-white rounded-2xl shadow-sm border border-sage/30 overflow-hidden">
                <!-- Header Card -->
                <div class="bg-dark-green text-white px-8 py-6">
                    <div class="flex items-center space-x-3">
                        <span class="p-2 bg-sage/30 rounded-xl text-2xl">👕</span>
                        <div>
                            <h3 class="text-xl font-bold">Kirim Donasi Pakaian Anda</h3>
                            <p class="text-sm text-cream/90 mt-0.5">
                                Setiap potong pakaian yang layak pakai akan membawa kehangatan dan senyuman baru bagi penerima.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                    @if (isset($errors) && $errors->any())
                        <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm">
                            <p class="font-bold mb-1">Terdapat kesalahan pengisian formulir:</p>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Grid Informasi Donatur -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="donor_name" class="block text-sm font-semibold text-gray-700 mb-1">
                                Nama Lengkap Donatur <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   id="donor_name"
                                   name="donor_name"
                                   value="{{ old('donor_name', $user->name) }}"
                                   required
                                   class="w-full rounded-xl border-gray-300 focus:border-sage focus:ring focus:ring-sage/30 transition text-sm py-2.5"
                                   placeholder="Contoh: Afif Nur Rahman">
                        </div>

                        <div>
                            <label for="donor_phone" class="block text-sm font-semibold text-gray-700 mb-1">
                                Nomor WhatsApp / Telepon <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   id="donor_phone"
                                   name="donor_phone"
                                   value="{{ old('donor_phone', $user->phone ?? '') }}"
                                   required
                                   class="w-full rounded-xl border-gray-300 focus:border-sage focus:ring focus:ring-sage/30 transition text-sm py-2.5"
                                   placeholder="Contoh: 081234567890">
                        </div>
                    </div>

                    <!-- Grid Jenis & Jumlah Pakaian -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="clothing_type" class="block text-sm font-semibold text-gray-700 mb-1">
                                Jenis Pakaian <span class="text-red-500">*</span>
                            </label>
                            <select id="clothing_type"
                                    name="clothing_type"
                                    required
                                    class="w-full rounded-xl border-gray-300 focus:border-sage focus:ring focus:ring-sage/30 transition text-sm py-2.5">
                                <option value="">-- Pilih Kategori Pakaian --</option>
                                <option value="Kaos & T-Shirt" {{ old('clothing_type') === 'Kaos & T-Shirt' ? 'selected' : '' }}>Kaos & T-Shirt</option>
                                <option value="Kemeja & Blus" {{ old('clothing_type') === 'Kemeja & Blus' ? 'selected' : '' }}>Kemeja & Blus</option>
                                <option value="Celana & Rok" {{ old('clothing_type') === 'Celana & Rok' ? 'selected' : '' }}>Celana & Rok</option>
                                <option value="Jaket, Sweater & Hoodie" {{ old('clothing_type') === 'Jaket, Sweater & Hoodie' ? 'selected' : '' }}>Jaket, Sweater & Hoodie</option>
                                <option value="Pakaian Bayi & Anak" {{ old('clothing_type') === 'Pakaian Bayi & Anak' ? 'selected' : '' }}>Pakaian Bayi & Anak</option>
                                <option value="Seragam Sekolah" {{ old('clothing_type') === 'Seragam Sekolah' ? 'selected' : '' }}>Seragam Sekolah</option>
                                <option value="Pakaian Muslim & Ibadah" {{ old('clothing_type') === 'Pakaian Muslim & Ibadah' ? 'selected' : '' }}>Pakaian Muslim & Ibadah</option>
                                <option value="Lainnya (Campuran)" {{ old('clothing_type') === 'Lainnya (Campuran)' ? 'selected' : '' }}>Lainnya (Campuran)</option>
                            </select>
                        </div>

                        <div>
                            <label for="quantity" class="block text-sm font-semibold text-gray-700 mb-1">
                                Jumlah Potong (Pcs) <span class="text-red-500">*</span>
                            </label>
                            <input type="number"
                                   id="quantity"
                                   name="quantity"
                                   min="1"
                                   max="500"
                                   value="{{ old('quantity', 1) }}"
                                   required
                                   class="w-full rounded-xl border-gray-300 focus:border-sage focus:ring focus:ring-sage/30 transition text-sm py-2.5"
                                   placeholder="Contoh: 5">
                        </div>
                    </div>

                    <!-- Pilihan Kondisi Pakaian -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Kondisi Pakaian <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <label class="relative flex items-center p-4 border rounded-xl cursor-pointer hover:border-sage transition has-[:checked]:border-dark-green has-[:checked]:bg-sage/10">
                                <input type="radio" name="condition" value="sangat_baik" class="text-dark-green focus:ring-sage" {{ old('condition', 'sangat_baik') === 'sangat_baik' ? 'checked' : '' }}>
                                <div class="ms-3">
                                    <span class="block text-sm font-bold text-gray-800">Sangat Baik (Seperti Baru)</span>
                                    <span class="block text-xs text-gray-500 mt-0.5">Warna masih cerah, tanpa noda, jahitan utuh 100%.</span>
                                </div>
                            </label>

                            <label class="relative flex items-center p-4 border rounded-xl cursor-pointer hover:border-sage transition has-[:checked]:border-dark-green has-[:checked]:bg-sage/10">
                                <input type="radio" name="condition" value="layak_pakai" class="text-dark-green focus:ring-sage" {{ old('condition') === 'layak_pakai' ? 'checked' : '' }}>
                                <div class="ms-3">
                                    <span class="block text-sm font-bold text-gray-800">Layak Pakai (Bersih & Rapi)</span>
                                    <span class="block text-xs text-gray-500 mt-0.5">Sudah dicuci bersih, wangi, tidak ada sobekan parah.</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Pilihan Metode Penyerahan -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Metode Penyerahan Pakaian <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <label class="relative flex items-center p-4 border rounded-xl cursor-pointer hover:border-sage transition has-[:checked]:border-dark-green has-[:checked]:bg-sage/10">
                                <input type="radio" name="delivery_method" value="antar_posko" class="text-dark-green focus:ring-sage" {{ old('delivery_method', 'antar_posko') === 'antar_posko' ? 'checked' : '' }}>
                                <div class="ms-3">
                                    <span class="block text-sm font-bold text-gray-800">📍 Antar Langsung ke Posko Drop-Off</span>
                                    <span class="block text-xs text-gray-500 mt-0.5">Antar pakaian ke titik posko pengumpulan Lemari Peduli terdekat.</span>
                                </div>
                            </label>

                            <label class="relative flex items-center p-4 border rounded-xl cursor-pointer hover:border-sage transition has-[:checked]:border-dark-green has-[:checked]:bg-sage/10">
                                <input type="radio" name="delivery_method" value="ekspedisi" class="text-dark-green focus:ring-sage" {{ old('delivery_method') === 'ekspedisi' ? 'checked' : '' }}>
                                <div class="ms-3">
                                    <span class="block text-sm font-bold text-gray-800">📦 Kirim via Ekspedisi / Kurir</span>
                                    <span class="block text-xs text-gray-500 mt-0.5">Kirimkan paket melalui JNE, J&T, SiCepat, atau kurir lainnya.</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Upload Foto Pakaian & Live Preview JS -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">
                            Foto Pakaian (Opsional, Disarankan)
                        </label>
                        <p class="text-xs text-gray-500 mb-2">Format: JPG, PNG, WEBP (Maksimal 2 MB). Foto membantu proses verifikasi posko.</p>

                        <div class="flex items-center space-x-6">
                            <div class="w-28 h-28 border-2 border-dashed border-sage rounded-xl flex items-center justify-center overflow-hidden bg-cream/40" id="preview-container">
                                <img id="preview-image" src="" alt="Preview Foto" class="w-full h-full object-cover hidden">
                                <span id="preview-placeholder" class="text-xs text-center text-gray-400 p-2">
                                    Belum ada foto
                                </span>
                            </div>

                            <div class="flex-1">
                                <input type="file"
                                       id="photo"
                                       name="photo"
                                       accept="image/*"
                                       class="block w-full text-sm text-gray-500 file:me-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-sage/20 file:text-dark-green hover:file:bg-sage/30 transition cursor-pointer"
                                       onchange="handlePreviewPhoto(this)">
                            </div>
                        </div>
                    </div>

                    <!-- Catatan Tambahan -->
                    <div>
                        <label for="notes" class="block text-sm font-semibold text-gray-700 mb-1">
                            Catatan Tambahan untuk Petugas Posko (Opsional)
                        </label>
                        <textarea id="notes"
                                  name="notes"
                                  rows="3"
                                  class="w-full rounded-xl border-gray-300 focus:border-sage focus:ring focus:ring-sage/30 transition text-sm py-2.5"
                                  placeholder="Contoh: Sudah dikemas rapi dalam 1 plastik bening, pakaian untuk anak usia 5-8 tahun.">{{ old('notes') }}</textarea>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="pt-4 border-t border-gray-100 flex items-center justify-end space-x-4">
                        <a href="{{ route('donations.index') }}"
                           class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 font-medium text-sm hover:bg-gray-50 transition">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-6 py-2.5 rounded-xl bg-dark-green text-white font-semibold text-sm hover:bg-sage transition shadow-sm flex items-center space-x-2">
                            <span>Kirim Pengajuan Donasi</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- Script Live Preview -->
    <script>
        function handlePreviewPhoto(input) {
            const previewImage = document.getElementById('preview-image');
            const previewPlaceholder = document.getElementById('preview-placeholder');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                    previewPlaceholder.classList.add('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                previewImage.src = '';
                previewImage.classList.add('hidden');
                previewPlaceholder.classList.remove('hidden');
            }
        }
    </script>
</x-app-layout>
