<x-dashboard-layout>
    <x-slot name="pageTitle">Budget</x-slot>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 fade-in-ios">
        <div>
            <h1 class="text-ios-title text-primary-ios mb-1">Budget</h1>
            <p class="text-ios-body text-secondary-ios">Atur dan pantau budget bulanan</p>
        </div>
        <div class="flex gap-3">
            <button onclick="openModal('budget-modal')" class="btn-ios btn-ios-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Buat Budget
            </button>
        </div>
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

    <!-- Summary Cards -->
    <div class="grid sm:grid-cols-3 gap-4 mb-6 fade-in-ios" style="animation-delay: 0.1s">
        <div class="glass p-4">
            <p class="text-ios-caption text-tertiary-ios mb-1">Total Budget</p>
            <p class="text-2xl font-semibold text-primary-ios">Rp {{ number_format($summary['total_budget'] ?? 0, 0, ',', '.') }}</p>
        </div>
        <div class="glass p-4">
            <p class="text-ios-caption text-tertiary-ios mb-1">Terpakai</p>
            <p class="text-2xl font-semibold text-red-ios">Rp {{ number_format($summary['total_spent'] ?? 0, 0, ',', '.') }}</p>
        </div>
        <div class="glass p-4">
            <p class="text-ios-caption text-tertiary-ios mb-1">Sisa</p>
            <p class="text-2xl font-semibold text-green-ios">Rp {{ number_format($summary['total_remaining'] ?? 0, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Budget List -->
    <div class="space-y-4 fade-in-ios" style="animation-delay: 0.2s">
        @forelse($budgets as $budget)
        @php
            $percentage = $budget->percentage;
            $remaining = $budget->remaining;
            $isExceeded = $budget->is_exceeded;
        @endphp
        <div class="glass p-4 group">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br {{ $budget->category->color ?? 'from-blue-500 to-indigo-500' }} flex items-center justify-center text-2xl shrink-0">
                    {{ $budget->category->icon ?? '📁' }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-ios-headline text-primary-ios">{{ $budget->category->name ?? 'Kategori' }}</h3>
                        <div class="flex items-center gap-2">
                            <span class="glass-pill px-2 py-1 text-xs {{ $percentage >= 80 ? 'text-red-ios' : ($percentage >= 50 ? 'text-orange-ios' : 'text-green-ios') }}">
                                {{ number_format($percentage, 0) }}%
                            </span>
                            <form action="{{ route('budget.destroy', $budget) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus budget ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1 rounded-lg hover:bg-[var(--fill-primary)] text-tertiary-ios opacity-0 group-hover:opacity-100 transition-opacity">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- Progress Bar -->
                    <div class="h-2 rounded-full bg-[var(--fill-primary)] mb-2 overflow-hidden">
                        <div class="h-full rounded-full bg-gradient-to-r {{ $budget->category->color ?? 'from-blue-500 to-indigo-500' }} transition-all" style="width: {{ min($percentage, 100) }}%"></div>
                    </div>
                    <div class="flex items-center justify-between text-ios-caption">
                        <span class="text-secondary-ios">
                            Rp {{ number_format($budget->spent, 0, ',', '.') }} / Rp {{ number_format($budget->amount, 0, ',', '.') }}
                        </span>
                        <span class="{{ !$isExceeded ? 'text-green-ios' : 'text-red-ios' }}">
                            {{ !$isExceeded ? 'Sisa' : 'Lebih' }} Rp {{ number_format(abs($budget->amount - $budget->spent), 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <!-- Empty State -->
        <div class="glass glass-static p-12 text-center">
            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-[var(--fill-primary)] flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-tertiary-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
            </div>
            <h3 class="text-ios-headline text-primary-ios mb-2">Belum Ada Budget</h3>
            <p class="text-ios-caption text-tertiary-ios mb-4">Buat budget untuk mengontrol pengeluaran Anda</p>
            <button onclick="openModal('budget-modal')" class="btn-ios btn-ios-primary">
                Buat Budget Pertama
            </button>
        </div>
        @endforelse

        @if(count($budgets) > 0)
        <!-- Add New Budget -->
        <div onclick="openModal('budget-modal')" class="glass glass-static p-6 flex items-center justify-center border-2 border-dashed border-[var(--separator)] cursor-pointer hover:bg-[var(--fill-primary)] transition-colors">
            <div class="text-center">
                <div class="w-12 h-12 rounded-xl bg-[var(--fill-primary)] flex items-center justify-center mx-auto mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-tertiary-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <p class="text-ios-body text-tertiary-ios">Tambah Budget Baru</p>
            </div>
        </div>
        @endif
    </div>

    <!-- Budget Modal -->
    <x-slot name="modal">
        <div class="modal-backdrop" id="budget-modal-backdrop"></div>
        <div class="modal-content" id="budget-modal">
            <div class="modal-header">
                <h3 class="text-ios-headline text-primary-ios">Buat Budget</h3>
                <button onclick="closeModal('budget-modal')" class="p-2 rounded-lg hover:bg-[var(--fill-primary)] text-tertiary-ios">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form action="{{ route('budget.store') }}" method="POST">
                @csrf
                <div class="modal-body space-y-4">
                    <!-- Category -->
                    <div class="form-group">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select name="category_id" id="category_id" class="input-ios" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($availableCategories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->icon }} {{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @if(count($availableCategories) === 0)
                        <p class="form-hint text-orange-ios">Semua kategori pengeluaran sudah memiliki budget</p>
                        @endif
                    </div>

                    <!-- Amount -->
                    <div class="form-group">
                        <label for="amount" class="form-label">Jumlah Budget</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-secondary-ios">Rp</span>
                            <input type="number" name="amount" id="amount" class="input-ios pl-10" placeholder="0" min="1000" required>
                        </div>
                        <p class="form-hint">Masukkan jumlah maksimal pengeluaran untuk kategori ini</p>
                    </div>

                    <!-- Period -->
                    <div class="form-group">
                        <label for="period" class="form-label">Periode</label>
                        <select name="period" id="period" class="input-ios" required>
                            <option value="monthly">Bulanan</option>
                            <option value="weekly">Mingguan</option>
                            <option value="yearly">Tahunan</option>
                        </select>
                    </div>

                    <!-- Start Date -->
                    <div class="form-group">
                        <label for="start_date" class="form-label">Mulai Dari</label>
                        <input type="date" name="start_date" id="start_date" class="input-ios" value="{{ date('Y-m-01') }}" required>
                    </div>

                    <!-- Alert Threshold -->
                    <div class="form-group">
                        <label for="alert_threshold" class="form-label">Peringatan pada (%)</label>
                        <input type="range" name="alert_threshold" id="alert_threshold" min="50" max="100" value="80" class="w-full accent-[var(--accent-color)]">
                        <div class="flex justify-between text-ios-caption text-tertiary-ios mt-1">
                            <span>50%</span>
                            <span id="threshold-value">80%</span>
                            <span>100%</span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" onclick="closeModal('budget-modal')" class="btn-ios btn-ios-secondary flex-1">Batal</button>
                    <button type="submit" class="btn-ios btn-ios-primary flex-1" {{ count($availableCategories) === 0 ? 'disabled' : '' }}>Simpan</button>
                </div>
            </form>
        </div>
    </x-slot>

    <script>
        document.getElementById('alert_threshold')?.addEventListener('input', function() {
            document.getElementById('threshold-value').textContent = this.value + '%';
        });
    </script>
</x-dashboard-layout>
