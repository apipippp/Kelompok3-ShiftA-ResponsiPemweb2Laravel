<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-dark-green leading-tight">
                    {{ $user->role === 'admin' ? __('Kelola Seluruh Donasi Pakaian (Admin)') : __('Riwayat Donasi Pakaian Saya') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    {{ $user->role === 'admin'
                        ? 'Pantau dan verifikasi setiap pakaian yang masuk dari para donatur.'
                        : 'Pantau status pakaian yang Anda sumbangkan secara transparan dan berkala.' }}
                </p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('donations.track') }}"
                   class="inline-flex items-center px-4 py-2 border border-warm-brown/40 rounded-xl text-sm font-semibold text-warm-brown hover:bg-warm-brown hover:text-white transition">
                    <svg class="w-4 h-4 me-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Lacak Resi
                </a>
                <a href="{{ route('donations.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-dark-green text-white rounded-xl text-sm font-semibold hover:bg-sage transition shadow-sm">
                    <svg class="w-4 h-4 me-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Ajukan Donasi Baru
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-cream/40 min-h-[calc(100vh-140px)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Flash Alert -->
            @if (session('success'))
                <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center justify-between shadow-sm">
                    <div class="flex items-center space-x-2">
                        <span class="text-lg">✅</span>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900 font-bold">&times;</button>
                </div>
            @endif

            @if (session('error'))
                <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm flex items-center justify-between shadow-sm">
                    <div class="flex items-center space-x-2">
                        <span class="text-lg">⚠️</span>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-rose-600 hover:text-rose-900 font-bold">&times;</button>
                </div>
            @endif

            <!-- Kartu Metrik Ringkas -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                <a href="{{ route('donations.index') }}"
                   class="p-4 rounded-2xl bg-white border border-sage/30 hover:border-dark-green transition shadow-sm flex flex-col justify-between">
                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Donasi</span>
                    <span class="text-2xl font-black text-dark-green mt-2">{{ $stats['total'] }}</span>
                </a>

                <a href="{{ route('donations.index', ['status' => 'menunggu']) }}"
                   class="p-4 rounded-2xl bg-white border border-amber-200 hover:border-amber-400 transition shadow-sm flex flex-col justify-between">
                    <span class="text-xs font-semibold text-amber-700 uppercase tracking-wider">Menunggu</span>
                    <span class="text-2xl font-black text-amber-600 mt-2">{{ $stats['menunggu'] }}</span>
                </a>

                <a href="{{ route('donations.index', ['status' => 'diverifikasi']) }}"
                   class="p-4 rounded-2xl bg-white border border-blue-200 hover:border-blue-400 transition shadow-sm flex flex-col justify-between">
                    <span class="text-xs font-semibold text-blue-700 uppercase tracking-wider">Diverifikasi</span>
                    <span class="text-2xl font-black text-blue-600 mt-2">{{ $stats['diverifikasi'] }}</span>
                </a>

                <a href="{{ route('donations.index', ['status' => 'diterima']) }}"
                   class="p-4 rounded-2xl bg-white border border-sage/40 hover:border-dark-green transition shadow-sm flex flex-col justify-between">
                    <span class="text-xs font-semibold text-dark-green uppercase tracking-wider">Di Posko</span>
                    <span class="text-2xl font-black text-dark-green mt-2">{{ $stats['diterima'] }}</span>
                </a>

                <a href="{{ route('donations.index', ['status' => 'disalurkan']) }}"
                   class="p-4 rounded-2xl bg-white border border-emerald-200 hover:border-emerald-400 transition shadow-sm flex flex-col justify-between col-span-2 sm:col-span-1">
                    <span class="text-xs font-semibold text-emerald-700 uppercase tracking-wider">Disalurkan</span>
                    <span class="text-2xl font-black text-emerald-600 mt-2">{{ $stats['disalurkan'] }}</span>
                </a>
            </div>

            <!-- Filter & Search Bar -->
            <div class="bg-white rounded-2xl border border-sage/30 p-4 shadow-sm">
                <form action="{{ route('donations.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <!-- Search Input -->
                    <div class="relative flex-1">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari kode tracking, nama donatur, atau pakaian..."
                               class="w-full ps-10 pe-4 py-2.5 rounded-xl border-gray-300 text-sm focus:border-sage focus:ring focus:ring-sage/20 transition">
                        <svg class="w-4 h-4 text-gray-400 absolute start-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    <!-- Filter Status -->
                    <div class="flex items-center space-x-2 overflow-x-auto pb-1 md:pb-0">
                        <select name="status"
                                onchange="this.form.submit()"
                                class="rounded-xl border-gray-300 text-sm py-2.5 focus:border-sage focus:ring focus:ring-sage/20 text-gray-700">
                            <option value="semua" {{ request('status') == 'semua' || !request('status') ? 'selected' : '' }}>Semua Status</option>
                            <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                            <option value="diverifikasi" {{ request('status') == 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                            <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima di Posko</option>
                            <option value="disalurkan" {{ request('status') == 'disalurkan' ? 'selected' : '' }}>Telah Disalurkan</option>
                            <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>

                        <button type="submit"
                                class="px-4 py-2.5 bg-dark-green text-white rounded-xl text-sm font-semibold hover:bg-sage transition">
                            Cari
                        </button>

                        @if (request('search') || request('status'))
                            <a href="{{ route('donations.index') }}"
                               class="px-3 py-2.5 text-xs text-gray-500 hover:text-dark-green underline transition">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Tabel Data Donasi -->
            <div class="bg-white rounded-2xl border border-sage/30 shadow-sm overflow-hidden">
                @if ($donations->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-cream/60 border-b border-sage/20 text-dark-green text-xs font-bold uppercase tracking-wider">
                                    <th class="py-4 px-6">Kode & Tanggal</th>
                                    <th class="py-4 px-6">Donatur</th>
                                    <th class="py-4 px-6">Pakaian</th>
                                    <th class="py-4 px-6">Metode</th>
                                    <th class="py-4 px-6">Status</th>
                                    <th class="py-4 px-6 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                                @foreach ($donations as $donation)
                                    <tr class="hover:bg-cream/20 transition">
                                        <!-- Kode Tracking -->
                                        <td class="py-4 px-6 whitespace-nowrap">
                                            <div class="font-mono font-bold text-dark-green text-sm">
                                                {{ $donation->tracking_code }}
                                            </div>
                                            <div class="text-xs text-gray-400 mt-0.5">
                                                {{ $donation->created_at->format('d M Y, H:i') }}
                                            </div>
                                        </td>

                                        <!-- Info Donatur -->
                                        <td class="py-4 px-6">
                                            <div class="font-semibold text-gray-900">{{ $donation->donor_name }}</div>
                                            <div class="text-xs text-warm-brown mt-0.5 font-mono">📱 {{ $donation->donor_phone }}</div>
                                        </td>

                                        <!-- Pakaian & Jumlah -->
                                        <td class="py-4 px-6">
                                            <div class="flex items-center space-x-3">
                                                @if ($donation->photo)
                                                    <img src="{{ asset('storage/' . $donation->photo) }}"
                                                         alt="Foto"
                                                         class="w-12 h-12 rounded-lg object-cover border border-sage/40 flex-shrink-0">
                                                @else
                                                    <div class="w-12 h-12 rounded-lg bg-cream flex items-center justify-center text-lg border border-sage/30 flex-shrink-0">
                                                        👕
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="font-semibold text-gray-900">{{ $donation->clothing_type }}</div>
                                                    <div class="text-xs text-gray-500">
                                                        <span class="font-bold text-dark-green">{{ $donation->quantity }}</span> potong • {{ $donation->condition_label }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Metode -->
                                        <td class="py-4 px-6 whitespace-nowrap">
                                            <span class="inline-flex items-center text-xs font-medium text-gray-600 bg-gray-100 px-2.5 py-1 rounded-lg">
                                                {{ $donation->delivery_method === 'antar_posko' ? '📍 Posko' : '📦 Ekspedisi' }}
                                            </span>
                                        </td>

                                        <!-- Status Badge -->
                                        <td class="py-4 px-6 whitespace-nowrap">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border {{ $donation->status_badge_class }}">
                                                {{ $donation->status_label }}
                                            </span>
                                        </td>

                                        <!-- Aksi -->
                                        <td class="py-4 px-6 whitespace-nowrap text-center">
                                            <div class="inline-flex items-center space-x-2">
                                                <!-- Tombol Detail -->
                                                <a href="{{ route('donations.show', $donation) }}"
                                                   class="p-2 rounded-lg bg-sage/20 text-dark-green hover:bg-dark-green hover:text-white transition"
                                                   title="Lihat Detail & Tracking">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>

                                                <!-- Tombol Cetak Resi/Label -->
                                                <a href="{{ route('donations.print', $donation) }}"
                                                   target="_blank"
                                                   class="p-2 rounded-lg bg-warm-brown/10 text-warm-brown hover:bg-warm-brown hover:text-white transition"
                                                   title="Cetak Label Paket Pakaian">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                                    </svg>
                                                </a>

                                                <!-- Edit (Hanya jika menunggu) -->
                                                @if ($donation->status === 'menunggu' || $user->role === 'admin')
                                                    <a href="{{ route('donations.edit', $donation) }}"
                                                       class="p-2 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-600 hover:text-white transition"
                                                       title="Edit Data Donasi">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>
                                                @endif

                                                <!-- Batalkan / Hapus (Hanya jika menunggu atau admin) -->
                                                @if ($donation->status === 'menunggu' || $user->role === 'admin')
                                                    <form action="{{ route('donations.destroy', $donation) }}"
                                                          method="POST"
                                                          onsubmit="return confirm('Apakah Anda yakin ingin membatalkan donasi ini?')"
                                                          class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="p-2 rounded-lg bg-rose-50 text-rose-700 hover:bg-rose-600 hover:text-white transition"
                                                                title="Batalkan Donasi">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-gray-100 bg-cream/20">
                        {{ $donations->links() }}
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="p-12 text-center">
                        <div class="w-20 h-20 bg-cream mx-auto rounded-full flex items-center justify-center text-4xl mb-4 border border-sage/40">
                            📦
                        </div>
                        <h4 class="text-lg font-bold text-dark-green">Belum Ada Donasi Pakaian</h4>
                        <p class="text-sm text-gray-500 max-w-md mx-auto mt-1">
                            {{ request('search') || request('status')
                                ? 'Tidak ditemukan donasi yang cocok dengan kriteria pencarian Anda.'
                                : 'Anda belum mengajukan donasi pakaian. Mulai donasikan pakaian bekas layak pakai Anda hari ini!' }}
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('donations.create') }}"
                               class="inline-flex items-center px-5 py-2.5 bg-dark-green text-white rounded-xl text-sm font-semibold hover:bg-sage transition shadow-sm">
                                <svg class="w-4 h-4 me-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Ajukan Donasi Sekarang
                            </a>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
