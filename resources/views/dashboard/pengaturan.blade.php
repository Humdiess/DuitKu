<x-dashboard-layout>
    <x-slot name="pageTitle">Pengaturan</x-slot>

    <!-- Header -->
    <div class="mb-6 fade-in-ios">
        <h1 class="text-ios-title text-primary-ios mb-1">Pengaturan</h1>
        <p class="text-ios-body text-secondary-ios">Kelola preferensi aplikasi</p>
    </div>

    <div class="max-w-2xl space-y-6">
        <!-- Account Section -->
        <div class="glass glass-static p-4 fade-in-ios" style="animation-delay: 0.1s">
            <h3 class="text-ios-headline text-primary-ios mb-4">Akun</h3>
            
            <div class="space-y-4">
                <a href="#" class="flex items-center justify-between p-3 rounded-xl hover:bg-[var(--fill-primary)] transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="icon-ios-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-accent-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-ios-body text-primary-ios">Profil</p>
                            <p class="text-ios-caption text-tertiary-ios">Nama, email, foto</p>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-tertiary-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>

                <div class="separator-ios"></div>

                <a href="#" class="flex items-center justify-between p-3 rounded-xl hover:bg-[var(--fill-primary)] transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="icon-ios-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-accent-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-ios-body text-primary-ios">Keamanan</p>
                            <p class="text-ios-caption text-tertiary-ios">Password, 2FA</p>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-tertiary-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Preferences Section -->
        <div class="glass glass-static p-4 fade-in-ios" style="animation-delay: 0.15s">
            <h3 class="text-ios-headline text-primary-ios mb-4">Preferensi</h3>
            
            <div class="space-y-4">
                <!-- Theme -->
                <div class="flex items-center justify-between p-3">
                    <div class="flex items-center gap-3">
                        <div class="icon-ios-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-accent-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-ios-body text-primary-ios">Tema</p>
                            <p class="text-ios-caption text-tertiary-ios">Tampilan aplikasi</p>
                        </div>
                    </div>
                    <select class="input-ios w-auto">
                        <option>Dark</option>
                        <option>Light</option>
                        <option>System</option>
                    </select>
                </div>

                <div class="separator-ios"></div>

                <!-- Currency -->
                <div class="flex items-center justify-between p-3">
                    <div class="flex items-center gap-3">
                        <div class="icon-ios-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-accent-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-ios-body text-primary-ios">Mata Uang</p>
                            <p class="text-ios-caption text-tertiary-ios">Format currency</p>
                        </div>
                    </div>
                    <select class="input-ios w-auto">
                        <option>IDR (Rp)</option>
                        <option>USD ($)</option>
                        <option>EUR (€)</option>
                    </select>
                </div>

                <div class="separator-ios"></div>

                <!-- Language -->
                <div class="flex items-center justify-between p-3">
                    <div class="flex items-center gap-3">
                        <div class="icon-ios-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-accent-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-ios-body text-primary-ios">Bahasa</p>
                            <p class="text-ios-caption text-tertiary-ios">Pilih bahasa</p>
                        </div>
                    </div>
                    <select class="input-ios w-auto">
                        <option>Indonesia</option>
                        <option>English</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Notifications Section -->
        <div class="glass glass-static p-4 fade-in-ios" style="animation-delay: 0.2s">
            <h3 class="text-ios-headline text-primary-ios mb-4">Notifikasi</h3>
            
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3">
                    <div class="flex items-center gap-3">
                        <div class="icon-ios-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-accent-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-ios-body text-primary-ios">Pengingat Harian</p>
                            <p class="text-ios-caption text-tertiary-ios">Ingatkan untuk mencatat transaksi</p>
                        </div>
                    </div>
                    <input type="checkbox" class="toggle toggle-primary" checked>
                </div>

                <div class="separator-ios"></div>

                <div class="flex items-center justify-between p-3">
                    <div class="flex items-center gap-3">
                        <div class="icon-ios-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-accent-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-ios-body text-primary-ios">Peringatan Budget</p>
                            <p class="text-ios-caption text-tertiary-ios">Notifikasi saat mendekati limit</p>
                        </div>
                    </div>
                    <input type="checkbox" class="toggle toggle-primary" checked>
                </div>
            </div>
        </div>

        <!-- Data Section -->
        <div class="glass glass-static p-4 fade-in-ios" style="animation-delay: 0.25s">
            <h3 class="text-ios-headline text-primary-ios mb-4">Data</h3>
            
            <div class="space-y-4">
                <a href="#" class="flex items-center justify-between p-3 rounded-xl hover:bg-[var(--fill-primary)] transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="icon-ios-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-accent-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-ios-body text-primary-ios">Export Data</p>
                            <p class="text-ios-caption text-tertiary-ios">Download data Anda</p>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-tertiary-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>

                <div class="separator-ios"></div>

                <a href="#" class="flex items-center justify-between p-3 rounded-xl hover:bg-[var(--fill-primary)] transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="icon-ios-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-ios-body text-red-ios">Hapus Semua Data</p>
                            <p class="text-ios-caption text-tertiary-ios">Hapus semua transaksi</p>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-tertiary-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- App Info -->
        <div class="text-center py-4 fade-in-ios" style="animation-delay: 0.3s">
            <p class="text-ios-caption text-tertiary-ios">DuitKu v1.0.0</p>
            <p class="text-ios-caption text-tertiary-ios">Made with ❤️</p>
        </div>
    </div>
</x-dashboard-layout>
