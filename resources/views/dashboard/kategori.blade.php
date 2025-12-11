<x-dashboard-layout>
    <x-slot name="pageTitle">Kategori</x-slot>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 fade-in-ios">
        <div>
            <h1 class="text-ios-title text-primary-ios mb-1">Kategori</h1>
            <p class="text-ios-body text-secondary-ios">Kelola kategori transaksi</p>
        </div>
        <button class="btn-ios btn-ios-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Kategori
        </button>
    </div>

    <!-- Tabs -->
    <div class="flex gap-2 mb-6 fade-in-ios" style="animation-delay: 0.1s">
        <button class="btn-ios btn-ios-primary">Semua</button>
        <button class="btn-ios btn-ios-secondary">Pemasukan</button>
        <button class="btn-ios btn-ios-secondary">Pengeluaran</button>
    </div>

    <!-- Categories Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 fade-in-ios" style="animation-delay: 0.2s">
        <!-- Default Categories -->
        @php
        $categories = [
            ['icon' => '🍔', 'name' => 'Makanan & Minuman', 'type' => 'expense', 'color' => 'from-orange-500 to-red-500', 'count' => 0],
            ['icon' => '🚗', 'name' => 'Transportasi', 'type' => 'expense', 'color' => 'from-blue-500 to-cyan-500', 'count' => 0],
            ['icon' => '🛒', 'name' => 'Belanja', 'type' => 'expense', 'color' => 'from-pink-500 to-rose-500', 'count' => 0],
            ['icon' => '🏠', 'name' => 'Rumah Tangga', 'type' => 'expense', 'color' => 'from-amber-500 to-yellow-500', 'count' => 0],
            ['icon' => '💊', 'name' => 'Kesehatan', 'type' => 'expense', 'color' => 'from-green-500 to-emerald-500', 'count' => 0],
            ['icon' => '🎮', 'name' => 'Hiburan', 'type' => 'expense', 'color' => 'from-purple-500 to-violet-500', 'count' => 0],
            ['icon' => '📚', 'name' => 'Pendidikan', 'type' => 'expense', 'color' => 'from-indigo-500 to-blue-500', 'count' => 0],
            ['icon' => '💰', 'name' => 'Gaji', 'type' => 'income', 'color' => 'from-green-500 to-teal-500', 'count' => 0],
            ['icon' => '💵', 'name' => 'Bonus', 'type' => 'income', 'color' => 'from-emerald-500 to-green-500', 'count' => 0],
            ['icon' => '📈', 'name' => 'Investasi', 'type' => 'income', 'color' => 'from-blue-500 to-indigo-500', 'count' => 0],
            ['icon' => '🎁', 'name' => 'Hadiah', 'type' => 'income', 'color' => 'from-pink-500 to-purple-500', 'count' => 0],
            ['icon' => '💼', 'name' => 'Freelance', 'type' => 'income', 'color' => 'from-cyan-500 to-blue-500', 'count' => 0],
        ];
        @endphp

        @foreach($categories as $category)
        <div class="glass p-4 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br {{ $category['color'] }} flex items-center justify-center text-2xl">
                {{ $category['icon'] }}
            </div>
            <div class="flex-1 min-w-0">
                <h3 class="text-ios-headline text-primary-ios truncate">{{ $category['name'] }}</h3>
                <p class="text-ios-caption text-tertiary-ios">{{ $category['count'] }} transaksi</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="glass-pill px-2 py-1 text-xs {{ $category['type'] === 'income' ? 'text-green-ios' : 'text-red-ios' }}">
                    {{ $category['type'] === 'income' ? 'Pemasukan' : 'Pengeluaran' }}
                </span>
                <button class="p-2 rounded-lg hover:bg-[var(--fill-primary)] text-tertiary-ios">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                    </svg>
                </button>
            </div>
        </div>
        @endforeach

        <!-- Add New Category Card -->
        <div class="glass glass-static p-4 flex items-center justify-center border-2 border-dashed border-[var(--separator)] cursor-pointer hover:bg-[var(--fill-primary)] transition-colors">
            <div class="text-center">
                <div class="w-12 h-12 rounded-xl bg-[var(--fill-primary)] flex items-center justify-center mx-auto mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-tertiary-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <p class="text-ios-caption text-tertiary-ios">Tambah Kategori</p>
            </div>
        </div>
    </div>
</x-dashboard-layout>
