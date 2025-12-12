<x-dashboard-layout>
    <x-slot name="pageTitle">Dashboard</x-slot>

    <!-- Welcome -->
    <div class="mb-6 fade-in-ios">
        <h1 class="text-ios-title text-primary-ios mb-1">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
        <p class="text-ios-body text-secondary-ios">Ringkasan keuangan Anda bulan ini</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="glass p-4 fade-in-ios" style="animation-delay: 0.05s">
            <div class="flex items-center gap-3 mb-3">
                <div class="icon-ios-sm bg-green-500/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 11l5-5m0 0l5 5m-5-5v12" />
                    </svg>
                </div>
                <span class="text-ios-caption text-tertiary-ios">Pemasukan</span>
            </div>
            <p class="text-2xl font-semibold text-green-ios">Rp 12.500.000</p>
            <p class="text-ios-caption text-tertiary-ios mt-1">+15% dari bulan lalu</p>
        </div>

        <div class="glass p-4 fade-in-ios" style="animation-delay: 0.1s">
            <div class="flex items-center gap-3 mb-3">
                <div class="icon-ios-sm bg-red-500/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 13l-5 5m0 0l-5-5m5 5V6" />
                    </svg>
                </div>
                <span class="text-ios-caption text-tertiary-ios">Pengeluaran</span>
            </div>
            <p class="text-2xl font-semibold text-red-ios">Rp 3.250.000</p>
            <p class="text-ios-caption text-tertiary-ios mt-1">-8% dari bulan lalu</p>
        </div>

        <div class="glass p-4 fade-in-ios" style="animation-delay: 0.15s">
            <div class="flex items-center gap-3 mb-3">
                <div class="icon-ios-sm bg-blue-500/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-accent-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="text-ios-caption text-tertiary-ios">Saldo</span>
            </div>
            <p class="text-2xl font-semibold text-primary-ios">Rp 9.250.000</p>
            <p class="text-ios-caption text-tertiary-ios mt-1">Total tersedia</p>
        </div>

        <div class="glass p-4 fade-in-ios" style="animation-delay: 0.2s">
            <div class="flex items-center gap-3 mb-3">
                <div class="icon-ios-sm bg-purple-500/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <span class="text-ios-caption text-tertiary-ios">Transaksi</span>
            </div>
            <p class="text-2xl font-semibold text-primary-ios">42</p>
            <p class="text-ios-caption text-tertiary-ios mt-1">Bulan ini</p>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Left Column -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Chart -->
            <div class="glass glass-static p-4 fade-in-ios" style="animation-delay: 0.25s">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-ios-headline text-primary-ios">Grafik Keuangan</h2>
                    <select class="input-ios w-auto text-sm py-1.5">
                        <option>7 Hari</option>
                        <option>30 Hari</option>
                        <option>3 Bulan</option>
                    </select>
                </div>
                <div class="h-48 flex items-end justify-around gap-2">
                    @php
                    $chartData = [40, 65, 45, 80, 55, 90, 70];
                    $days = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
                    @endphp
                    @foreach($chartData as $i => $height)
                    <div class="flex-1 flex flex-col items-center gap-2">
                        <div class="w-full max-w-8 rounded-t bg-gradient-to-t from-blue-500/30 to-purple-500/50 transition-all hover:from-blue-500/50 hover:to-purple-500/70" style="height: {{ $height }}%"></div>
                        <span class="text-xs text-tertiary-ios">{{ $days[$i] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="glass glass-static p-4 fade-in-ios" style="animation-delay: 0.3s">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-ios-headline text-primary-ios">Transaksi Terbaru</h2>
                    <a href="{{ route('transaksi') }}" class="text-ios-caption text-accent-ios">Lihat Semua</a>
                </div>
                <div class="space-y-3">
                    @php
                    $transactions = [
                        ['icon' => '💰', 'name' => 'Gaji Bulanan', 'date' => 'Hari ini', 'amount' => 10000000, 'type' => 'income'],
                        ['icon' => '🍔', 'name' => 'Makan Siang', 'date' => 'Kemarin', 'amount' => 45000, 'type' => 'expense'],
                        ['icon' => '🚗', 'name' => 'Gopay Transport', 'date' => 'Kemarin', 'amount' => 75000, 'type' => 'expense'],
                        ['icon' => '🛒', 'name' => 'Belanja Groceries', 'date' => '2 hari lalu', 'amount' => 350000, 'type' => 'expense'],
                    ];
                    @endphp
                    @foreach($transactions as $tx)
                    <div class="flex items-center gap-3 p-2 -mx-2 rounded-xl hover:bg-[var(--fill-primary)] transition-colors">
                        <div class="w-10 h-10 rounded-xl bg-[var(--fill-primary)] flex items-center justify-center text-lg">
                            {{ $tx['icon'] }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-ios-body text-primary-ios truncate">{{ $tx['name'] }}</p>
                            <p class="text-ios-caption text-tertiary-ios">{{ $tx['date'] }}</p>
                        </div>
                        <p class="text-ios-body font-medium {{ $tx['type'] === 'income' ? 'text-green-ios' : 'text-red-ios' }}">
                            {{ $tx['type'] === 'income' ? '+' : '-' }}Rp {{ number_format($tx['amount'], 0, ',', '.') }}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="glass glass-static p-4 fade-in-ios" style="animation-delay: 0.35s">
                <h2 class="text-ios-headline text-primary-ios mb-4">Aksi Cepat</h2>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('transaksi') }}" onclick="event.preventDefault(); openModal('quick-income')" class="glass glass-static p-3 rounded-xl text-center hover:bg-[var(--glass-bg-heavy)] transition-colors">
                        <div class="w-10 h-10 mx-auto mb-2 rounded-full bg-green-500/20 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <span class="text-ios-caption text-primary-ios">Pemasukan</span>
                    </a>
                    <a href="{{ route('transaksi') }}" onclick="event.preventDefault(); openModal('quick-expense')" class="glass glass-static p-3 rounded-xl text-center hover:bg-[var(--glass-bg-heavy)] transition-colors">
                        <div class="w-10 h-10 mx-auto mb-2 rounded-full bg-red-500/20 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" />
                            </svg>
                        </div>
                        <span class="text-ios-caption text-primary-ios">Pengeluaran</span>
                    </a>
                    <a href="{{ route('budget') }}" class="glass glass-static p-3 rounded-xl text-center hover:bg-[var(--glass-bg-heavy)] transition-colors">
                        <div class="w-10 h-10 mx-auto mb-2 rounded-full bg-blue-500/20 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="text-ios-caption text-primary-ios">Budget</span>
                    </a>
                    <a href="{{ route('laporan') }}" class="glass glass-static p-3 rounded-xl text-center hover:bg-[var(--glass-bg-heavy)] transition-colors">
                        <div class="w-10 h-10 mx-auto mb-2 rounded-full bg-purple-500/20 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <span class="text-ios-caption text-primary-ios">Laporan</span>
                    </a>
                </div>
            </div>

            <!-- Budget Overview -->
            <div class="glass glass-static p-4 fade-in-ios" style="animation-delay: 0.4s">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-ios-headline text-primary-ios">Budget Bulan Ini</h2>
                    <a href="{{ route('budget') }}" class="text-ios-caption text-accent-ios">Detail</a>
                </div>
                <div class="space-y-4">
                    @php
                    $budgets = [
                        ['icon' => '🍔', 'name' => 'Makanan', 'spent' => 850, 'total' => 2000, 'color' => 'from-orange-500 to-red-500'],
                        ['icon' => '🚗', 'name' => 'Transport', 'spent' => 450, 'total' => 1000, 'color' => 'from-blue-500 to-cyan-500'],
                        ['icon' => '🛒', 'name' => 'Belanja', 'spent' => 500, 'total' => 1500, 'color' => 'from-pink-500 to-rose-500'],
                    ];
                    @endphp
                    @foreach($budgets as $b)
                    @php $pct = ($b['spent'] / $b['total']) * 100; @endphp
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <span class="text-ios-body text-primary-ios">{{ $b['icon'] }} {{ $b['name'] }}</span>
                            <span class="text-ios-caption text-tertiary-ios">{{ number_format($pct, 0) }}%</span>
                        </div>
                        <div class="h-1.5 rounded-full bg-[var(--fill-primary)] overflow-hidden">
                            <div class="h-full rounded-full bg-gradient-to-r {{ $b['color'] }}" style="width: {{ $pct }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Add Modals -->
    <x-slot name="modal">
        <!-- Quick Income -->
        <div class="modal-backdrop" id="quick-income-backdrop"></div>
        <div class="modal-content" id="quick-income">
            <div class="modal-header">
                <h3 class="text-ios-headline text-primary-ios">Tambah Pemasukan</h3>
                <button onclick="closeModal('quick-income')" class="p-2 rounded-lg hover:bg-[var(--fill-primary)] text-tertiary-ios">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form action="#" method="POST">
                @csrf
                <input type="hidden" name="type" value="income">
                <div class="modal-body space-y-4">
                    <div class="form-group">
                        <label for="income_amount" class="form-label">Jumlah</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-secondary-ios">Rp</span>
                            <input type="number" name="amount" id="income_amount" class="input-ios pl-10" placeholder="0" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="income_desc" class="form-label">Deskripsi</label>
                        <input type="text" name="description" id="income_desc" class="input-ios" placeholder="Contoh: Gaji" required>
                    </div>
                    <div class="form-group">
                        <label for="income_cat" class="form-label">Kategori</label>
                        <select name="category_id" id="income_cat" class="input-ios" required>
                            <option value="1">💰 Gaji</option>
                            <option value="2">💵 Bonus</option>
                            <option value="3">💼 Freelance</option>
                            <option value="4">📈 Investasi</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="closeModal('quick-income')" class="btn-ios btn-ios-secondary flex-1">Batal</button>
                    <button type="submit" class="btn-ios btn-ios-primary flex-1">Simpan</button>
                </div>
            </form>
        </div>

        <!-- Quick Expense -->
        <div class="modal-backdrop" id="quick-expense-backdrop"></div>
        <div class="modal-content" id="quick-expense">
            <div class="modal-header">
                <h3 class="text-ios-headline text-primary-ios">Tambah Pengeluaran</h3>
                <button onclick="closeModal('quick-expense')" class="p-2 rounded-lg hover:bg-[var(--fill-primary)] text-tertiary-ios">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form action="#" method="POST">
                @csrf
                <input type="hidden" name="type" value="expense">
                <div class="modal-body space-y-4">
                    <div class="form-group">
                        <label for="expense_amount" class="form-label">Jumlah</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-secondary-ios">Rp</span>
                            <input type="number" name="amount" id="expense_amount" class="input-ios pl-10" placeholder="0" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="expense_desc" class="form-label">Deskripsi</label>
                        <input type="text" name="description" id="expense_desc" class="input-ios" placeholder="Contoh: Makan siang" required>
                    </div>
                    <div class="form-group">
                        <label for="expense_cat" class="form-label">Kategori</label>
                        <select name="category_id" id="expense_cat" class="input-ios" required>
                            <option value="5">🍔 Makanan</option>
                            <option value="6">🚗 Transport</option>
                            <option value="7">🛒 Belanja</option>
                            <option value="8">🎮 Hiburan</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="closeModal('quick-expense')" class="btn-ios btn-ios-secondary flex-1">Batal</button>
                    <button type="submit" class="btn-ios btn-ios-primary flex-1">Simpan</button>
                </div>
            </form>
        </div>
    </x-slot>
</x-dashboard-layout>
