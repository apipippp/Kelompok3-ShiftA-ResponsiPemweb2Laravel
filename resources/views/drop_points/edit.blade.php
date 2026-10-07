<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-dark-green">
                Edit Posko
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Perbarui informasi titik posko pengumpulan.
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

                {{-- Header --}}
                <div class="border-b border-gray-100 px-6 py-6 sm:px-8">
                    <div>
                        <span class="inline-flex rounded-full bg-sage/20 px-3 py-1 text-xs font-semibold text-dark-green">
                            Edit Posko
                        </span>

                        <h1 class="mt-3 text-xl font-bold text-gray-800">
                            {{ $dropPoint->name }}
                        </h1>

                        <p class="mt-1 text-sm text-gray-500">
                            Perbarui data posko sesuai informasi terbaru.
                        </p>
                    </div>
                </div>


                <form action="{{ route('admin.drop-points.update', $dropPoint->id) }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

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
                                   value="{{ old('name', $dropPoint->name) }}"
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
                                      class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none transition focus:border-dark-green focus:ring-2 focus:ring-dark-green/10"
                                      required>{{ old('address', $dropPoint->address) }}</textarea>

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
                                       value="{{ old('city', $dropPoint->city) }}"
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
                                       value="{{ old('pic_name', $dropPoint->pic_name) }}"
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
                                       value="{{ old('pic_phone', $dropPoint->pic_phone) }}"
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
                                       value="{{ old('operating_hours', $dropPoint->operating_hours) }}"
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

                            @if($dropPoint->photo)

                                <div class="mb-4">
                                    <p class="mb-2 text-xs font-medium text-gray-500">
                                        Foto saat ini
                                    </p>

                                    <img src="{{ asset('storage/' . $dropPoint->photo) }}"
                                         alt="{{ $dropPoint->name }}"
                                         class="h-40 w-64 rounded-xl object-cover shadow-sm">
                                </div>

                            @endif

                            <input type="file"
                                   id="photo"
                                   name="photo"
                                   accept="image/*"
                                   class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm">

                            <p class="mt-2 text-xs text-gray-500">
                                Kosongkan jika tidak ingin mengganti foto. Format gambar maksimal 2 MB.
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
                                   value="{{ old('maps_url', $dropPoint->maps_url) }}"
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
                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>