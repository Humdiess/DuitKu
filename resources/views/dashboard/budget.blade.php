<x-dashboard-layout>
    <x-slot name="pageTitle">Budget</x-slot>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 fade-in-ios">
        <div>
            <h1 class="text-ios-title text-primary-ios mb-1">Budget</h1>
            <p class="text-ios-body text-secondary-ios">Atur dan pantau budget bulanan</p>
        </div>
        <div class="flex gap-3">
            <select class="input-ios">
                <option>Desember 2024</option>
                <option>November 2024</option>
                <option>Oktober 2024</option>
            </select>
            <button class="btn-ios btn-ios-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Buat Budget
            </button>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid sm:grid-cols-3 gap-4 mb-6 fade-in-ios" style="animation-delay: 0.1s">
        <div class="glass p-4">
            <p class="text-ios-caption text-tertiary-ios mb-1">Total Budget</p>
            <p class="text-2xl font-semibold text-primary-ios">Rp 0</p>
        </div>
        <div class="glass p-4">
            <p class="text-ios-caption text-tertiary-ios mb-1">Terpakai</p>
            <p class="text-2xl font-semibold text-red-ios">Rp 0</p>
        </div>
        <div class="glass p-4">
            <p class="text-ios-caption text-tertiary-ios mb-1">Sisa</p>
            <p class="text-2xl font-semibold text-green-ios">Rp 0</p>
        </div>
    </div>

    <!-- Budget List -->
    <div class="space-y-4 fade-in-ios" style="animation-delay: 0.2s">
        @php
        $budgets = [
            ['icon' => '🍔', 'name' => 'Makanan & Minuman', 'budget' => 2000000, 'spent' => 0, 'color' => 'from-orange-500 to-red-500'],
            ['icon' => '🚗', 'name' => 'Transportasi', 'budget' => 1000000, 'spent' => 0, 'color' => 'from-blue-500 to-cyan-500'],
            ['icon' => '🛒', 'name' => 'Belanja', 'budget' => 1500000, 'spent' => 0, 'color' => 'from-pink-500 to-rose-500'],
            ['icon' => '🎮', 'name' => 'Hiburan', 'budget' => 500000, 'spent' => 0, 'color' => 'from-purple-500 to-violet-500'],
            ['icon' => '💊', 'name' => 'Kesehatan', 'budget' => 500000, 'spent' => 0, 'color' => 'from-green-500 to-emerald-500'],
        ];
        @endphp

        @foreach($budgets as $budget)
        @php
            $percentage = $budget['budget'] > 0 ? ($budget['spent'] / $budget['budget']) * 100 : 0;
            $remaining = $budget['budget'] - $budget['spent'];
        @endphp
        <div class="glass p-4">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br {{ $budget['color'] }} flex items-center justify-center text-2xl shrink-0">
                    {{ $budget['icon'] }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-ios-headline text-primary-ios">{{ $budget['name'] }}</h3>
                        <button class="p-1 rounded-lg hover:bg-[var(--fill-primary)] text-tertiary-ios">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                            </svg>
                        </button>
                    </div>
                    <!-- Progress Bar -->
                    <div class="h-2 rounded-full bg-[var(--fill-primary)] mb-2 overflow-hidden">
                        <div class="h-full rounded-full bg-gradient-to-r {{ $budget['color'] }} transition-all" style="width: {{ $percentage }}%"></div>
                    </div>
                    <div class="flex items-center justify-between text-ios-caption">
                        <span class="text-secondary-ios">
                            Rp {{ number_format($budget['spent'], 0, ',', '.') }} / Rp {{ number_format($budget['budget'], 0, ',', '.') }}
                        </span>
                        <span class="{{ $remaining >= 0 ? 'text-green-ios' : 'text-red-ios' }}">
                            {{ $remaining >= 0 ? 'Sisa' : 'Lebih' }} Rp {{ number_format(abs($remaining), 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <!-- Add New Budget -->
        <div class="glass glass-static p-6 flex items-center justify-center border-2 border-dashed border-[var(--separator)] cursor-pointer hover:bg-[var(--fill-primary)] transition-colors">
            <div class="text-center">
                <div class="w-12 h-12 rounded-xl bg-[var(--fill-primary)] flex items-center justify-center mx-auto mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-tertiary-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <p class="text-ios-body text-tertiary-ios">Tambah Budget Baru</p>
            </div>
        </div>
    </div>
</x-dashboard-layout>
