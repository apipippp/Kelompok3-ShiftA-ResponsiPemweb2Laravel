<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Laporan Penyaluran
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 rounded-lg bg-green-100 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6 flex justify-end">
                <a href="{{ route('admin.distributions.create') }}"
                   class="rounded-lg bg-dark-green px-5 py-3 text-white hover:bg-sage">
                    + Tambah Penyaluran
                </a>
            </div>

            <div class="overflow-hidden rounded-xl bg-white shadow">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-left">Penerima</th>
                                <th class="px-6 py-4 text-left">Tanggal</th>
                                <th class="px-6 py-4 text-left">Jumlah</th>
                                <th class="px-6 py-4 text-left">Foto</th>
                                <th class="px-6 py-4 text-left">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($distributions as $distribution)
                                <tr class="border-b">
                                    <td class="px-6 py-4">
                                        {{ $distribution->recipient_name }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $distribution->distribution_date->format('d-m-Y') }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $distribution->items_count }} pcs
                                    </td>

                                    <td class="px-6 py-4">
                                        <img
                                            src="{{ asset('storage/' . $distribution->proof_photo) }}"
                                            class="h-16 w-20 rounded object-cover"
                                            alt="Dokumentasi"
                                        >
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex gap-2">
                                            <a
                                                href="{{ route('admin.distributions.edit', $distribution) }}"
                                                class="rounded bg-yellow-500 px-3 py-2 text-white"
                                            >
                                                Edit
                                            </a>

                                            <form
                                                action="{{ route('admin.distributions.destroy', $distribution) }}"
                                                method="POST"
                                                onsubmit="return confirm('Hapus data ini?')"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="rounded bg-red-600 px-3 py-2 text-white"
                                                >
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                        Belum ada data penyaluran.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>