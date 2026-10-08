<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Lemari Peduli</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-cream text-gray-800">

    <nav class="bg-white shadow-sm">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5">

            <a href="/" class="text-2xl font-bold text-dark-green">
                Lemari Peduli
            </a>

            <div class="flex items-center gap-5">

                <a href="/laporan"
                   class="text-gray-700 hover:text-dark-green">
                    Laporan Penyaluran
                </a>

                @auth
                    <a
                        href="{{ route('dashboard') }}"
                        class="rounded-lg bg-dark-green px-4 py-2 text-white"
                    >
                        Dashboard
                    </a>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="text-gray-700"
                    >
                        Login
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="rounded-lg bg-dark-green px-4 py-2 text-white"
                    >
                        Daftar
                    </a>
                @endauth

            </div>

        </div>
    </nav>

    <section class="bg-dark-green">
        <div class="mx-auto max-w-7xl px-6 py-24">

            <div class="max-w-3xl">

                <span class="rounded-full bg-sage px-4 py-2 text-sm text-white">
                    Berbagi Kebaikan
                </span>

                <h1 class="mt-6 text-5xl font-bold text-white">
                    Pakaian Layak,
                    <br>
                    Kebaikan Tanpa Batas.
                </h1>

                <p class="mt-6 text-lg leading-relaxed text-green-100">
                    Lemari Peduli menjadi wadah untuk menghubungkan
                    pakaian layak pakai dengan masyarakat yang membutuhkan.
                </p>

                <div class="mt-8 flex gap-4">

                    <a
                        href="/tracking"
                        class="rounded-lg bg-sage px-6 py-3 font-semibold text-white"
                    >
                        Donasikan Sekarang
                    </a>

                    <a
                        href="/laporan"
                        class="rounded-lg border border-white px-6 py-3 font-semibold text-white"
                    >
                        Lihat Penyaluran
                    </a>

                </div>

            </div>

        </div>
    </section>

    <section class="py-20">

        <div class="mx-auto max-w-7xl px-6">

            <div class="mb-12 text-center">
                <h2 class="text-3xl font-bold text-dark-green">
                    Bagaimana Lemari Peduli Bekerja?
                </h2>

                <p class="mt-3 text-gray-600">
                    Setiap pakaian yang diberikan memiliki nilai bagi orang lain.
                </p>
            </div>

            <div class="grid gap-6 md:grid-cols-3">

                <div class="rounded-2xl bg-white p-8 shadow">
                    <div class="text-3xl">01</div>

                    <h3 class="mt-4 text-xl font-bold text-dark-green">
                        Donasikan
                    </h3>

                    <p class="mt-3 text-gray-600">
                        Berikan pakaian layak pakai yang sudah tidak digunakan.
                    </p>
                </div>

                <div class="rounded-2xl bg-white p-8 shadow">
                    <div class="text-3xl">02</div>

                    <h3 class="mt-4 text-xl font-bold text-dark-green">
                        Kami Kelola
                    </h3>

                    <p class="mt-3 text-gray-600">
                        Pakaian dikumpulkan dan dikelola agar dapat disalurkan
                        kepada penerima yang tepat.
                    </p>
                </div>

                <div class="rounded-2xl bg-white p-8 shadow">
                    <div class="text-3xl">03</div>

                    <h3 class="mt-4 text-xl font-bold text-dark-green">
                        Disalurkan
                    </h3>

                    <p class="mt-3 text-gray-600">
                        Bantuan disalurkan kepada masyarakat yang membutuhkan
                        secara transparan.
                    </p>
                </div>

            </div>

        </div>

    </section>

    <section class="bg-white py-20">

        <div class="mx-auto max-w-7xl px-6 text-center">

            <h2 class="text-3xl font-bold text-dark-green">
                Bersama Membuat Perubahan
            </h2>

            <p class="mx-auto mt-4 max-w-2xl text-gray-600">
                Satu pakaian yang kita berikan mungkin sederhana,
                tetapi dapat menjadi bantuan yang berarti bagi orang lain.
            </p>

            <a
                href="/tracking"
                class="mt-8 inline-block rounded-lg bg-dark-green px-7 py-3 font-semibold text-white"
            >
                Mulai Berdonasi
            </a>

        </div>

    </section>

    <footer class="bg-dark-green py-8 text-center text-white">
        <p>
            © {{ date('Y') }} Lemari Peduli
        </p>
    </footer>

</body>
</html>
