<x-dashboard-layout>
    <x-slot name="pageTitle">Profil</x-slot>

    <div class="max-w-2xl mx-auto">
        <!-- Profile Header -->
        <div class="glass glass-static p-6 text-center mb-6 fade-in-ios">
            <div class="w-24 h-24 mx-auto mb-4 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-4xl text-white font-semibold">
                {{ auth()->check() ? strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) : 'U' }}
            </div>
            <h1 class="text-ios-title text-primary-ios mb-1">{{ auth()->user()->name ?? 'User' }}</h1>
            <p class="text-ios-body text-secondary-ios">{{ auth()->user()->email ?? 'user@example.com' }}</p>
            <p class="text-ios-caption text-tertiary-ios mt-2">Bergabung sejak {{ auth()->user()->created_at?->format('F Y') ?? 'Desember 2024' }}</p>
        </div>

        <!-- Edit Profile Form -->
        <div class="glass glass-static p-6 mb-6 fade-in-ios" style="animation-delay: 0.1s">
            <h2 class="text-ios-headline text-primary-ios mb-4">Informasi Profil</h2>
            
            <form class="space-y-4">
                <!-- Avatar Upload -->
                <div>
                    <label class="block text-ios-caption text-secondary-ios mb-2">Foto Profil</label>
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-2xl text-white font-semibold">
                            {{ auth()->check() ? strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) : 'U' }}
                        </div>
                        <div>
                            <button type="button" class="btn-ios btn-ios-secondary text-sm">Upload Foto</button>
                            <p class="text-ios-caption text-tertiary-ios mt-1">JPG, PNG. Max 2MB</p>
                        </div>
                    </div>
                </div>

                <!-- Name -->
                <div>
                    <label for="name" class="block text-ios-caption text-secondary-ios mb-2">Nama Lengkap</label>
                    <input type="text" id="name" class="input-ios" value="{{ auth()->user()->name ?? '' }}" placeholder="Nama lengkap">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-ios-caption text-secondary-ios mb-2">Email</label>
                    <input type="email" id="email" class="input-ios" value="{{ auth()->user()->email ?? '' }}" placeholder="email@example.com">
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-ios-caption text-secondary-ios mb-2">Nomor Telepon</label>
                    <input type="tel" id="phone" class="input-ios" placeholder="+62 812 xxxx xxxx">
                </div>

                <button type="submit" class="btn-ios btn-ios-primary w-full">
                    Simpan Perubahan
                </button>
            </form>
        </div>

        <!-- Change Password -->
        <div class="glass glass-static p-6 mb-6 fade-in-ios" style="animation-delay: 0.15s">
            <h2 class="text-ios-headline text-primary-ios mb-4">Ubah Password</h2>
            
            <form class="space-y-4">
                <div>
                    <label for="current_password" class="block text-ios-caption text-secondary-ios mb-2">Password Saat Ini</label>
                    <input type="password" id="current_password" class="input-ios" placeholder="••••••••">
                </div>

                <div>
                    <label for="new_password" class="block text-ios-caption text-secondary-ios mb-2">Password Baru</label>
                    <input type="password" id="new_password" class="input-ios" placeholder="••••••••">
                </div>

                <div>
                    <label for="confirm_password" class="block text-ios-caption text-secondary-ios mb-2">Konfirmasi Password</label>
                    <input type="password" id="confirm_password" class="input-ios" placeholder="••••••••">
                </div>

                <button type="submit" class="btn-ios btn-ios-secondary w-full">
                    Ubah Password
                </button>
            </form>
        </div>

        <!-- Stats -->
        <div class="glass glass-static p-6 mb-6 fade-in-ios" style="animation-delay: 0.2s">
            <h2 class="text-ios-headline text-primary-ios mb-4">Statistik Anda</h2>
            
            <div class="grid grid-cols-2 gap-4">
                <div class="text-center p-4 rounded-xl bg-[var(--fill-primary)]">
                    <p class="text-2xl font-semibold text-primary-ios">0</p>
                    <p class="text-ios-caption text-tertiary-ios">Total Transaksi</p>
                </div>
                <div class="text-center p-4 rounded-xl bg-[var(--fill-primary)]">
                    <p class="text-2xl font-semibold text-primary-ios">0</p>
                    <p class="text-ios-caption text-tertiary-ios">Kategori</p>
                </div>
                <div class="text-center p-4 rounded-xl bg-[var(--fill-primary)]">
                    <p class="text-2xl font-semibold text-primary-ios">0</p>
                    <p class="text-ios-caption text-tertiary-ios">Budget Aktif</p>
                </div>
                <div class="text-center p-4 rounded-xl bg-[var(--fill-primary)]">
                    <p class="text-2xl font-semibold text-green-ios">Rp 0</p>
                    <p class="text-ios-caption text-tertiary-ios">Total Tabungan</p>
                </div>
            </div>
        </div>

        <!-- Danger Zone -->
        <div class="glass glass-static p-6 border border-red-500/20 fade-in-ios" style="animation-delay: 0.25s">
            <h2 class="text-ios-headline text-red-ios mb-4">Zona Berbahaya</h2>
            
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-ios-body text-primary-ios">Hapus Akun</p>
                        <p class="text-ios-caption text-tertiary-ios">Hapus akun dan semua data secara permanen</p>
                    </div>
                    <button class="btn-ios bg-red-500/10 text-red-ios border border-red-500/20 hover:bg-red-500/20">
                        Hapus Akun
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
