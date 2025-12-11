<x-dashboard-layout>
    <x-slot name="pageTitle">Transaksi</x-slot>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 fade-in-ios">
        <div>
            <h1 class="text-ios-title text-primary-ios mb-1">Transaksi</h1>
            <p class="text-ios-body text-secondary-ios">Kelola semua transaksi Anda</p>
        </div>
        <button class="btn-ios btn-ios-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Transaksi
        </button>
    </div>

    <!-- Filter & Search -->
    <div class="glass glass-static p-4 mb-6 fade-in-ios" style="animation-delay: 0.1s">
        <div class="flex flex-col lg:flex-row gap-4">
            <!-- Search -->
            <div class="flex-1">
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-1/2 -translate-y-1/2 text-tertiary-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" placeholder="Cari transaksi..." class="input-ios pl-10">
                </div>
            </div>
            <!-- Filters -->
            <div class="flex gap-3">
                <select class="input-ios">
                    <option>Semua Tipe</option>
                    <option>Pemasukan</option>
                    <option>Pengeluaran</option>
                </select>
                <select class="input-ios">
                    <option>Semua Kategori</option>
                    <option>Makanan</option>
                    <option>Transport</option>
                    <option>Belanja</option>
                </select>
                <select class="input-ios">
                    <option>Bulan Ini</option>
                    <option>Minggu Ini</option>
                    <option>30 Hari</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Transactions List -->
    <div class="glass glass-static fade-in-ios" style="animation-delay: 0.2s">
        <!-- Table Header -->
        <div class="hidden md:grid md:grid-cols-5 gap-4 p-4 border-b border-[var(--separator)] text-ios-caption text-tertiary-ios">
            <div>Tanggal</div>
            <div class="col-span-2">Deskripsi</div>
            <div>Kategori</div>
            <div class="text-right">Jumlah</div>
        </div>

        <!-- Empty State -->
        <div class="p-12 text-center">
            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-[var(--fill-primary)] flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-tertiary-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <h3 class="text-ios-headline text-primary-ios mb-2">Belum Ada Transaksi</h3>
            <p class="text-ios-caption text-tertiary-ios mb-4">Mulai catat transaksi pertama Anda</p>
            <button class="btn-ios btn-ios-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Transaksi
            </button>
        </div>

        <!-- Sample Transaction Items (untuk referensi styling) -->
        {{-- 
        <div class="grid md:grid-cols-5 gap-4 p-4 border-b border-[var(--separator)] hover:bg-[var(--fill-primary)] transition-colors">
            <div class="text-ios-body text-secondary-ios">12 Des 2024</div>
            <div class="col-span-2">
                <p class="text-ios-body text-primary-ios">Gaji Bulanan</p>
                <p class="text-ios-caption text-tertiary-ios md:hidden">Pemasukan</p>
            </div>
            <div class="hidden md:block">
                <span class="glass-pill px-3 py-1 text-ios-caption text-green-ios">Pemasukan</span>
            </div>
            <div class="text-right text-ios-body font-semibold text-green-ios">+ Rp 10.000.000</div>
        </div>
        --}}
    </div>

    <!-- Pagination -->
    <div class="flex items-center justify-between mt-6 fade-in-ios" style="animation-delay: 0.3s">
        <p class="text-ios-caption text-tertiary-ios">Menampilkan 0 dari 0 transaksi</p>
        <div class="flex gap-2">
            <button class="btn-ios btn-ios-secondary px-3 py-2" disabled>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button class="btn-ios btn-ios-secondary px-3 py-2" disabled>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</x-dashboard-layout>
