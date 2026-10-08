<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-dark-green">
                Titik Posko Pengumpulan
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Kelola titik posko pengumpulan pakaian layak pakai.
            </p>
        </div>
    </x-slot>

    <div class="min-h-screen bg-cream py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <h1 class="text-3xl font-bold text-dark-green">
                        Daftar Posko
                    </h1>

                    <p class="mt-1 text-gray-600">
                        Kelola informasi titik pengumpulan donasi.
                    </p>
                </div>

                <a href="{{ route('admin.drop-points.create') }}"
                   class="inline-flex items-center justify-center gap-2 rounded-xl bg-dark-green px-5 py-3 font-semibold text-white shadow-sm transition hover:opacity-90">

                    <span class="text-xl">+</span>
                    Tambah Posko

                </a>

            </div>


            {{-- Success Message --}}
            @if(session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
                    {{ session('success') }}
                </div>
            @endif


            {{-- Table Card --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-black/5">

                {{-- Card Header --}}
                <div class="border-b border-gray-100 px-6 py-5">

                    <div class="flex items-center justify-between">

                        <div>
                            <h3 class="text-lg font-bold text-gray-800">
                                Data Titik Posko
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                {{ $dropPoints->count() }} posko terdaftar
                            </p>
                        </div>

                        <div class="rounded-full bg-sage/20 px-4 py-2 text-sm font-semibold text-dark-green">
                            Posko
                        </div>

                    </div>

                </div>


                {{-- Empty State --}}
                @if($dropPoints->count() === 0)

                    <div class="px-6 py-16 text-center">

                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-sage/20 text-3xl">
                            📍
                        </div>

                        <h3 class="mt-5 text-lg font-bold text-gray-800">
                            Belum Ada Posko
                        </h3>

                        <p class="mx-auto mt-2 max-w-md text-sm text-gray-500">
                            Belum ada titik posko yang terdaftar.
                            Tambahkan posko untuk mulai menerima donasi.
                        </p>

                        <a href="{{ route('admin.drop-points.create') }}"
                           class="mt-6 inline-flex rounded-xl bg-dark-green px-5 py-3 font-semibold text-white transition hover:opacity-90">
                            Tambah Posko
                        </a>

                    </div>

                @else

                    {{-- Desktop Table --}}
                    <div class="hidden overflow-x-auto md:block">

                        <table class="w-full">

                            <thead>
                                <tr class="bg-cream/70 text-left text-sm text-gray-600">

                                    <th class="px-6 py-4 font-semibold">
                                        Nama Posko
                                    </th>

                                    <th class="px-6 py-4 font-semibold">
                                        Kota
                                    </th>

                                    <th class="px-6 py-4 font-semibold">
                                        PIC
                                    </th>

                                    <th class="px-6 py-4 text-right font-semibold">
                                        Aksi
                                    </th>

                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">

                                @foreach($dropPoints as $dropPoint)

                                    <tr class="transition hover:bg-cream/40">

                                        {{-- Nama --}}
                                        <td class="px-6 py-5">

                                            <div class="flex items-center gap-4">

                                                @if($dropPoint->photo)

                                                    <img src="{{ asset('storage/' . $dropPoint->photo) }}"
                                                         alt="{{ $dropPoint->name }}"
                                                         class="h-14 w-14 rounded-xl object-cover">

                                                @else

                                                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-sage/20 text-xl">
                                                        📍
                                                    </div>

                                                @endif

                                                <div>

                                                    <p class="font-bold text-gray-800">
                                                        {{ $dropPoint->name }}
                                                    </p>

                                                    <p class="mt-1 text-sm text-gray-500">
                                                        {{ Str::limit($dropPoint->address, 45) }}
                                                    </p>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- Kota --}}
                                        <td class="px-6 py-5">

                                            <span class="rounded-full bg-sage/20 px-3 py-1 text-sm font-medium text-dark-green">
                                                {{ $dropPoint->city }}
                                            </span>

                                        </td>


                                        {{-- PIC --}}
                                        <td class="px-6 py-5">

                                            <p class="font-medium text-gray-800">
                                                {{ $dropPoint->pic_name }}
                                            </p>

                                            <p class="mt-1 text-sm text-gray-500">
                                                {{ $dropPoint->pic_phone }}
                                            </p>

                                        </td>


                                        {{-- Aksi --}}
                                        <td class="px-6 py-5">

                                            <div class="flex justify-end gap-2">

                                                <a href="{{ route('admin.drop-points.show', $dropPoint->id) }}"
                                                   class="rounded-lg border border-gray-200 px-3 py-2 text-sm font-medium text-gray-600 transition hover:bg-gray-50">
                                                    Detail
                                                </a>

                                                <a href="{{ route('admin.drop-points.edit', $dropPoint->id) }}"
                                                   class="rounded-lg bg-sage/20 px-3 py-2 text-sm font-medium text-dark-green transition hover:bg-sage/30">
                                                    Edit
                                                </a>

                                                <form action="{{ route('admin.drop-points.destroy', $dropPoint->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Yakin ingin menghapus posko ini?')">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="rounded-lg bg-red-50 px-3 py-2 text-sm font-medium text-red-600 transition hover:bg-red-100">
                                                        Hapus
                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                    {{-- Mobile Card --}}
                    <div class="space-y-4 p-4 md:hidden">

                        @foreach($dropPoints as $dropPoint)

                            <div class="rounded-xl border border-gray-100 p-4">

                                <div class="flex gap-4">

                                    @if($dropPoint->photo)

                                        <img src="{{ asset('storage/' . $dropPoint->photo) }}"
                                             alt="{{ $dropPoint->name }}"
                                             class="h-16 w-16 rounded-xl object-cover">

                                    @else

                                        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl bg-sage/20 text-xl">
                                            📍
                                        </div>

                                    @endif

                                    <div class="min-w-0">

                                        <h3 class="font-bold text-gray-800">
                                            {{ $dropPoint->name }}
                                        </h3>

                                        <p class="mt-1 text-sm text-gray-500">
                                            {{ $dropPoint->city }}
                                        </p>

                                        <p class="mt-1 text-sm text-gray-500">
                                            PIC: {{ $dropPoint->pic_name }}
                                        </p>

                                    </div>

                                </div>


                                <div class="mt-4 flex gap-2">

                                    <a href="{{ route('admin.drop-points.show', $dropPoint->id) }}"
                                       class="flex-1 rounded-lg border border-gray-200 px-3 py-2 text-center text-sm font-medium text-gray-600">
                                        Detail
                                    </a>

                                    <a href="{{ route('admin.drop-points.edit', $dropPoint->id) }}"
                                       class="flex-1 rounded-lg bg-sage/20 px-3 py-2 text-center text-sm font-medium text-dark-green">
                                        Edit
                                    </a>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @endif

            </div>

        </div>
    </div>

</x-app-layout>