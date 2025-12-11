<x-dashboard-layout>
    <x-slot name="pageTitle">Dashboard</x-slot>

    <!-- Welcome -->
    <div class="mb-6 fade-in-ios">
        <h1 class="text-ios-title text-primary-ios mb-1">
            Halo, {{ auth()->user()->name ?? 'User' }} 👋
        </h1>
        <p class="text-ios-body text-secondary-ios">Ringkasan keuangan Anda</p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-6">
        <!-- Saldo -->
        <div class="glass p-4 fade-in-ios" style="animation-delay: 0.1s">
            <div class="flex items-center justify-between mb-3">
                <div class="icon-ios-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-accent-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="text-green-ios text-ios-caption">+12%</span>
            </div>
            <p class="text-ios-caption text-tertiary-ios mb-1">Total Saldo</p>
            <p class="text-lg font-semibold text-primary-ios">Rp 0</p>
        </div>

        <!-- Pemasukan -->
        <div class="glass p-4 fade-in-ios" style="animation-delay: 0.15s">
            <div class="flex items-center justify-between mb-3">
                <div class="icon-ios-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 11l5-5m0 0l5 5m-5-5v12" />
                    </svg>
                </div>
                <span class="text-ios-caption text-tertiary-ios">Bulan ini</span>
            </div>
            <p class="text-ios-caption text-tertiary-ios mb-1">Pemasukan</p>
            <p class="text-lg font-semibold text-primary-ios">Rp 0</p>
        </div>

        <!-- Pengeluaran -->
        <div class="glass p-4 fade-in-ios" style="animation-delay: 0.2s">
            <div class="flex items-center justify-between mb-3">
                <div class="icon-ios-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 13l-5 5m0 0l-5-5m5 5V6" />
                    </svg>
                </div>
                <span class="text-ios-caption text-tertiary-ios">Bulan ini</span>
            </div>
            <p class="text-ios-caption text-tertiary-ios mb-1">Pengeluaran</p>
            <p class="text-lg font-semibold text-primary-ios">Rp 0</p>
        </div>

        <!-- Tabungan -->
        <div class="glass p-4 fade-in-ios" style="animation-delay: 0.25s">
            <div class="flex items-center justify-between mb-3">
                <div class="icon-ios-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-accent-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
                <span class="text-ios-caption text-tertiary-ios">Target</span>
            </div>
            <p class="text-ios-caption text-tertiary-ios mb-1">Tabungan</p>
            <p class="text-lg font-semibold text-primary-ios">Rp 0</p>
        </div>
    </div>

    <!-- Chart & Recent -->
    <div class="grid lg:grid-cols-3 gap-4 mb-6">
        <!-- Chart -->
        <div class="lg:col-span-2 glass glass-static p-4 fade-in-ios" style="animation-delay: 0.3s">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-ios-headline text-primary-ios">Grafik Keuangan</h2>
                <select class="text-ios-caption bg-[var(--fill-primary)] border-0 rounded-lg px-2 py-1 text-secondary-ios focus:outline-none">
                    <option>7 Hari</option>
                    <option>30 Hari</option>
                </select>
            </div>
            
            <div class="h-48 glass glass-static rounded-xl flex items-center justify-center">
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-tertiary-ios mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <p class="text-ios-caption text-tertiary-ios">Chart muncul di sini</p>
                </div>
            </div>
        </div>

        <!-- Recent -->
        <div class="glass glass-static p-4 fade-in-ios" style="animation-delay: 0.35s">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-ios-headline text-primary-ios">Transaksi Terakhir</h2>
                <a href="#" class="text-ios-caption text-accent-ios">Lihat Semua</a>
            </div>

            <div class="flex flex-col items-center justify-center h-48">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-tertiary-ios mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <p class="text-ios-caption text-tertiary-ios mb-3">Belum ada transaksi</p>
                <button class="btn-ios btn-ios-primary text-sm px-4 py-2">
                    + Tambah
                </button>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="fade-in-ios" style="animation-delay: 0.4s">
        <h2 class="text-ios-headline text-primary-ios mb-3">Aksi Cepat</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            <a href="#" class="glass p-4 text-center">
                <div class="w-10 h-10 mx-auto mb-2 rounded-xl bg-green-500/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <p class="text-ios-caption text-secondary-ios">Pemasukan</p>
            </a>

            <a href="#" class="glass p-4 text-center">
                <div class="w-10 h-10 mx-auto mb-2 rounded-xl bg-red-500/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" />
                    </svg>
                </div>
                <p class="text-ios-caption text-secondary-ios">Pengeluaran</p>
            </a>

            <a href="#" class="glass p-4 text-center">
                <div class="w-10 h-10 mx-auto mb-2 rounded-xl bg-blue-500/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                </div>
                <p class="text-ios-caption text-secondary-ios">Transfer</p>
            </a>

            <a href="#" class="glass p-4 text-center">
                <div class="w-10 h-10 mx-auto mb-2 rounded-xl bg-purple-500/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="text-ios-caption text-secondary-ios">Budget</p>
            </a>
        </div>
    </div>
</x-dashboard-layout>
