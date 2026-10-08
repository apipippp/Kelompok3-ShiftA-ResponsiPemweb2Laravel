<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="bg-cream py-10">

        <div class="mx-auto max-w-7xl px-6">

            <div class="mb-8">
                <h1 class="text-3xl font-bold text-dark-green">
                    Dashboard Lemari Peduli
                </h1>

                <p class="mt-2 text-gray-600">
                    Ringkasan aktivitas pengelolaan donasi dan penyaluran pakaian.
                </p>
            </div>

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">

                <div class="rounded-2xl bg-white p-6 shadow">
                    <p class="text-sm text-gray-500">
                        Total Donasi
                    </p>

                    <h3 class="mt-2 text-3xl font-bold text-dark-green">
                        {{ $totalDonations }}
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        pcs pakaian
                    </p>
                </div>

                <div class="rounded-2xl bg-white p-6 shadow">
                    <p class="text-sm text-gray-500">
                        Total Disalurkan
                    </p>

                    <h3 class="mt-2 text-3xl font-bold text-dark-green">
                        {{ $totalDistributedItems }}
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        pcs pakaian
                    </p>
                </div>

                <div class="rounded-2xl bg-white p-6 shadow">
                    <p class="text-sm text-gray-500">
                        Kegiatan Penyaluran
                    </p>

                    <h3 class="mt-2 text-3xl font-bold text-dark-green">
                        {{ $totalDistributions }}
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        kegiatan
                    </p>
                </div>

                <div class="rounded-2xl bg-white p-6 shadow">
                    <p class="text-sm text-gray-500">
                        Posko Aktif
                    </p>

                    <h3 class="mt-2 text-3xl font-bold text-dark-green">
                        {{ $totalDropPoints }}
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        lokasi
                    </p>
                </div>

            </div>

            <div class="mt-8 grid gap-6 md:grid-cols-2">

                <div class="rounded-2xl bg-white p-6 shadow">
                    <h3 class="text-xl font-bold text-dark-green">
                        Kelola Penyaluran
                    </h3>

                    <p class="mt-2 text-gray-600">
                        Tambahkan dokumentasi penyaluran bantuan pakaian
                        kepada penerima bantuan.
                    </p>

                    <a
                        href="{{ route('admin.distributions.index') }}"
                        class="mt-5 inline-block rounded-lg bg-dark-green px-5 py-3 text-white hover:bg-sage"
                    >
                        Kelola Laporan
                    </a>
                </div>

                <div class="rounded-2xl bg-white p-6 shadow">
                    <h3 class="text-xl font-bold text-dark-green">
                        Lihat Laporan Publik
                    </h3>

                    <p class="mt-2 text-gray-600">
                        Lihat dokumentasi penyaluran yang dapat diakses oleh masyarakat.
                    </p>

                    <a
                        href="{{ route('laporan.public') }}"
                        class="mt-5 inline-block rounded-lg bg-sage px-5 py-3 text-white hover:bg-dark-green"
                    >
                        Lihat Laporan
                    </a>
                </div>

            </div>

        </div>

    </div>

</x-app-layout>
