<x-dashboard-layout>
    <x-slot name="pageTitle">Transaksi</x-slot>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 fade-in-ios">
        <div>
            <h1 class="text-ios-title text-primary-ios mb-1">Transaksi</h1>
            <p class="text-ios-body text-secondary-ios">Kelola semua transaksi Anda</p>
        </div>
        <button onclick="openModal('transaksi-modal')" class="btn-ios btn-ios-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Transaksi
        </button>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="glass p-4 mb-6 border-l-4 border-green-500 fade-in-ios">
        <p class="text-green-ios">{{ session('success') }}</p>
    </div>
    @endif

    @if(session('error'))
    <div class="glass p-4 mb-6 border-l-4 border-red-500 fade-in-ios">
        <p class="text-red-ios">{{ session('error') }}</p>
    </div>
    @endif

    <!-- Filter & Search -->
    <div class="glass glass-static p-4 mb-6 fade-in-ios" style="animation-delay: 0.1s">
        <form method="GET" action="{{ route('transaksi.index') }}" id="filter-form">
            <div class="flex flex-col lg:flex-row gap-4">
                <!-- Search -->
                <div class="flex-1">
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-1/2 -translate-y-1/2 text-tertiary-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Cari transaksi..." class="input-ios pl-10">
                    </div>
                </div>
                <!-- Filters -->
                <div class="flex flex-wrap sm:flex-nowrap gap-3">
                    <select name="type" class="input-ios" onchange="this.form.submit()">
                        <option value="">Semua Tipe</option>
                        <option value="income" {{ ($filters['type'] ?? '') === 'income' ? 'selected' : '' }}>Pemasukan</option>
                        <option value="expense" {{ ($filters['type'] ?? '') === 'expense' ? 'selected' : '' }}>Pengeluaran</option>
                    </select>
                    <select name="category" class="input-ios" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ ($filters['category_id'] ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->icon }} {{ $cat->name }}</option>
                        @endforeach
                    </select>
                    <select name="period" class="input-ios" onchange="this.form.submit()">
                        <option value="all" {{ ($filters['period'] ?? 'all') === 'all' ? 'selected' : '' }}>Semua</option>
                        <option value="today" {{ ($filters['period'] ?? '') === 'today' ? 'selected' : '' }}>Hari Ini</option>
                        <option value="week" {{ ($filters['period'] ?? '') === 'week' ? 'selected' : '' }}>Minggu Ini</option>
                        <option value="month" {{ ($filters['period'] ?? '') === 'month' ? 'selected' : '' }}>Bulan Ini</option>
                        <option value="30days" {{ ($filters['period'] ?? '') === '30days' ? 'selected' : '' }}>30 Hari</option>
                    </select>
                    @if(!empty($filters['search']) || !empty($filters['type']) || !empty($filters['category_id']) || ($filters['period'] ?? 'all') !== 'all')
                    <a href="{{ route('transaksi.index') }}" class="btn-ios btn-ios-secondary px-3">Reset</a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Transactions List -->
    <div class="glass glass-static fade-in-ios" style="animation-delay: 0.2s">
        <!-- Table Header -->
        <div class="hidden md:grid md:grid-cols-12 gap-4 p-4 border-b border-[var(--separator)] text-ios-caption text-tertiary-ios font-medium">
            <div class="col-span-2">Tanggal</div>
            <div class="col-span-4">Deskripsi</div>
            <div class="col-span-2">Kategori</div>
            <div class="col-span-2 text-right">Jumlah</div>
            <div class="col-span-2 text-right">Aksi</div>
        </div>

        @forelse($transactions as $tx)
        <div class="grid grid-cols-1 md:grid-cols-12 gap-2 md:gap-4 p-4 border-b border-[var(--separator)] hover:bg-[var(--fill-primary)] transition-colors">
            <div class="col-span-2 text-ios-body text-secondary-ios">
                <span class="md:hidden text-tertiary-ios text-xs">Tanggal: </span>
                {{ $tx->date->format('d M Y') }}
            </div>
            <div class="col-span-4">
                <p class="text-ios-body text-primary-ios">{{ $tx->description }}</p>
                @if($tx->notes)
                <p class="text-ios-caption text-tertiary-ios truncate">{{ $tx->notes }}</p>
                @endif
            </div>
            <div class="col-span-2">
                <span class="glass-pill px-3 py-1 text-ios-caption {{ $tx->type === 'income' ? 'text-green-ios' : 'text-tertiary-ios' }}">
                    {{ $tx->category->icon ?? '📁' }} {{ $tx->category->name ?? 'Tanpa Kategori' }}
                </span>
            </div>
            <div class="col-span-2 text-right text-ios-body font-semibold {{ $tx->type === 'income' ? 'text-green-ios' : 'text-red-ios' }}">
                {{ $tx->type === 'income' ? '+' : '-' }} Rp {{ number_format($tx->amount, 0, ',', '.') }}
            </div>
            <div class="col-span-2 flex justify-end gap-2">
                <button onclick="openEditModal({{ $tx->id }}, '{{ $tx->type }}', {{ $tx->amount }}, '{{ addslashes($tx->description) }}', {{ $tx->category_id }}, '{{ $tx->date->format('Y-m-d') }}', '{{ addslashes($tx->notes ?? '') }}')" class="p-2 rounded-lg hover:bg-[var(--glass-bg)] text-secondary-ios" title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </button>
                <form action="{{ route('transaksi.destroy', $tx) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2 rounded-lg hover:bg-[var(--glass-bg)] text-red-ios" title="Hapus">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <!-- Empty State -->
        <div class="p-12 text-center">
            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-[var(--fill-primary)] flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-tertiary-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <h3 class="text-ios-headline text-primary-ios mb-2">Belum Ada Transaksi</h3>
            <p class="text-ios-caption text-tertiary-ios mb-4">Mulai catat transaksi pertama Anda</p>
            <button onclick="openModal('transaksi-modal')" class="btn-ios btn-ios-primary">
                Tambah Transaksi
            </button>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($transactions->hasPages())
    <div class="flex items-center justify-between mt-6 fade-in-ios" style="animation-delay: 0.3s">
        <p class="text-ios-caption text-tertiary-ios">
            Menampilkan {{ $transactions->firstItem() }}-{{ $transactions->lastItem() }} dari {{ $transactions->total() }} transaksi
        </p>
        <div class="flex gap-2">
            @if($transactions->onFirstPage())
            <button class="btn-ios btn-ios-secondary px-3 py-2" disabled>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            @else
            <a href="{{ $transactions->previousPageUrl() }}" class="btn-ios btn-ios-secondary px-3 py-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            @endif
            
            @if($transactions->hasMorePages())
            <a href="{{ $transactions->nextPageUrl() }}" class="btn-ios btn-ios-secondary px-3 py-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
            @else
            <button class="btn-ios btn-ios-secondary px-3 py-2" disabled>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>
            @endif
        </div>
    </div>
    @endif

    <!-- Transaksi Modal -->
    <x-slot name="modal">
        <div class="modal-backdrop" id="transaksi-modal-backdrop"></div>
        <div class="modal-content" id="transaksi-modal">
            <div class="modal-header">
                <h3 class="text-ios-headline text-primary-ios">Tambah Transaksi</h3>
                <button onclick="closeModal('transaksi-modal')" class="p-2 rounded-lg hover:bg-[var(--fill-primary)] text-tertiary-ios">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf
                <div class="modal-body space-y-4">
                    <!-- Type Selector -->
                    <div class="form-group">
                        <label class="form-label">Tipe Transaksi</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="relative">
                                <input type="radio" name="type" value="income" class="peer sr-only" checked>
                                <div class="glass glass-static p-3 rounded-xl text-center cursor-pointer peer-checked:ring-2 peer-checked:ring-green-500 peer-checked:bg-green-500/10 transition-all">
                                    <div class="w-10 h-10 mx-auto mb-2 rounded-full bg-green-500/20 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 11l5-5m0 0l5 5m-5-5v12" />
                                        </svg>
                                    </div>
                                    <span class="text-ios-body text-primary-ios">Pemasukan</span>
                                </div>
                            </label>
                            <label class="relative">
                                <input type="radio" name="type" value="expense" class="peer sr-only">
                                <div class="glass glass-static p-3 rounded-xl text-center cursor-pointer peer-checked:ring-2 peer-checked:ring-red-500 peer-checked:bg-red-500/10 transition-all">
                                    <div class="w-10 h-10 mx-auto mb-2 rounded-full bg-red-500/20 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 13l-5 5m0 0l-5-5m5 5V6" />
                                        </svg>
                                    </div>
                                    <span class="text-ios-body text-primary-ios">Pengeluaran</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Amount -->
                    <div class="form-group">
                        <label for="amount" class="form-label">Jumlah</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-secondary-ios">Rp</span>
                            <input type="number" name="amount" id="amount" class="input-ios pl-10" placeholder="0" required>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description" class="form-label">Deskripsi</label>
                        <input type="text" name="description" id="description" class="input-ios" placeholder="Contoh: Gaji bulan Desember" required>
                    </div>

                    <!-- Category -->
                    <div class="form-group">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select name="category_id" id="category_id" class="input-ios" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" data-type="{{ $category->type }}">{{ $category->icon }} {{ $category->name }} ({{ $category->type_label }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Date -->
                    <div class="form-group">
                        <label for="date" class="form-label">Tanggal</label>
                        <input type="date" name="date" id="date" class="input-ios" value="{{ date('Y-m-d') }}" required>
                    </div>

                    <!-- Notes -->
                    <div class="form-group">
                        <label for="notes" class="form-label">Catatan (Opsional)</label>
                        <textarea name="notes" id="notes" rows="2" class="input-ios" placeholder="Tambahkan catatan..."></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" onclick="closeModal('transaksi-modal')" class="btn-ios btn-ios-secondary flex-1">Batal</button>
                    <button type="submit" class="btn-ios btn-ios-primary flex-1">Simpan</button>
                </div>
            </form>
        </div>

        <!-- Edit Modal -->
        <div class="modal-backdrop" id="edit-modal-backdrop"></div>
        <div class="modal-content" id="edit-modal">
            <div class="modal-header">
                <h3 class="text-ios-headline text-primary-ios">Edit Transaksi</h3>
                <button onclick="closeModal('edit-modal')" class="p-2 rounded-lg hover:bg-[var(--fill-primary)] text-tertiary-ios">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form id="edit-form" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body space-y-4">
                    <!-- Type Selector -->
                    <div class="form-group">
                        <label class="form-label">Tipe Transaksi</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="relative">
                                <input type="radio" name="type" value="income" id="edit-type-income" class="peer sr-only">
                                <div class="glass glass-static p-3 rounded-xl text-center cursor-pointer peer-checked:ring-2 peer-checked:ring-green-500 peer-checked:bg-green-500/10 transition-all">
                                    <span class="text-ios-body text-primary-ios">Pemasukan</span>
                                </div>
                            </label>
                            <label class="relative">
                                <input type="radio" name="type" value="expense" id="edit-type-expense" class="peer sr-only">
                                <div class="glass glass-static p-3 rounded-xl text-center cursor-pointer peer-checked:ring-2 peer-checked:ring-red-500 peer-checked:bg-red-500/10 transition-all">
                                    <span class="text-ios-body text-primary-ios">Pengeluaran</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edit-amount" class="form-label">Jumlah</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-secondary-ios">Rp</span>
                            <input type="number" name="amount" id="edit-amount" class="input-ios pl-10" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edit-description" class="form-label">Deskripsi</label>
                        <input type="text" name="description" id="edit-description" class="input-ios" required>
                    </div>

                    <div class="form-group">
                        <label for="edit-category_id" class="form-label">Kategori</label>
                        <select name="category_id" id="edit-category_id" class="input-ios" required>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->icon }} {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="edit-date" class="form-label">Tanggal</label>
                        <input type="date" name="date" id="edit-date" class="input-ios" required>
                    </div>

                    <div class="form-group">
                        <label for="edit-notes" class="form-label">Catatan</label>
                        <textarea name="notes" id="edit-notes" rows="2" class="input-ios"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" onclick="closeModal('edit-modal')" class="btn-ios btn-ios-secondary flex-1">Batal</button>
                    <button type="submit" class="btn-ios btn-ios-primary flex-1">Simpan</button>
                </div>
            </form>
        </div>
    </x-slot>

    <script>
        function openEditModal(id, type, amount, description, categoryId, date, notes) {
            document.getElementById('edit-form').action = '/dashboard/transaksi/' + id;
            document.getElementById('edit-amount').value = amount;
            document.getElementById('edit-description').value = description;
            document.getElementById('edit-category_id').value = categoryId;
            document.getElementById('edit-date').value = date;
            document.getElementById('edit-notes').value = notes;
            
            if (type === 'income') {
                document.getElementById('edit-type-income').checked = true;
            } else {
                document.getElementById('edit-type-expense').checked = true;
            }
            
            openModal('edit-modal');
        }
    </script>
</x-dashboard-layout>
