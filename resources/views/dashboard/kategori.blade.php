<x-dashboard-layout>
    <x-slot name="pageTitle">Kategori</x-slot>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 fade-in-ios">
        <div>
            <h1 class="text-ios-title text-primary-ios mb-1">Kategori</h1>
            <p class="text-ios-body text-secondary-ios">Kelola kategori transaksi</p>
        </div>
        <button onclick="openModal('kategori-modal')" class="btn-ios btn-ios-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Kategori
        </button>
    </div>

    <!-- Tabs -->
    <div class="flex gap-2 mb-6 fade-in-ios" style="animation-delay: 0.1s">
        <button class="btn-ios btn-ios-primary" data-filter="all">Semua</button>
        <button class="btn-ios btn-ios-secondary" data-filter="income">Pemasukan</button>
        <button class="btn-ios btn-ios-secondary" data-filter="expense">Pengeluaran</button>
    </div>

    <!-- Categories Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 fade-in-ios" style="animation-delay: 0.2s">
        @php
        $categories = [
            ['icon' => '🍔', 'name' => 'Makanan & Minuman', 'type' => 'expense', 'color' => 'from-orange-500 to-red-500', 'count' => 12],
            ['icon' => '🚗', 'name' => 'Transportasi', 'type' => 'expense', 'color' => 'from-blue-500 to-cyan-500', 'count' => 8],
            ['icon' => '🛒', 'name' => 'Belanja', 'type' => 'expense', 'color' => 'from-pink-500 to-rose-500', 'count' => 5],
            ['icon' => '🏠', 'name' => 'Rumah Tangga', 'type' => 'expense', 'color' => 'from-amber-500 to-yellow-500', 'count' => 3],
            ['icon' => '💊', 'name' => 'Kesehatan', 'type' => 'expense', 'color' => 'from-green-500 to-emerald-500', 'count' => 2],
            ['icon' => '🎮', 'name' => 'Hiburan', 'type' => 'expense', 'color' => 'from-purple-500 to-violet-500', 'count' => 4],
            ['icon' => '📚', 'name' => 'Pendidikan', 'type' => 'expense', 'color' => 'from-indigo-500 to-blue-500', 'count' => 1],
            ['icon' => '💰', 'name' => 'Gaji', 'type' => 'income', 'color' => 'from-green-500 to-teal-500', 'count' => 1],
            ['icon' => '💵', 'name' => 'Bonus', 'type' => 'income', 'color' => 'from-emerald-500 to-green-500', 'count' => 1],
            ['icon' => '📈', 'name' => 'Investasi', 'type' => 'income', 'color' => 'from-blue-500 to-indigo-500', 'count' => 2],
            ['icon' => '🎁', 'name' => 'Hadiah', 'type' => 'income', 'color' => 'from-pink-500 to-purple-500', 'count' => 0],
            ['icon' => '💼', 'name' => 'Freelance', 'type' => 'income', 'color' => 'from-cyan-500 to-blue-500', 'count' => 3],
        ];
        @endphp

        @foreach($categories as $category)
        <div class="glass p-4 flex items-center gap-4 group">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br {{ $category['color'] }} flex items-center justify-center text-2xl shrink-0">
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
                <div class="relative">
                    <button class="p-2 rounded-lg hover:bg-[var(--fill-primary)] text-tertiary-ios opacity-0 group-hover:opacity-100 transition-opacity" onclick="this.nextElementSibling.classList.toggle('show')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                        </svg>
                    </button>
                    <div class="dropdown-ios right-0" style="min-width: 140px;">
                        <button class="dropdown-item w-full text-left">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit
                        </button>
                        <button class="dropdown-item danger w-full text-left">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <!-- Add New Category Card -->
        <div onclick="openModal('kategori-modal')" class="glass glass-static p-4 flex items-center justify-center border-2 border-dashed border-[var(--separator)] cursor-pointer hover:bg-[var(--fill-primary)] transition-colors min-h-[84px]">
            <div class="text-center">
                <div class="w-10 h-10 rounded-xl bg-[var(--fill-primary)] flex items-center justify-center mx-auto mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-tertiary-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <p class="text-ios-caption text-tertiary-ios">Tambah Kategori</p>
            </div>
        </div>
    </div>

    <!-- Kategori Modal -->
    <x-slot name="modal">
        <div class="modal-backdrop" id="kategori-modal-backdrop"></div>
        <div class="modal-content" id="kategori-modal">
            <div class="modal-header">
                <h3 class="text-ios-headline text-primary-ios">Tambah Kategori</h3>
                <button onclick="closeModal('kategori-modal')" class="p-2 rounded-lg hover:bg-[var(--fill-primary)] text-tertiary-ios">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form action="#" method="POST">
                @csrf
                <div class="modal-body space-y-4">
                    <!-- Type -->
                    <div class="form-group">
                        <label class="form-label">Tipe Kategori</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="relative">
                                <input type="radio" name="type" value="expense" class="peer sr-only" checked>
                                <div class="glass glass-static p-3 rounded-xl text-center cursor-pointer peer-checked:ring-2 peer-checked:ring-red-500 peer-checked:bg-red-500/10 transition-all">
                                    <span class="text-ios-body text-primary-ios">Pengeluaran</span>
                                </div>
                            </label>
                            <label class="relative">
                                <input type="radio" name="type" value="income" class="peer sr-only">
                                <div class="glass glass-static p-3 rounded-xl text-center cursor-pointer peer-checked:ring-2 peer-checked:ring-green-500 peer-checked:bg-green-500/10 transition-all">
                                    <span class="text-ios-body text-primary-ios">Pemasukan</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name" class="form-label">Nama Kategori</label>
                        <input type="text" name="name" id="name" class="input-ios" placeholder="Contoh: Makanan" required>
                    </div>

                    <!-- Icon Picker -->
                    <div class="form-group">
                        <label class="form-label">Pilih Icon</label>
                        <div class="grid grid-cols-8 gap-2">
                            @php
                            $icons = ['🍔', '🚗', '🛒', '🏠', '💊', '🎮', '📚', '💰', '💵', '📈', '🎁', '💼', '✈️', '🎬', '🛍️', '☕'];
                            @endphp
                            @foreach($icons as $icon)
                            <label class="relative">
                                <input type="radio" name="icon" value="{{ $icon }}" class="peer sr-only" {{ $loop->first ? 'checked' : '' }}>
                                <div class="w-10 h-10 rounded-lg bg-[var(--fill-primary)] flex items-center justify-center text-lg cursor-pointer peer-checked:ring-2 peer-checked:ring-[var(--accent-color)] transition-all hover:bg-[var(--glass-bg)]">
                                    {{ $icon }}
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Color -->
                    <div class="form-group">
                        <label class="form-label">Pilih Warna</label>
                        <div class="flex flex-wrap gap-2">
                            @php
                            $colors = [
                                'from-red-500 to-rose-500',
                                'from-orange-500 to-amber-500',
                                'from-yellow-500 to-lime-500',
                                'from-green-500 to-emerald-500',
                                'from-teal-500 to-cyan-500',
                                'from-blue-500 to-indigo-500',
                                'from-purple-500 to-violet-500',
                                'from-pink-500 to-rose-500',
                            ];
                            @endphp
                            @foreach($colors as $color)
                            <label class="relative">
                                <input type="radio" name="color" value="{{ $color }}" class="peer sr-only" {{ $loop->first ? 'checked' : '' }}>
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br {{ $color }} cursor-pointer peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-[var(--accent-color)] transition-all"></div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" onclick="closeModal('kategori-modal')" class="btn-ios btn-ios-secondary flex-1">Batal</button>
                    <button type="submit" class="btn-ios btn-ios-primary flex-1">Simpan</button>
                </div>
            </form>
        </div>
    </x-slot>
</x-dashboard-layout>
