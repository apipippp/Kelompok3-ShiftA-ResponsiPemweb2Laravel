<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-dark-green">
                Detail Posko
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Informasi lengkap titik posko pengumpulan.
            </p>
        </div>
    </x-slot>

    <div class="min-h-screen bg-cream py-10">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

            {{-- Tombol kembali --}}
            <div class="mb-6">
                <a href="{{ route('admin.drop-points.index') }}"
                   class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 transition hover:text-dark-green">
                    ← Kembali ke Daftar Posko
                </a>
            </div>

            {{-- Card utama --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-black/5">

                {{-- Header --}}
                <div class="border-b border-gray-100 px-6 py-6 sm:px-8">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                        <div>
                            <span class="inline-flex rounded-full bg-sage/20 px-3 py-1 text-xs font-semibold text-dark-green">
                                Titik Posko
                            </span>

                            <h1 class="mt-3 text-2xl font-bold text-gray-800">
                                {{ $dropPoint->name }}
                            </h1>

                            <p class="mt-1 text-sm text-gray-500">
                                {{ $dropPoint->city }}
                            </p>
                        </div>

                        {{-- Aksi --}}
                        <div class="flex gap-2">
                            <a href="{{ route('admin.drop-points.edit', $dropPoint->id) }}"
                               class="inline-flex items-center rounded-lg bg-sage/20 px-4 py-2 text-sm font-semibold text-dark-green transition hover:bg-sage/30">
                                Edit
                            </a>

                            <form action="{{ route('admin.drop-points.destroy', $dropPoint->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus posko ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="inline-flex items-center rounded-lg bg-red-50 px-4 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-100">
                                    Hapus
                                </button>

                            </form>
                        </div>

                    </div>
                </div>


                {{-- Isi --}}
                <div class="grid grid-cols-1 gap-8 p-6 sm:p-8 lg:grid-cols-2">

                    {{-- Foto --}}
                    <div>

                        <h3 class="mb-4 text-lg font-bold text-gray-800">
                            Foto Posko
                        </h3>

                        @if($dropPoint->photo)

                            <img src="{{ asset('storage/' . $dropPoint->photo) }}"
                                 alt="{{ $dropPoint->name }}"
                                 class="h-72 w-full rounded-2xl object-cover shadow-sm">

                        @else

                            <div class="flex h-72 w-full items-center justify-center rounded-2xl bg-sage/20">
                                <div class="text-center">
                                    <div class="text-4xl">📍</div>
                                    <p class="mt-3 text-sm font-medium text-gray-500">
                                        Belum ada foto posko
                                    </p>
                                </div>
                            </div>

                        @endif

                    </div>


                    {{-- Informasi --}}
                    <div>

                        <h3 class="mb-4 text-lg font-bold text-gray-800">
                            Informasi Posko
                        </h3>

                        <div class="space-y-4">

                            {{-- Alamat --}}
                            <div class="rounded-xl bg-cream/70 p-4">
                                <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    Alamat
                                </p>

                                <p class="mt-1 text-sm leading-relaxed text-gray-800">
                                    {{ $dropPoint->address }}
                                </p>
                            </div>


                            {{-- Kota --}}
                            <div class="rounded-xl bg-cream/70 p-4">
                                <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    Kota
                                </p>

                                <p class="mt-1 text-sm font-medium text-gray-800">
                                    {{ $dropPoint->city }}
                                </p>
                            </div>


                            {{-- PIC --}}
                            <div class="rounded-xl bg-cream/70 p-4">
                                <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    Nama PIC
                                </p>

                                <p class="mt-1 text-sm font-medium text-gray-800">
                                    {{ $dropPoint->pic_name }}
                                </p>

                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $dropPoint->pic_phone }}
                                </p>
                            </div>


                            {{-- Jam operasional --}}
                            <div class="rounded-xl bg-cream/70 p-4">
                                <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    Jam Operasional
                                </p>

                                <p class="mt-1 text-sm text-gray-800">
                                    {{ $dropPoint->operating_hours }}
                                </p>
                            </div>

                        </div>

                    </div>

                </div>


                {{-- Google Maps --}}
                @if($dropPoint->maps_url)

                    <div class="border-t border-gray-100 px-6 py-6 sm:px-8">

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                            <div>
                                <h3 class="font-bold text-gray-800">
                                    Lokasi Posko
                                </h3>

                                <p class="mt-1 text-sm text-gray-500">
                                    Lihat lokasi posko melalui Google Maps.
                                </p>
                            </div>

                            <a href="{{ $dropPoint->maps_url }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="inline-flex items-center justify-center rounded-xl bg-dark-green px-5 py-3 text-sm font-semibold text-white transition hover:opacity-90">
                                Lihat di Google Maps
                            </a>

                        </div>

                    </div>

                @endif

            </div>

        </div>
    </div>

</x-app-layout>