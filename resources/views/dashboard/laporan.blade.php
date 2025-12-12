<x-dashboard-layout>
    <x-slot name="pageTitle">Laporan</x-slot>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 fade-in-ios">
        <div>
            <h1 class="text-ios-title text-primary-ios mb-1">Laporan</h1>
            <p class="text-ios-body text-secondary-ios">Analisis keuangan Anda</p>
        </div>
        <div class="flex gap-3">
            <form method="GET" action="{{ route('laporan') }}" id="month-form">
                <select name="month" class="input-ios" onchange="updateMonth(this)">
                    @foreach($availableMonths as $m)
                    <option value="{{ $m['month'] }}" data-year="{{ $m['year'] }}" {{ $m['month'] == $currentMonth && $m['year'] == $currentYear ? 'selected' : '' }}>
                        {{ $m['label'] }}
                    </option>
                    @endforeach
                </select>
                <input type="hidden" name="year" id="year-input" value="{{ $currentYear }}">
            </form>
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
            <p class="text-2xl font-semibold text-green-ios">Rp {{ number_format($stats['income'] ?? 0, 0, ',', '.') }}</p>
            <p class="text-ios-caption text-tertiary-ios mt-1">
                @if(($stats['income_change'] ?? 0) >= 0)
                    +{{ $stats['income_change'] ?? 0 }}% dari bulan lalu
                @else
                    {{ $stats['income_change'] ?? 0 }}% dari bulan lalu
                @endif
            </p>
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
            <p class="text-2xl font-semibold text-red-ios">Rp {{ number_format($stats['expense'] ?? 0, 0, ',', '.') }}</p>
            <p class="text-ios-caption text-tertiary-ios mt-1">
                @if(($stats['expense_change'] ?? 0) <= 0)
                    {{ $stats['expense_change'] ?? 0 }}% dari bulan lalu
                @else
                    +{{ $stats['expense_change'] ?? 0 }}% dari bulan lalu
                @endif
            </p>
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
            <p class="text-2xl font-semibold {{ ($stats['balance'] ?? 0) >= 0 ? 'text-primary-ios' : 'text-red-ios' }}">Rp {{ number_format($stats['balance'] ?? 0, 0, ',', '.') }}</p>
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
            <p class="text-2xl font-semibold text-primary-ios">{{ $stats['count'] ?? 0 }}</p>
            <p class="text-ios-caption text-tertiary-ios mt-1">Total transaksi</p>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid lg:grid-cols-2 gap-4 mb-6">
        <!-- Income vs Expense Chart -->
        <div class="glass glass-static p-4 fade-in-ios" style="animation-delay: 0.2s">
            <h3 class="text-ios-headline text-primary-ios mb-4">Pemasukan vs Pengeluaran</h3>
            <div class="h-64">
                @if(count($incomeVsExpense ?? []) > 0 && array_sum(array_column($incomeVsExpense, 'income')) + array_sum(array_column($incomeVsExpense, 'expense')) > 0)
                <div class="flex items-end justify-around h-full gap-2 pb-8">
                    @php
                        $maxVal = max(array_merge(array_column($incomeVsExpense, 'income'), array_column($incomeVsExpense, 'expense')));
                        if ($maxVal == 0) $maxVal = 1;
                    @endphp
                    @foreach($incomeVsExpense as $data)
                    <div class="flex-1 flex flex-col items-center gap-1">
                        <div class="w-full flex gap-1 items-end justify-center" style="height: 180px;">
                            <div class="w-1/3 rounded-t bg-gradient-to-t from-green-500/50 to-green-500/80" style="height: {{ ($data['income'] / $maxVal) * 100 }}%"></div>
                            <div class="w-1/3 rounded-t bg-gradient-to-t from-red-500/50 to-red-500/80" style="height: {{ ($data['expense'] / $maxVal) * 100 }}%"></div>
                        </div>
                        <span class="text-xs text-tertiary-ios">{{ $data['month'] }}</span>
                    </div>
                    @endforeach
                </div>
                <div class="flex justify-center gap-6 mt-2">
                    <span class="flex items-center gap-2 text-ios-caption text-tertiary-ios">
                        <span class="w-3 h-3 rounded bg-green-500"></span> Pemasukan
                    </span>
                    <span class="flex items-center gap-2 text-ios-caption text-tertiary-ios">
                        <span class="w-3 h-3 rounded bg-red-500"></span> Pengeluaran
                    </span>
                </div>
                @else
                <div class="h-full flex items-center justify-center">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-tertiary-ios mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <p class="text-ios-caption text-tertiary-ios">Belum ada data untuk ditampilkan</p>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Category Breakdown -->
        <div class="glass glass-static p-4 fade-in-ios" style="animation-delay: 0.25s">
            <h3 class="text-ios-headline text-primary-ios mb-4">Pengeluaran per Kategori</h3>
            <div class="h-64">
                @if(count($categoryBreakdown['items'] ?? []) > 0)
                <div class="space-y-3 overflow-y-auto h-full">
                    @foreach($categoryBreakdown['items'] as $item)
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-ios-body text-primary-ios">{{ $item['icon'] }} {{ $item['name'] }}</span>
                            <span class="text-ios-caption text-tertiary-ios">{{ $item['percentage'] }}%</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="flex-1 h-2 rounded-full bg-[var(--fill-primary)] overflow-hidden">
                                <div class="h-full rounded-full bg-gradient-to-r {{ $item['color'] }}" style="width: {{ $item['percentage'] }}%"></div>
                            </div>
                            <span class="text-ios-caption text-secondary-ios w-24 text-right">Rp {{ number_format($item['spent'], 0, ',', '.') }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="h-full flex items-center justify-center">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-tertiary-ios mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                        </svg>
                        <p class="text-ios-caption text-tertiary-ios">Belum ada data untuk ditampilkan</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Daily Trend -->
    <div class="glass glass-static p-4 fade-in-ios" style="animation-delay: 0.3s">
        <h3 class="text-ios-headline text-primary-ios mb-4">Tren Harian - {{ $currentMonthLabel }}</h3>
        <div class="h-48">
            @if(count($dailyTrend ?? []) > 0 && (array_sum(array_column($dailyTrend, 'income')) + array_sum(array_column($dailyTrend, 'expense'))) > 0)
            <div class="flex items-end justify-around h-full gap-1 pb-8 overflow-x-auto">
                @php
                    $maxDayVal = max(array_map(fn($d) => max($d['income'], $d['expense']), $dailyTrend));
                    if ($maxDayVal == 0) $maxDayVal = 1;
                @endphp
                @foreach($dailyTrend as $day)
                <div class="flex flex-col items-center gap-1 min-w-[20px]" title="Tanggal {{ $day['day'] }}: +Rp {{ number_format($day['income'], 0, ',', '.') }} / -Rp {{ number_format($day['expense'], 0, ',', '.') }}">
                    <div class="w-full flex gap-0.5 items-end justify-center" style="height: 120px;">
                        @if($day['income'] > 0 || $day['expense'] > 0)
                        <div class="w-2 rounded-t bg-gradient-to-t from-blue-500/50 to-purple-500/80" style="height: {{ max((($day['income'] + $day['expense']) / $maxDayVal) * 100, 5) }}%"></div>
                        @else
                        <div class="w-2 rounded-t bg-gray-500/20" style="height: 5%"></div>
                        @endif
                    </div>
                    <span class="text-[10px] text-tertiary-ios">{{ $day['day'] }}</span>
                </div>
                @endforeach
            </div>
            @else
            <div class="h-full flex items-center justify-center">
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-tertiary-ios mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                    </svg>
                    <p class="text-ios-caption text-tertiary-ios">Tambahkan transaksi untuk melihat tren</p>
                </div>
            </div>
            @endif
        </div>
    </div>

    <script>
        function updateMonth(select) {
            const option = select.options[select.selectedIndex];
            document.getElementById('year-input').value = option.dataset.year;
            document.getElementById('month-form').submit();
        }
    </script>
</x-dashboard-layout>
