<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-dark-green">
                Tambah Posko
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Tambahkan informasi titik posko pengumpulan pakaian layak pakai.
            </p>
        </div>
    </x-slot>

    <div class="min-h-screen bg-cream py-10">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            {{-- Kembali --}}
            <div class="mb-6">
                <a href="{{ route('admin.drop-points.index') }}"
                   class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 transition hover:text-dark-green">
                    ← Kembali ke Daftar Posko
                </a>
            </div>

            {{-- Form Card --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-black/5">

                {{-- Header Form --}}
                <div class="border-b border-gray-100 px-6 py-6 sm:px-8">
                    <h1 class="text-xl font-bold text-gray-800">
                        Informasi Posko
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Isi data posko dengan lengkap dan benar.
                    </p>
                </div>

                <form action="{{ route('admin.drop-points.store') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    <div class="space-y-6 px-6 py-8 sm:px-8">

                        {{-- Nama Posko --}}
                        <div>
                            <label for="name"
                                   class="mb-2 block text-sm font-semibold text-gray-700">
                                Nama Posko
                            </label>

                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ old('name') }}"
                                   placeholder="Contoh: Posko Lemari Peduli UNSOED"
                                   class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none transition focus:border-dark-green focus:ring-2 focus:ring-dark-green/10"
                                   required>

                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        {{-- Alamat --}}
                        <div>
                            <label for="address"
                                   class="mb-2 block text-sm font-semibold text-gray-700">
                                Alamat
                            </label>

                            <textarea id="address"
                                      name="address"
                                      rows="4"
                                      placeholder="Masukkan alamat lengkap posko"
                                      class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none transition focus:border-dark-green focus:ring-2 focus:ring-dark-green/10"
                                      required>{{ old('address') }}</textarea>

                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        {{-- Kota + PIC --}}
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                            <div>
                                <label for="city"
                                       class="mb-2 block text-sm font-semibold text-gray-700">
                                    Kota
                                </label>

                                <input type="text"
                                       id="city"
                                       name="city"
                                       value="{{ old('city') }}"
                                       placeholder="Contoh: Purwokerto"
                                       class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none transition focus:border-dark-green focus:ring-2 focus:ring-dark-green/10"
                                       required>

                                @error('city')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>


                            <div>
                                <label for="pic_name"
                                       class="mb-2 block text-sm font-semibold text-gray-700">
                                    Nama PIC
                                </label>

                                <input type="text"
                                       id="pic_name"
                                       name="pic_name"
                                       value="{{ old('pic_name') }}"
                                       placeholder="Nama penanggung jawab"
                                       class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none transition focus:border-dark-green focus:ring-2 focus:ring-dark-green/10"
                                       required>

                                @error('pic_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>


                        {{-- No HP + Jam Operasional --}}
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                            <div>
                                <label for="pic_phone"
                                       class="mb-2 block text-sm font-semibold text-gray-700">
                                    No HP PIC
                                </label>

                                <input type="text"
                                       id="pic_phone"
                                       name="pic_phone"
                                       value="{{ old('pic_phone') }}"
                                       placeholder="Contoh: 081234567890"
                                       class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none transition focus:border-dark-green focus:ring-2 focus:ring-dark-green/10"
                                       required>

                                @error('pic_phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>


                            <div>
                                <label for="operating_hours"
                                       class="mb-2 block text-sm font-semibold text-gray-700">
                                    Jam Operasional
                                </label>

                                <input type="text"
                                       id="operating_hours"
                                       name="operating_hours"
                                       value="{{ old('operating_hours') }}"
                                       placeholder="Contoh: Senin - Sabtu, 08.00 - 16.00"
                                       class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none transition focus:border-dark-green focus:ring-2 focus:ring-dark-green/10"
                                       required>

                                @error('operating_hours')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>


                        {{-- Foto --}}
                        <div>
                            <label for="photo"
                                   class="mb-2 block text-sm font-semibold text-gray-700">
                                Foto Posko
                            </label>

                            <input type="file"
                                   id="photo"
                                   name="photo"
                                   accept="image/*"
                                   class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm">

                            <p class="mt-2 text-xs text-gray-500">
                                Format gambar maksimal 2 MB.
                            </p>

                            @error('photo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        {{-- Google Maps --}}
                        <div>
                            <label for="maps_url"
                                   class="mb-2 block text-sm font-semibold text-gray-700">
                                Google Maps URL
                            </label>

                            <input type="url"
                                   id="maps_url"
                                   name="maps_url"
                                   value="{{ old('maps_url') }}"
                                   placeholder="https://maps.google.com/..."
                                   class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none transition focus:border-dark-green focus:ring-2 focus:ring-dark-green/10">

                            <p class="mt-2 text-xs text-gray-500">
                                Masukkan link lokasi posko dari Google Maps. Field ini opsional.
                            </p>

                            @error('maps_url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>


                    {{-- Footer --}}
                    <div class="flex flex-col-reverse gap-3 border-t border-gray-100 bg-gray-50/50 px-6 py-5 sm:flex-row sm:justify-end sm:px-8">

                        <a href="{{ route('admin.drop-points.index') }}"
                           class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-50">
                            Batal
                        </a>

                        <button type="submit"
                                class="inline-flex items-center justify-center rounded-xl bg-dark-green px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:opacity-90">
                            Simpan Posko
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>