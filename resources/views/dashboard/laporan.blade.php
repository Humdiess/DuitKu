<x-dashboard-layout>
    <x-slot name="pageTitle">Laporan</x-slot>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 fade-in-ios">
        <div>
            <h1 class="text-ios-title text-primary-ios mb-1">Laporan</h1>
            <p class="text-ios-body text-secondary-ios">Analisis keuangan Anda</p>
        </div>
        <div class="flex gap-3">
            <select class="input-ios">
                <option>Desember 2024</option>
                <option>November 2024</option>
                <option>Oktober 2024</option>
            </select>
            <button class="btn-ios btn-ios-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Export PDF
            </button>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6 fade-in-ios" style="animation-delay: 0.1s">
        <div class="glass p-4">
            <div class="flex items-center gap-3 mb-2">
                <div class="icon-ios-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 11l5-5m0 0l5 5m-5-5v12" />
                    </svg>
                </div>
                <span class="text-ios-caption text-tertiary-ios">Pemasukan</span>
            </div>
            <p class="text-2xl font-semibold text-green-ios">Rp 0</p>
            <p class="text-ios-caption text-tertiary-ios mt-1">+0% dari bulan lalu</p>
        </div>

        <div class="glass p-4">
            <div class="flex items-center gap-3 mb-2">
                <div class="icon-ios-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 13l-5 5m0 0l-5-5m5 5V6" />
                    </svg>
                </div>
                <span class="text-ios-caption text-tertiary-ios">Pengeluaran</span>
            </div>
            <p class="text-2xl font-semibold text-red-ios">Rp 0</p>
            <p class="text-ios-caption text-tertiary-ios mt-1">+0% dari bulan lalu</p>
        </div>

        <div class="glass p-4">
            <div class="flex items-center gap-3 mb-2">
                <div class="icon-ios-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-accent-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <span class="text-ios-caption text-tertiary-ios">Selisih</span>
            </div>
            <p class="text-2xl font-semibold text-primary-ios">Rp 0</p>
            <p class="text-ios-caption text-tertiary-ios mt-1">Balance bulan ini</p>
        </div>

        <div class="glass p-4">
            <div class="flex items-center gap-3 mb-2">
                <div class="icon-ios-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
                <span class="text-ios-caption text-tertiary-ios">Transaksi</span>
            </div>
            <p class="text-2xl font-semibold text-primary-ios">0</p>
            <p class="text-ios-caption text-tertiary-ios mt-1">Total transaksi</p>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid lg:grid-cols-2 gap-4 mb-6">
        <!-- Income vs Expense Chart -->
        <div class="glass glass-static p-4 fade-in-ios" style="animation-delay: 0.2s">
            <h3 class="text-ios-headline text-primary-ios mb-4">Pemasukan vs Pengeluaran</h3>
            <div class="h-64 flex items-center justify-center">
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-tertiary-ios mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <p class="text-ios-caption text-tertiary-ios">Belum ada data untuk ditampilkan</p>
                </div>
            </div>
        </div>

        <!-- Category Breakdown -->
        <div class="glass glass-static p-4 fade-in-ios" style="animation-delay: 0.25s">
            <h3 class="text-ios-headline text-primary-ios mb-4">Pengeluaran per Kategori</h3>
            <div class="h-64 flex items-center justify-center">
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-tertiary-ios mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                    </svg>
                    <p class="text-ios-caption text-tertiary-ios">Belum ada data untuk ditampilkan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Daily Trend -->
    <div class="glass glass-static p-4 fade-in-ios" style="animation-delay: 0.3s">
        <h3 class="text-ios-headline text-primary-ios mb-4">Tren Harian</h3>
        <div class="h-48 flex items-center justify-center">
            <div class="text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-tertiary-ios mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                </svg>
                <p class="text-ios-caption text-tertiary-ios">Tambahkan transaksi untuk melihat tren</p>
            </div>
        </div>
    </div>
</x-dashboard-layout>
