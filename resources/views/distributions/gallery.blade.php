<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Penyaluran - Lemari Peduli</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-cream text-gray-800">

    <nav class="border-b bg-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
            <a href="/" class="text-xl font-bold text-dark-green">
                Lemari Peduli
            </a>

            <a
                href="/"
                class="text-sm font-medium text-gray-700 hover:text-dark-green"
            >
                Beranda
            </a>
        </div>
    </nav>

    <main class="mx-auto max-w-7xl px-6 py-12">

        <div class="mb-10 text-center">
            <h1 class="text-4xl font-bold text-dark-green">
                Laporan Penyaluran
            </h1>

            <p class="mx-auto mt-3 max-w-2xl text-gray-600">
                Dokumentasi penyaluran pakaian kepada masyarakat,
                panti asuhan, dan penerima bantuan.
            </p>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">

            @forelse($distributions as $distribution)

                <div class="overflow-hidden rounded-2xl bg-white shadow">

                    <img
                        src="{{ asset('storage/' . $distribution->proof_photo) }}"
                        class="h-56 w-full object-cover"
                        alt="Dokumentasi penyaluran"
                    >

                    <div class="p-6">

                        <h2 class="text-xl font-bold text-dark-green">
                            {{ $distribution->recipient_name }}
                        </h2>

                        <p class="mt-2 text-sm text-gray-500">
                            {{ $distribution->distribution_date->format('d F Y') }}
                        </p>

                        <div class="mt-4 rounded-lg bg-green-50 p-3">
                            <span class="font-semibold">
                                {{ $distribution->items_count }}
                            </span>
                            pakaian disalurkan
                        </div>

                        <p class="mt-4 text-gray-600">
                            {{ $distribution->description }}
                        </p>

                    </div>
                </div>

            @empty

                <div class="col-span-full py-20 text-center text-gray-500">
                    Belum ada laporan penyaluran.
                </div>

            @endforelse

        </div>

    </main>

</body>
</html>