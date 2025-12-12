<x-dashboard-layout>
    <x-slot name="pageTitle">Budget</x-slot>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 fade-in-ios">
        <div>
            <h1 class="text-ios-title text-primary-ios mb-1">Budget</h1>
            <p class="text-ios-body text-secondary-ios">Atur dan pantau budget bulanan</p>
        </div>
        <div class="flex gap-3">
            <select name="month" class="input-ios">
                <option>Desember 2024</option>
                <option>November 2024</option>
                <option>Oktober 2024</option>
            </select>
            <button onclick="openModal('budget-modal')" class="btn-ios btn-ios-primary">
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
            <p class="text-2xl font-semibold text-primary-ios">Rp 5.500.000</p>
        </div>
        <div class="glass p-4">
            <p class="text-ios-caption text-tertiary-ios mb-1">Terpakai</p>
            <p class="text-2xl font-semibold text-red-ios">Rp 2.150.000</p>
        </div>
        <div class="glass p-4">
            <p class="text-ios-caption text-tertiary-ios mb-1">Sisa</p>
            <p class="text-2xl font-semibold text-green-ios">Rp 3.350.000</p>
        </div>
    </div>

    <!-- Budget List -->
    <div class="space-y-4 fade-in-ios" style="animation-delay: 0.2s">
        @php
        $budgets = [
            ['icon' => '🍔', 'name' => 'Makanan & Minuman', 'budget' => 2000000, 'spent' => 850000, 'color' => 'from-orange-500 to-red-500'],
            ['icon' => '🚗', 'name' => 'Transportasi', 'budget' => 1000000, 'spent' => 450000, 'color' => 'from-blue-500 to-cyan-500'],
            ['icon' => '🛒', 'name' => 'Belanja', 'budget' => 1500000, 'spent' => 500000, 'color' => 'from-pink-500 to-rose-500'],
            ['icon' => '🎮', 'name' => 'Hiburan', 'budget' => 500000, 'spent' => 250000, 'color' => 'from-purple-500 to-violet-500'],
            ['icon' => '💊', 'name' => 'Kesehatan', 'budget' => 500000, 'spent' => 100000, 'color' => 'from-green-500 to-emerald-500'],
        ];
        @endphp

        @foreach($budgets as $budget)
        @php
            $percentage = $budget['budget'] > 0 ? ($budget['spent'] / $budget['budget']) * 100 : 0;
            $remaining = $budget['budget'] - $budget['spent'];
        @endphp
        <div class="glass p-4 group">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br {{ $budget['color'] }} flex items-center justify-center text-2xl shrink-0">
                    {{ $budget['icon'] }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-ios-headline text-primary-ios">{{ $budget['name'] }}</h3>
                        <div class="flex items-center gap-2">
                            <span class="glass-pill px-2 py-1 text-xs {{ $percentage >= 80 ? 'text-red-ios' : ($percentage >= 50 ? 'text-orange-ios' : 'text-green-ios') }}">
                                {{ number_format($percentage, 0) }}%
                            </span>
                            <button class="p-1 rounded-lg hover:bg-[var(--fill-primary)] text-tertiary-ios opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <!-- Progress Bar -->
                    <div class="h-2 rounded-full bg-[var(--fill-primary)] mb-2 overflow-hidden">
                        <div class="h-full rounded-full bg-gradient-to-r {{ $budget['color'] }} transition-all" style="width: {{ min($percentage, 100) }}%"></div>
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
            <form action="#" method="POST">
                @csrf
                <div class="modal-body space-y-4">
                    <!-- Category -->
                    <div class="form-group">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select name="category_id" id="category_id" class="input-ios" required>
                            <option value="">Pilih Kategori</option>
                            <option value="1">🍔 Makanan & Minuman</option>
                            <option value="2">🚗 Transportasi</option>
                            <option value="3">🛒 Belanja</option>
                            <option value="4">🏠 Rumah Tangga</option>
                            <option value="5">💊 Kesehatan</option>
                            <option value="6">🎮 Hiburan</option>
                            <option value="7">📚 Pendidikan</option>
                        </select>
                    </div>

                    <!-- Amount -->
                    <div class="form-group">
                        <label for="amount" class="form-label">Jumlah Budget</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-secondary-ios">Rp</span>
                            <input type="number" name="amount" id="amount" class="input-ios pl-10" placeholder="0" required>
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
                    <button type="submit" class="btn-ios btn-ios-primary flex-1">Simpan</button>
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
