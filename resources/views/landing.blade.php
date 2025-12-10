<x-landing-layout>
    <!-- Hero Section -->
    <section class="min-h-screen flex items-center justify-center pt-20 px-4 relative overflow-hidden">
        <div class="max-w-5xl mx-auto text-center relative z-10">
            <!-- Badge -->
            <div class="fade-in-up inline-flex items-center gap-2 px-4 py-2 rounded-full glass-card mb-8">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                <span class="text-sm text-gray-300">Platform Keuangan #1 di Indonesia</span>
            </div>

            <!-- Main Headline -->
            <h1 class="fade-in-up fade-in-up-delay-1 text-5xl md:text-7xl font-extrabold leading-tight mb-6">
                Kelola Uang Jadi 
                <span class="text-gradient">Lebih Mudah</span> 
                dan Terkontrol
            </h1>

            <!-- Subheadline -->
            <p class="fade-in-up fade-in-up-delay-2 text-xl md:text-2xl text-gray-400 max-w-3xl mx-auto mb-10">
                DuitKu membantu Anda melacak pengeluaran, mengatur budget, dan mencapai tujuan finansial dengan cara yang simpel dan menyenangkan.
            </p>

            <!-- CTA Buttons -->
            <div class="fade-in-up fade-in-up-delay-3 flex flex-col sm:flex-row items-center justify-center gap-4 mb-16">
                <a href="{{ route('register') }}" class="btn btn-lg bg-gradient-to-r from-purple-600 to-pink-600 border-0 text-white btn-glow px-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Mulai Gratis Sekarang
                </a>
                <a href="#features" class="btn btn-lg btn-ghost text-gray-300 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Lihat Demo
                </a>
            </div>

            <!-- Dashboard Preview -->
            <div class="fade-in-up fade-in-up-delay-4 relative">
                <div class="glass-card p-2 md:p-4 glow-primary">
                    <div class="bg-gray-900/80 rounded-xl overflow-hidden">
                        <!-- Mock Dashboard -->
                        <div class="p-4 md:p-6">
                            <!-- Top Stats -->
                            <div class="grid grid-cols-3 gap-4 mb-6">
                                <div class="glass-card p-4 text-left">
                                    <p class="text-gray-400 text-sm mb-1">Total Saldo</p>
                                    <p class="text-2xl font-bold text-green-400">Rp 12.5M</p>
                                </div>
                                <div class="glass-card p-4 text-left">
                                    <p class="text-gray-400 text-sm mb-1">Pengeluaran</p>
                                    <p class="text-2xl font-bold text-red-400">Rp 3.2M</p>
                                </div>
                                <div class="glass-card p-4 text-left">
                                    <p class="text-gray-400 text-sm mb-1">Tabungan</p>
                                    <p class="text-2xl font-bold text-blue-400">Rp 5.8M</p>
                                </div>
                            </div>
                            <!-- Chart Placeholder -->
                            <div class="h-32 md:h-48 bg-gradient-to-r from-purple-500/20 to-pink-500/20 rounded-xl flex items-end justify-around p-4">
                                <div class="w-8 bg-purple-500/60 rounded-t" style="height: 40%"></div>
                                <div class="w-8 bg-purple-500/60 rounded-t" style="height: 65%"></div>
                                <div class="w-8 bg-purple-500/60 rounded-t" style="height: 45%"></div>
                                <div class="w-8 bg-purple-500/60 rounded-t" style="height: 80%"></div>
                                <div class="w-8 bg-pink-500/60 rounded-t" style="height: 55%"></div>
                                <div class="w-8 bg-pink-500/60 rounded-t" style="height: 90%"></div>
                                <div class="w-8 bg-pink-500/60 rounded-t" style="height: 70%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">
                    Fitur yang <span class="text-gradient">Powerful</span>
                </h2>
                <p class="text-xl text-gray-400 max-w-2xl mx-auto">
                    Semua yang Anda butuhkan untuk mengelola keuangan dalam satu platform
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Feature 1 -->
                <div class="glass-card glass-card-hover p-8">
                    <div class="feature-icon mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-400 icon-glow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Tracking Otomatis</h3>
                    <p class="text-gray-400">
                        Lacak semua transaksi secara otomatis dan lihat kemana uang Anda pergi dengan visualisasi yang jelas.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="glass-card glass-card-hover p-8">
                    <div class="feature-icon mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-pink-400 icon-glow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Budget Cerdas</h3>
                    <p class="text-gray-400">
                        Buat budget untuk setiap kategori dan dapatkan notifikasi ketika mendekati limit.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="glass-card glass-card-hover p-8">
                    <div class="feature-icon mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400 icon-glow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Tujuan Tabungan</h3>
                    <p class="text-gray-400">
                        Set target tabungan untuk impian Anda dan pantau progres setiap saat.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="glass-card glass-card-hover p-8">
                    <div class="feature-icon mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-400 icon-glow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Keamanan Terjamin</h3>
                    <p class="text-gray-400">
                        Data Anda terenkripsi dengan standar keamanan tertinggi. Privasi Anda prioritas kami.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="glass-card glass-card-hover p-8">
                    <div class="feature-icon mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-400 icon-glow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Laporan Detail</h3>
                    <p class="text-gray-400">
                        Dapatkan insight mendalam dengan laporan mingguan dan bulanan yang komprehensif.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="glass-card glass-card-hover p-8">
                    <div class="feature-icon mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-400 icon-glow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Akses di Mana Saja</h3>
                    <p class="text-gray-400">
                        Akses dari browser manapun. Responsive dan cepat di semua perangkat.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-24 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">
                    Cara <span class="text-gradient">Kerja</span>
                </h2>
                <p class="text-xl text-gray-400 max-w-2xl mx-auto">
                    Mulai mengelola keuangan dalam 3 langkah mudah
                </p>
            </div>

            <!-- Steps -->
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="relative text-center">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-purple-600 to-pink-600 flex items-center justify-center text-3xl font-bold glow-primary">
                        1
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Daftar Gratis</h3>
                    <p class="text-gray-400">
                        Buat akun dalam hitungan detik. Tidak perlu kartu kredit.
                    </p>
                    <!-- Connector Line (hidden on mobile) -->
                    <div class="hidden md:block absolute top-10 left-[60%] w-[80%] h-0.5 bg-gradient-to-r from-purple-500/50 to-transparent"></div>
                </div>

                <!-- Step 2 -->
                <div class="relative text-center">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-pink-600 to-blue-600 flex items-center justify-center text-3xl font-bold glow-accent">
                        2
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Tambah Transaksi</h3>
                    <p class="text-gray-400">
                        Catat pemasukan dan pengeluaran dengan mudah setiap hari.
                    </p>
                    <!-- Connector Line (hidden on mobile) -->
                    <div class="hidden md:block absolute top-10 left-[60%] w-[80%] h-0.5 bg-gradient-to-r from-pink-500/50 to-transparent"></div>
                </div>

                <!-- Step 3 -->
                <div class="text-center">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-blue-600 to-green-600 flex items-center justify-center text-3xl font-bold pulse-glow">
                        3
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Lihat Insight</h3>
                    <p class="text-gray-400">
                        Dapatkan analisis dan rekomendasi untuk keuangan lebih sehat.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-24 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="glass-card p-8 md:p-12">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    <!-- Stat 1 -->
                    <div>
                        <p class="stat-number text-gradient">50K+</p>
                        <p class="text-gray-400 mt-2">Pengguna Aktif</p>
                    </div>
                    <!-- Stat 2 -->
                    <div>
                        <p class="stat-number text-gradient">Rp 1T+</p>
                        <p class="text-gray-400 mt-2">Transaksi Tercatat</p>
                    </div>
                    <!-- Stat 3 -->
                    <div>
                        <p class="stat-number text-gradient">4.9</p>
                        <p class="text-gray-400 mt-2">Rating Pengguna</p>
                    </div>
                    <!-- Stat 4 -->
                    <div>
                        <p class="stat-number text-gradient">99.9%</p>
                        <p class="text-gray-400 mt-2">Uptime</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-24 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">
                    Apa Kata <span class="text-gradient">Mereka</span>
                </h2>
                <p class="text-xl text-gray-400 max-w-2xl mx-auto">
                    Ribuan pengguna sudah merasakan manfaatnya
                </p>
            </div>

            <!-- Testimonials Grid -->
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Testimonial 1 -->
                <div class="glass-card glass-card-hover p-8">
                    <div class="flex items-center gap-1 mb-4">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    <p class="text-gray-300 mb-6">
                        "DuitKu mengubah cara saya mengelola keuangan. Sekarang saya tahu persis kemana uang saya pergi setiap bulan."
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-lg font-bold">
                            A
                        </div>
                        <div>
                            <p class="font-semibold">Andi Pratama</p>
                            <p class="text-sm text-gray-400">Software Engineer</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="glass-card glass-card-hover p-8">
                    <div class="flex items-center gap-1 mb-4">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    <p class="text-gray-300 mb-6">
                        "Fitur budgetnya sangat membantu! Saya berhasil menabung 30% lebih banyak sejak pakai DuitKu."
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center text-lg font-bold">
                            S
                        </div>
                        <div>
                            <p class="font-semibold">Sari Dewi</p>
                            <p class="text-sm text-gray-400">Marketing Manager</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="glass-card glass-card-hover p-8">
                    <div class="flex items-center gap-1 mb-4">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    <p class="text-gray-300 mb-6">
                        "Interface-nya modern dan mudah digunakan. Laporan bulanannya sangat detail dan informatif."
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-green-500 to-emerald-500 flex items-center justify-center text-lg font-bold">
                            B
                        </div>
                        <div>
                            <p class="font-semibold">Budi Santoso</p>
                            <p class="text-sm text-gray-400">Business Owner</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 px-4">
        <div class="max-w-4xl mx-auto">
            <div class="glass-card p-8 md:p-16 text-center relative overflow-hidden">
                <!-- Background Glow -->
                <div class="absolute inset-0 bg-gradient-to-r from-purple-600/20 via-pink-600/20 to-blue-600/20 pointer-events-none"></div>
                
                <div class="relative z-10">
                    <h2 class="text-4xl md:text-5xl font-bold mb-6">
                        Siap Mengontrol <span class="text-gradient">Keuangan</span> Anda?
                    </h2>
                    <p class="text-xl text-gray-400 mb-8 max-w-2xl mx-auto">
                        Bergabung dengan 50,000+ pengguna yang sudah mengelola keuangan mereka dengan lebih baik.
                    </p>
                    <a href="{{ route('register') }}" class="btn btn-lg bg-gradient-to-r from-purple-600 to-pink-600 border-0 text-white btn-glow px-12">
                        Mulai Gratis Sekarang
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                    <p class="text-sm text-gray-500 mt-4">
                        Gratis selamanya • Tidak perlu kartu kredit
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-landing-layout>