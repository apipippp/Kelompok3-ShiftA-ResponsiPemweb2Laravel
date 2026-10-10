<div class="sticky top-4 z-50 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full transition-all duration-500 ease-luxury">
    <nav x-data="{ open: false }" class="fluid-glass rounded-3xl sm:rounded-full px-4 sm:px-6 py-2 transition-all duration-500 ease-luxury">
        <div class="flex items-center justify-between h-14">

            <!-- Brand Logo & Identity -->
            <div class="flex items-center space-x-3">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 rounded-full bg-sand/60 p-1 flex items-center justify-center border border-black/5 group-hover:scale-105 transition-transform duration-500 ease-luxury shadow-inner">
                        <x-application-logo class="w-full h-full object-contain" />
                    </div>
                    <div class="hidden sm:flex flex-col">
                        <span class="font-extrabold text-base text-forest tracking-tight leading-tight">Lemari Peduli</span>
                        <span class="text-[9px] font-bold text-warm-brown uppercase tracking-widest">Eco Wardrobe</span>
                    </div>
                </a>
            </div>

            <!-- Desktop Nav Links (Pills with subtle active state) -->
            <div class="hidden md:flex items-center space-x-1 lg:space-x-2">
                <a href="{{ route('dashboard') }}"
                   class="px-4 py-2 rounded-full text-xs font-bold transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-forest text-white shadow-ambient-sm' : 'text-gray-600 hover:text-forest hover:bg-sand/40' }}">
                    {{ Auth::user()->role === 'admin' ? 'Dashboard Admin' : 'Portal Donatur' }}
                </a>

                <a href="{{ route('donations.index') }}"
                   class="px-4 py-2 rounded-full text-xs font-bold transition-all duration-300 {{ request()->routeIs('donations.*') ? 'bg-forest text-white shadow-ambient-sm' : 'text-gray-600 hover:text-forest hover:bg-sand/40' }}">
                    {{ Auth::user()->role === 'admin' ? 'Kelola Donasi' : 'Donasi Saya' }}
                </a>

                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('admin.drop-points.index') }}"
                       class="px-4 py-2 rounded-full text-xs font-bold transition-all duration-300 {{ request()->routeIs('admin.drop-points.*') ? 'bg-forest text-white shadow-ambient-sm' : 'text-gray-600 hover:text-forest hover:bg-sand/40' }}">
                        Kelola Posko
                    </a>
                @else
                    <a href="{{ route('posko.public') }}"
                       class="px-4 py-2 rounded-full text-xs font-bold transition-all duration-300 {{ request()->routeIs('posko.*') ? 'bg-forest text-white shadow-ambient-sm' : 'text-gray-600 hover:text-forest hover:bg-sand/40' }}">
                        Titik Posko
                    </a>
                @endif

                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('admin.distributions.index') }}"
                       class="px-4 py-2 rounded-full text-xs font-bold transition-all duration-300 {{ request()->routeIs('admin.distributions.*') ? 'bg-forest text-white shadow-ambient-sm' : 'text-gray-600 hover:text-forest hover:bg-sand/40' }}">
                        Kelola Penyaluran
                    </a>
                @else
                    <a href="{{ route('laporan.public') }}"
                       class="px-4 py-2 rounded-full text-xs font-bold transition-all duration-300 {{ request()->routeIs('laporan.*') ? 'bg-forest text-white shadow-ambient-sm' : 'text-gray-600 hover:text-forest hover:bg-sand/40' }}">
                        Laporan Penyaluran
                    </a>
                @endif
            </div>

            <!-- Profile Pill Dropdown & Mobile Hamburger -->
            <div class="flex items-center space-x-3">
                <div class="hidden sm:flex">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-2 pl-3.5 pr-2.5 py-1.5 rounded-full bg-sand/50 hover:bg-sand border border-black/[0.04] text-xs font-bold text-gray-800 transition-all duration-300 active:scale-[0.98]">
                                <span class="truncate max-w-[120px]">{{ Auth::user()->name }}</span>
                                <span class="px-2 py-0.5 rounded-full text-[9px] font-extrabold uppercase tracking-wider {{ Auth::user()->role === 'admin' ? 'bg-forest text-white' : 'bg-sage/20 text-forest border border-sage/40' }}">
                                    {{ Auth::user()->role === 'admin' ? 'Admin' : 'Donatur' }}
                                </span>
                                <svg class="w-3.5 h-3.5 text-gray-400 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="text-xs font-semibold">
                                {{ __('Profil Saya') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="text-xs font-semibold text-rose-600 hover:text-rose-700">
                                    {{ __('Keluar (Log Out)') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger Button (Animated Morph) -->
                <div class="flex items-center md:hidden">
                    <button @click="open = ! open"
                            class="w-10 h-10 rounded-full bg-sand/50 border border-black/5 flex items-center justify-center text-forest transition-colors hover:bg-sand">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer (Glass Morphism Expansion) -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden pt-4 pb-3 border-t border-black/5 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ Auth::user()->role === 'admin' ? __('Dashboard Admin') : __('Portal Donatur') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('donations.index')" :active="request()->routeIs('donations.*')">
                {{ Auth::user()->role === 'admin' ? __('Kelola Donasi') : __('Donasi Saya') }}
            </x-responsive-nav-link>

            @if (Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.drop-points.index')" :active="request()->routeIs('admin.drop-points.*')">
                    {{ __('Kelola Posko') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('posko.public')" :active="request()->routeIs('posko.*')">
                    {{ __('Titik Posko') }}
                </x-responsive-nav-link>
            @endif

            @if (Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.distributions.index')" :active="request()->routeIs('admin.distributions.*')">
                    {{ __('Kelola Penyaluran') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('laporan.public')" :active="request()->routeIs('laporan.*')">
                    {{ __('Laporan Penyaluran') }}
                </x-responsive-nav-link>
            @endif

            <div class="pt-4 pb-2 border-t border-black/5 mt-3">
                <div class="px-4 py-2 flex items-center justify-between">
                    <div>
                        <div class="font-bold text-sm text-forest">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                    <span class="px-2 py-0.5 rounded-full text-[9px] font-extrabold uppercase {{ Auth::user()->role === 'admin' ? 'bg-forest text-white' : 'bg-sage/20 text-forest' }}">
                        {{ ucfirst(Auth::user()->role) }}
                    </span>
                </div>

                <div class="mt-2 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profil Saya') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="text-rose-600 hover:text-rose-700">
                            {{ __('Keluar (Log Out)') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</div>
