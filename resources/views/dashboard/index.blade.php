<x-dashboard-layout>
    <x-slot name="pageTitle">Dashboard</x-slot>

    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white mb-2">
            Selamat Datang, {{ auth()->user()->name ?? 'User' }}! 👋
        </h1>
        <p class="text-gray-400">Berikut ringkasan keuangan Anda hari ini.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Saldo -->
        <div class="glass-card glass-card-hover p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-400 icon-glow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="text-green-400 text-sm font-medium">+12.5%</span>
            </div>
            <p class="text-gray-400 text-sm mb-1">Total Saldo</p>
            <p class="text-2xl font-bold text-white">Rp 0</p>
        </div>

        <!-- Pemasukan Bulan Ini -->
        <div class="glass-card glass-card-hover p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400 icon-glow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12" />
                    </svg>
                </div>
                <span class="text-blue-400 text-sm font-medium">Bulan ini</span>
            </div>
            <p class="text-gray-400 text-sm mb-1">Pemasukan</p>
            <p class="text-2xl font-bold text-white">Rp 0</p>
        </div>

        <!-- Pengeluaran Bulan Ini -->
        <div class="glass-card glass-card-hover p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-400 icon-glow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6" />
                    </svg>
                </div>
                <span class="text-red-400 text-sm font-medium">Bulan ini</span>
            </div>
            <p class="text-gray-400 text-sm mb-1">Pengeluaran</p>
            <p class="text-2xl font-bold text-white">Rp 0</p>
        </div>

        <!-- Tabungan -->
        <div class="glass-card glass-card-hover p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-400 icon-glow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
                <span class="text-purple-400 text-sm font-medium">Target</span>
            </div>
            <p class="text-gray-400 text-sm mb-1">Tabungan</p>
            <p class="text-2xl font-bold text-white">Rp 0</p>
        </div>
    </div>

    <!-- Chart & Recent Transactions -->
    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Chart Section -->
        <div class="lg:col-span-2 glass-card p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-white">Grafik Keuangan</h2>
                <select class="bg-white/10 border border-white/10 rounded-lg px-3 py-2 text-sm text-gray-300 focus:outline-none focus:border-purple-500">
                    <option>7 Hari Terakhir</option>
                    <option>30 Hari Terakhir</option>
                    <option>Bulan Ini</option>
                </select>
            </div>
            
            <!-- Chart Placeholder -->
            <div class="h-64 bg-gradient-to-r from-purple-500/10 to-pink-500/10 rounded-xl flex items-center justify-center">
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-500 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <p class="text-gray-500">Chart akan muncul di sini</p>
                    <p class="text-gray-600 text-sm">Tambahkan transaksi untuk melihat grafik</p>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="glass-card p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-white">Transaksi Terakhir</h2>
                <a href="#" class="text-purple-400 hover:text-purple-300 text-sm">Lihat Semua</a>
            </div>

            <!-- Transaction List Placeholder -->
            <div class="space-y-4">
                <div class="text-center py-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-500 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <p class="text-gray-500">Belum ada transaksi</p>
                    <a href="#" class="inline-flex items-center gap-2 mt-3 px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white text-sm font-medium rounded-lg btn-glow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Transaksi
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-8">
        <h2 class="text-lg font-semibold text-white mb-4">Aksi Cepat</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="#" class="glass-card glass-card-hover p-4 text-center group">
                <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-green-500/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <p class="text-gray-300 text-sm font-medium">Pemasukan</p>
            </a>

            <a href="#" class="glass-card glass-card-hover p-4 text-center group">
                <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-red-500/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                    </svg>
                </div>
                <p class="text-gray-300 text-sm font-medium">Pengeluaran</p>
            </a>

            <a href="#" class="glass-card glass-card-hover p-4 text-center group">
                <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-blue-500/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                </div>
                <p class="text-gray-300 text-sm font-medium">Transfer</p>
            </a>

            <a href="#" class="glass-card glass-card-hover p-4 text-center group">
                <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-purple-500/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="text-gray-300 text-sm font-medium">Budget</p>
            </a>
        </div>
    </div>
</x-dashboard-layout>
