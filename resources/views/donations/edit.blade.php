<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-dark-green leading-tight">
                    Edit Pengajuan Donasi Pakaian
                </h2>
                <p class="text-xs text-gray-500 mt-0.5 font-mono">Kode Resi: {{ $donation->tracking_code }}</p>
            </div>
            <a href="{{ route('donations.show', $donation) }}"
               class="inline-flex items-center text-sm font-semibold text-warm-brown hover:text-dark-green transition">
                <svg class="w-4 h-4 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Detail
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-cream/50 min-h-[calc(100vh-140px)]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow-sm border border-sage/30 overflow-hidden">
                <!-- Header -->
                <div class="bg-dark-green text-white px-8 py-5">
                    <h3 class="text-lg font-bold">Perbarui Informasi Pakaian</h3>
                    <p class="text-xs text-cream/90 mt-0.5">
                        Anda dapat mengubah data selama status donasi masih menunggu verifikasi.
                    </p>
                </div>

                <!-- Form -->
                <form action="{{ route('donations.update', $donation) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    @if (isset($errors) && $errors->any())
                        <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm">
                            <p class="font-bold mb-1">Periksa kembali data yang dimasukkan:</p>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Grid Info Donatur -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="donor_name" class="block text-sm font-semibold text-gray-700 mb-1">
                                Nama Lengkap Donatur <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   id="donor_name"
                                   name="donor_name"
                                   value="{{ old('donor_name', $donation->donor_name) }}"
                                   required
                                   class="w-full rounded-xl border-gray-300 focus:border-sage focus:ring focus:ring-sage/30 transition text-sm py-2.5">
                        </div>

                        <div>
                            <label for="donor_phone" class="block text-sm font-semibold text-gray-700 mb-1">
                                Nomor WhatsApp / Telepon <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   id="donor_phone"
                                   name="donor_phone"
                                   value="{{ old('donor_phone', $donation->donor_phone) }}"
                                   required
                                   class="w-full rounded-xl border-gray-300 focus:border-sage focus:ring focus:ring-sage/30 transition text-sm py-2.5">
                        </div>
                    </div>

                    <!-- Grid Kategori & Jumlah -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="clothing_type" class="block text-sm font-semibold text-gray-700 mb-1">
                                Jenis Pakaian <span class="text-red-500">*</span>
                            </label>
                            <select id="clothing_type"
                                    name="clothing_type"
                                    required
                                    class="w-full rounded-xl border-gray-300 focus:border-sage focus:ring focus:ring-sage/30 transition text-sm py-2.5">
                                @php
                                    $options = [
                                        'Kaos & T-Shirt',
                                        'Kemeja & Blus',
                                        'Celana & Rok',
                                        'Jaket, Sweater & Hoodie',
                                        'Pakaian Bayi & Anak',
                                        'Seragam Sekolah',
                                        'Pakaian Muslim & Ibadah',
                                        'Lainnya (Campuran)',
                                    ];
                                @endphp
                                @foreach ($options as $opt)
                                    <option value="{{ $opt }}" {{ old('clothing_type', $donation->clothing_type) === $opt ? 'selected' : '' }}>
                                        {{ $opt }}
                                    </option>
                                @endforeach
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
                                   value="{{ old('quantity', $donation->quantity) }}"
                                   required
                                   class="w-full rounded-xl border-gray-300 focus:border-sage focus:ring focus:ring-sage/30 transition text-sm py-2.5">
                        </div>
                    </div>

                    <!-- Kondisi Pakaian -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Kondisi Pakaian <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <label class="relative flex items-center p-4 border rounded-xl cursor-pointer hover:border-sage transition has-[:checked]:border-dark-green has-[:checked]:bg-sage/10">
                                <input type="radio" name="condition" value="sangat_baik" class="text-dark-green focus:ring-sage" {{ old('condition', $donation->condition) === 'sangat_baik' ? 'checked' : '' }}>
                                <div class="ms-3">
                                    <span class="block text-sm font-bold text-gray-800">Sangat Baik (Seperti Baru)</span>
                                    <span class="block text-xs text-gray-500 mt-0.5">Warna masih cerah, tanpa noda, jahitan utuh 100%.</span>
                                </div>
                            </label>

                            <label class="relative flex items-center p-4 border rounded-xl cursor-pointer hover:border-sage transition has-[:checked]:border-dark-green has-[:checked]:bg-sage/10">
                                <input type="radio" name="condition" value="layak_pakai" class="text-dark-green focus:ring-sage" {{ old('condition', $donation->condition) === 'layak_pakai' ? 'checked' : '' }}>
                                <div class="ms-3">
                                    <span class="block text-sm font-bold text-gray-800">Layak Pakai (Bersih & Rapi)</span>
                                    <span class="block text-xs text-gray-500 mt-0.5">Sudah dicuci bersih, wangi, tidak ada sobekan parah.</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Metode Penyerahan -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Metode Penyerahan Pakaian <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <label class="relative flex items-center p-4 border rounded-xl cursor-pointer hover:border-sage transition has-[:checked]:border-dark-green has-[:checked]:bg-sage/10">
                                <input type="radio" name="delivery_method" value="antar_posko" class="text-dark-green focus:ring-sage" {{ old('delivery_method', $donation->delivery_method) === 'antar_posko' ? 'checked' : '' }}>
                                <div class="ms-3">
                                    <span class="block text-sm font-bold text-gray-800">📍 Antar Langsung ke Posko Drop-Off</span>
                                    <span class="block text-xs text-gray-500 mt-0.5">Antar pakaian ke posko Lemari Peduli terdekat.</span>
                                </div>
                            </label>

                            <label class="relative flex items-center p-4 border rounded-xl cursor-pointer hover:border-sage transition has-[:checked]:border-dark-green has-[:checked]:bg-sage/10">
                                <input type="radio" name="delivery_method" value="ekspedisi" class="text-dark-green focus:ring-sage" {{ old('delivery_method', $donation->delivery_method) === 'ekspedisi' ? 'checked' : '' }}>
                                <div class="ms-3">
                                    <span class="block text-sm font-bold text-gray-800">📦 Kirim via Ekspedisi / Kurir</span>
                                    <span class="block text-xs text-gray-500 mt-0.5">Kirimkan paket melalui kurir pilihan Anda.</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Foto Pakaian -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">
                            Foto Pakaian (Ganti Foto)
                        </label>
                        <p class="text-xs text-gray-500 mb-2">Kosongkan jika tidak ingin mengubah foto yang sudah ada.</p>

                        <div class="flex items-center space-x-6">
                            <div class="w-28 h-28 border-2 border-dashed border-sage rounded-xl flex items-center justify-center overflow-hidden bg-cream/40" id="preview-container">
                                @if ($donation->photo)
                                    <img id="preview-image" src="{{ asset('storage/' . $donation->photo) }}" alt="Foto Lama" class="w-full h-full object-cover">
                                @else
                                    <img id="preview-image" src="" alt="Preview Foto" class="w-full h-full object-cover hidden">
                                    <span id="preview-placeholder" class="text-xs text-center text-gray-400 p-2">
                                        Belum ada foto
                                    </span>
                                @endif
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
                            Catatan Tambahan
                        </label>
                        <textarea id="notes"
                                  name="notes"
                                  rows="3"
                                  class="w-full rounded-xl border-gray-300 focus:border-sage focus:ring focus:ring-sage/30 transition text-sm py-2.5">{{ old('notes', $donation->notes) }}</textarea>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="pt-4 border-t border-gray-100 flex items-center justify-end space-x-4">
                        <a href="{{ route('donations.show', $donation) }}"
                           class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 font-medium text-sm hover:bg-gray-50 transition">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-6 py-2.5 rounded-xl bg-dark-green text-white font-semibold text-sm hover:bg-sage transition shadow-sm">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        function handlePreviewPhoto(input) {
            const previewImage = document.getElementById('preview-image');
            const previewPlaceholder = document.getElementById('preview-placeholder');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                    if (previewPlaceholder) previewPlaceholder.classList.add('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>
