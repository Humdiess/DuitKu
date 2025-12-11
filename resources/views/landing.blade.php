<x-landing-layout>
    <!-- Hero Section -->
    <section class="min-h-screen flex items-center pt-14">
        <div class="container-ios">
            <div class="max-w-3xl mx-auto text-center py-16">
                <!-- Badge -->
                <div class="animate-fade-up inline-block mb-6">
                    <span class="glass-pill px-4 py-2 text-ios-caption">
                        <span class="w-2 h-2 rounded-full bg-green-500 mr-2 inline-block animate-pulse"></span>
                        Platform Keuangan Pribadi
                    </span>
                </div>

                <!-- Headline -->
                <h1 class="animate-fade-up animation-delay-100 text-hero-ios text-primary-ios mb-6">
                    Kelola Keuangan <span class="text-gradient-ios">Lebih Mudah</span>
                </h1>

                <!-- Subheadline -->
                <p class="animate-fade-up animation-delay-200 text-ios-body text-secondary-ios max-w-xl mx-auto mb-10">
                    Lacak pengeluaran, atur budget, dan capai tujuan finansial Anda dengan cara yang simpel.
                </p>

                <!-- CTA Buttons -->
                <div class="animate-fade-up animation-delay-300 flex flex-col sm:flex-row items-center justify-center gap-3">
                    <a href="{{ route('register') }}" class="btn-ios btn-ios-primary w-full sm:w-auto group">
                        Mulai Gratis
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a href="#features" class="btn-ios btn-ios-secondary w-full sm:w-auto">
                        Pelajari Lebih
                    </a>
                </div>
            </div>

            <!-- Dashboard Preview with Cursor Tour -->
            <div class="animate-fade-up animation-delay-400 max-w-4xl mx-auto perspective-1000">
                <div class="dashboard-preview glass glass-static p-4 sm:p-6 transform-gpu hover:scale-[1.02] transition-transform duration-500 relative overflow-hidden">
                    <!-- Animated Cursor -->
                    <div id="tour-cursor" class="absolute z-50 pointer-events-none opacity-0">
                        <div class="relative">
                            <!-- Cursor -->
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="drop-shadow-lg">
                                <path d="M5.5 3.21V20.79C5.5 21.47 6.27 21.85 6.81 21.43L10.5 18.21L13.5 24L17 22.5L14 16.5L19.5 15.79C20.17 15.69 20.41 14.87 19.91 14.43L5.5 3.21Z" fill="white" stroke="var(--accent-color)" stroke-width="1.5"/>
                            </svg>
                            <!-- Click ripple -->
                            <div id="cursor-ripple" class="absolute top-0 left-0 w-8 h-8 rounded-full border-2 border-blue-400 opacity-0 scale-0"></div>
                        </div>
                    </div>

                    <!-- Tooltip -->
                    <div id="tour-tooltip" class="absolute z-40 glass glass-heavy px-4 py-2 rounded-xl text-ios-caption text-primary-ios opacity-0 pointer-events-none whitespace-nowrap">
                        <span id="tooltip-text">Lihat saldo total Anda</span>
                    </div>

                    <!-- Mini Dashboard UI -->
                    <div class="flex gap-4">
                        <!-- Sidebar Mock -->
                        <div class="hidden sm:block w-40 shrink-0">
                            <div class="glass glass-static p-3 rounded-xl space-y-2">
                                <div class="flex items-center gap-2 mb-4">
                                    <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600"></div>
                                    <span class="text-xs font-medium text-primary-ios">DuitKu</span>
                                </div>
                                <div id="tour-nav-dashboard" class="flex items-center gap-2 px-2 py-1.5 rounded-lg bg-[var(--fill-primary)] text-xs text-primary-ios">
                                    <div class="w-4 h-4 rounded bg-blue-500/30"></div>
                                    Dashboard
                                </div>
                                <div id="tour-nav-transaksi" class="flex items-center gap-2 px-2 py-1.5 rounded-lg text-xs text-tertiary-ios hover:bg-[var(--fill-primary)] transition-colors">
                                    <div class="w-4 h-4 rounded bg-gray-500/30"></div>
                                    Transaksi
                                </div>
                                <div class="flex items-center gap-2 px-2 py-1.5 rounded-lg text-xs text-tertiary-ios">
                                    <div class="w-4 h-4 rounded bg-gray-500/30"></div>
                                    Kategori
                                </div>
                                <div class="flex items-center gap-2 px-2 py-1.5 rounded-lg text-xs text-tertiary-ios">
                                    <div class="w-4 h-4 rounded bg-gray-500/30"></div>
                                    Budget
                                </div>
                            </div>
                        </div>

                        <!-- Main Content -->
                        <div class="flex-1 space-y-4">
                            <!-- Stats Row -->
                            <div class="grid grid-cols-3 gap-3">
                                <div id="tour-stat-saldo" class="glass glass-static p-3 rounded-xl">
                                    <p class="text-xs text-tertiary-ios mb-1">Total Saldo</p>
                                    <p class="text-lg font-semibold text-green-ios">Rp 12.5M</p>
                                    <span class="text-xs text-green-ios">+12%</span>
                                </div>
                                <div id="tour-stat-expense" class="glass glass-static p-3 rounded-xl">
                                    <p class="text-xs text-tertiary-ios mb-1">Pengeluaran</p>
                                    <p class="text-lg font-semibold text-red-ios">Rp 3.2M</p>
                                    <span class="text-xs text-tertiary-ios">Bulan ini</span>
                                </div>
                                <div id="tour-stat-saving" class="glass glass-static p-3 rounded-xl">
                                    <p class="text-xs text-tertiary-ios mb-1">Tabungan</p>
                                    <p class="text-lg font-semibold text-accent-ios">Rp 5.8M</p>
                                    <span class="text-xs text-tertiary-ios">Target 80%</span>
                                </div>
                            </div>

                            <!-- Chart Area -->
                            <div id="tour-chart" class="glass glass-static p-4 rounded-xl">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-xs font-medium text-primary-ios">Grafik Keuangan</span>
                                    <span class="text-xs text-tertiary-ios">7 Hari</span>
                                </div>
                                <div class="h-24 flex items-end justify-around gap-2">
                                    <div class="chart-bar w-6 rounded-t transition-all" style="height: 40%; background: linear-gradient(to top, rgba(59,130,246,0.3), rgba(59,130,246,0.5))"></div>
                                    <div class="chart-bar w-6 rounded-t transition-all" style="height: 65%; background: linear-gradient(to top, rgba(59,130,246,0.3), rgba(59,130,246,0.5))"></div>
                                    <div class="chart-bar w-6 rounded-t transition-all" style="height: 45%; background: linear-gradient(to top, rgba(59,130,246,0.3), rgba(59,130,246,0.5))"></div>
                                    <div class="chart-bar w-6 rounded-t transition-all" style="height: 80%; background: linear-gradient(to top, rgba(139,92,246,0.4), rgba(139,92,246,0.6))"></div>
                                    <div class="chart-bar w-6 rounded-t transition-all" style="height: 55%; background: linear-gradient(to top, rgba(139,92,246,0.4), rgba(139,92,246,0.6))"></div>
                                    <div class="chart-bar w-6 rounded-t transition-all" style="height: 90%; background: linear-gradient(to top, rgba(139,92,246,0.4), rgba(139,92,246,0.6))"></div>
                                    <div class="chart-bar w-6 rounded-t transition-all" style="height: 70%; background: linear-gradient(to top, rgba(139,92,246,0.4), rgba(139,92,246,0.6))"></div>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="grid grid-cols-4 gap-2">
                                <div id="tour-action-income" class="glass glass-static p-2 rounded-xl text-center cursor-pointer hover:bg-[var(--glass-bg-heavy)] transition-colors">
                                    <div class="w-6 h-6 mx-auto mb-1 rounded-lg bg-green-500/20 flex items-center justify-center text-green-ios text-xs">+</div>
                                    <span class="text-xs text-tertiary-ios">Pemasukan</span>
                                </div>
                                <div class="glass glass-static p-2 rounded-xl text-center">
                                    <div class="w-6 h-6 mx-auto mb-1 rounded-lg bg-red-500/20 flex items-center justify-center text-red-ios text-xs">-</div>
                                    <span class="text-xs text-tertiary-ios">Pengeluaran</span>
                                </div>
                                <div class="glass glass-static p-2 rounded-xl text-center">
                                    <div class="w-6 h-6 mx-auto mb-1 rounded-lg bg-blue-500/20 flex items-center justify-center text-accent-ios text-xs">↔</div>
                                    <span class="text-xs text-tertiary-ios">Transfer</span>
                                </div>
                                <div class="glass glass-static p-2 rounded-xl text-center">
                                    <div class="w-6 h-6 mx-auto mb-1 rounded-lg bg-purple-500/20 flex items-center justify-center text-purple-400 text-xs">📊</div>
                                    <span class="text-xs text-tertiary-ios">Laporan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="section-ios">
        <div class="container-ios">
            <div class="text-center mb-12 scroll-reveal">
                <h2 class="text-ios-title text-primary-ios mb-4">Fitur Lengkap</h2>
                <p class="text-ios-body text-secondary-ios">Semua yang Anda butuhkan untuk mengelola keuangan</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @php
                $features = [
                    ['icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z', 'title' => 'Tracking Transaksi', 'desc' => 'Lacak semua pemasukan dan pengeluaran.'],
                    ['icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'Budget Bulanan', 'desc' => 'Atur budget untuk setiap kategori.'],
                    ['icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6', 'title' => 'Target Tabungan', 'desc' => 'Set target dan pantau progres.'],
                    ['icon' => 'M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z', 'title' => 'Laporan Detail', 'desc' => 'Insight mendalam dengan visualisasi.'],
                    ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'title' => 'Aman & Privat', 'desc' => 'Data terenkripsi dengan standar tinggi.'],
                    ['icon' => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z', 'title' => 'Akses Anywhere', 'desc' => 'Responsive di semua perangkat.'],
                ];
                @endphp

                @foreach($features as $index => $feature)
                <div class="scroll-reveal glass p-5 group hover:scale-[1.02] transition-all duration-300" style="animation-delay: {{ $index * 100 }}ms">
                    <div class="icon-ios mb-4 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent-ios" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $feature['icon'] }}" />
                        </svg>
                    </div>
                    <h3 class="text-ios-headline text-primary-ios mb-2">{{ $feature['title'] }}</h3>
                    <p class="text-ios-caption">{{ $feature['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="section-ios">
        <div class="container-ios">
            <div class="text-center mb-12 scroll-reveal">
                <h2 class="text-ios-title text-primary-ios mb-4">Cara Kerja</h2>
                <p class="text-ios-body text-secondary-ios">3 langkah mudah untuk mulai</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6 max-w-3xl mx-auto">
                @foreach([['1', 'Daftar', 'Buat akun gratis dalam hitungan detik.'], ['2', 'Catat', 'Input transaksi harian Anda.'], ['3', 'Analisis', 'Lihat insight dan tingkatkan finansial.']] as $index => $step)
                <div class="scroll-reveal text-center" style="animation-delay: {{ $index * 150 }}ms">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-lg font-bold mx-auto mb-4 hover:scale-110 transition-transform">
                        {{ $step[0] }}
                    </div>
                    <h3 class="text-ios-headline text-primary-ios mb-2">{{ $step[1] }}</h3>
                    <p class="text-ios-caption">{{ $step[2] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="section-ios">
        <div class="container-ios">
            <div class="scroll-reveal glass glass-static p-8 sm:p-12">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    @foreach([['50K+', 'Pengguna'], ['1T+', 'Transaksi'], ['4.9', 'Rating'], ['99%', 'Uptime']] as $index => $stat)
                    <div class="counter-animate" style="animation-delay: {{ $index * 100 }}ms">
                        <p class="stat-ios text-gradient-ios" data-target="{{ $stat[0] }}">{{ $stat[0] }}</p>
                        <p class="text-ios-caption mt-2">{{ $stat[1] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="section-ios">
        <div class="container-ios">
            <div class="text-center mb-12 scroll-reveal">
                <h2 class="text-ios-title text-primary-ios mb-4">Testimoni</h2>
                <p class="text-ios-body text-secondary-ios">Apa kata pengguna kami</p>
            </div>

            <div class="grid md:grid-cols-3 gap-4">
                @foreach([
                    ['A', 'from-blue-500 to-purple-600', 'Andi Pratama', 'Software Engineer', 'DuitKu mengubah cara saya mengelola keuangan. Sangat mudah digunakan.'],
                    ['S', 'from-pink-500 to-rose-600', 'Sari Dewi', 'Marketing Manager', 'Berhasil menabung 30% lebih banyak sejak pakai DuitKu.'],
                    ['B', 'from-green-500 to-emerald-600', 'Budi Santoso', 'Business Owner', 'Interface modern dan laporan yang sangat informatif.']
                ] as $index => $testi)
                <div class="scroll-reveal glass p-5 hover:scale-[1.02] transition-all duration-300" style="animation-delay: {{ $index * 100 }}ms">
                    <div class="flex gap-1 mb-4">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-4 h-4 text-orange-ios" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    <p class="text-ios-body text-secondary-ios mb-4">"{{ $testi[4] }}"</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br {{ $testi[1] }} flex items-center justify-center text-white text-sm font-medium">
                            {{ $testi[0] }}
                        </div>
                        <div>
                            <p class="text-ios-headline text-primary-ios">{{ $testi[2] }}</p>
                            <p class="text-ios-caption">{{ $testi[3] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="section-ios">
        <div class="container-ios">
            <div class="scroll-reveal glass glass-static p-8 sm:p-12 text-center max-w-2xl mx-auto hover:scale-[1.01] transition-transform duration-500">
                <h2 class="text-ios-title text-primary-ios mb-4">Siap Mengelola Keuangan?</h2>
                <p class="text-ios-body text-secondary-ios mb-8">Bergabung dengan 50,000+ pengguna.</p>
                <a href="{{ route('register') }}" class="btn-ios btn-ios-primary group">
                    Mulai Gratis Sekarang
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
                <p class="text-ios-caption mt-4">Gratis selamanya • Tidak perlu kartu kredit</p>
            </div>
        </div>
    </section>

    <!-- Custom Styles & Scripts -->
    <style>
        /* Animation Utilities */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-up {
            animation: fadeUp 0.8s ease-out forwards;
        }

        .animation-delay-100 { animation-delay: 0.1s; opacity: 0; }
        .animation-delay-200 { animation-delay: 0.2s; opacity: 0; }
        .animation-delay-300 { animation-delay: 0.3s; opacity: 0; }
        .animation-delay-400 { animation-delay: 0.4s; opacity: 0; }

        /* Scroll Reveal */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .scroll-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        /* Perspective for 3D effect */
        .perspective-1000 {
            perspective: 1000px;
        }

        /* Chart bar animation */
        .chart-bar {
            transform-origin: bottom;
            animation: growUp 1s ease-out forwards;
        }

        @keyframes growUp {
            from { transform: scaleY(0); }
            to { transform: scaleY(1); }
        }

        /* Cursor ripple animation */
        @keyframes cursorRipple {
            0% { opacity: 1; transform: scale(0); }
            100% { opacity: 0; transform: scale(2); }
        }

        #cursor-ripple.animate {
            animation: cursorRipple 0.6s ease-out forwards;
        }

        /* Smooth cursor movement */
        #tour-cursor {
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        #tour-tooltip {
            transition: all 0.3s ease;
        }

        /* Highlight effect */
        .tour-highlight {
            box-shadow: 0 0 0 3px rgba(10, 132, 255, 0.4), 0 0 20px rgba(10, 132, 255, 0.2);
        }
    </style>

    <script>
        // Scroll Reveal Animation
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const scrollObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.scroll-reveal').forEach(el => {
            scrollObserver.observe(el);
        });

        // Dashboard Tour - Auto-playing cursor animation
        const tourSteps = [
            { target: '#tour-stat-saldo', tooltip: 'Lihat saldo total Anda 💰', duration: 2000 },
            { target: '#tour-stat-expense', tooltip: 'Track pengeluaran bulan ini 📉', duration: 2000 },
            { target: '#tour-chart', tooltip: 'Visualisasi keuangan 7 hari 📊', duration: 2500 },
            { target: '#tour-action-income', tooltip: 'Tambah pemasukan dengan mudah ➕', duration: 2000 },
            { target: '#tour-nav-transaksi', tooltip: 'Kelola semua transaksi 📋', duration: 2000 },
        ];

        let currentStep = 0;

        function runTour() {
            const cursor = document.getElementById('tour-cursor');
            const tooltip = document.getElementById('tour-tooltip');
            const tooltipText = document.getElementById('tooltip-text');
            const ripple = document.getElementById('cursor-ripple');
            const preview = document.querySelector('.dashboard-preview');

            if (!cursor || !tooltip || !preview) return;

            function animateToStep(step) {
                const target = document.querySelector(step.target);
                if (!target) return;

                const previewRect = preview.getBoundingClientRect();
                const targetRect = target.getBoundingClientRect();

                // Calculate position relative to preview
                const x = targetRect.left - previewRect.left + targetRect.width / 2;
                const y = targetRect.top - previewRect.top + targetRect.height / 2;

                // Move cursor
                cursor.style.opacity = '1';
                cursor.style.left = x + 'px';
                cursor.style.top = y + 'px';

                // Update tooltip
                tooltipText.textContent = step.tooltip;
                tooltip.style.opacity = '1';
                tooltip.style.left = (x + 30) + 'px';
                tooltip.style.top = (y - 10) + 'px';

                // Remove previous highlights
                document.querySelectorAll('.tour-highlight').forEach(el => el.classList.remove('tour-highlight'));

                // Add highlight with delay
                setTimeout(() => {
                    target.classList.add('tour-highlight');

                    // Trigger click animation
                    ripple.classList.remove('animate');
                    void ripple.offsetWidth; // Force reflow
                    ripple.classList.add('animate');
                }, 400);
            }

            function nextStep() {
                animateToStep(tourSteps[currentStep]);
                currentStep = (currentStep + 1) % tourSteps.length;
            }

            // Start tour after a delay
            setTimeout(() => {
                nextStep();
                setInterval(nextStep, tourSteps[currentStep]?.duration || 2500);
            }, 1500);
        }

        // Start tour when dashboard preview is in view
        const dashboardPreview = document.querySelector('.dashboard-preview');
        if (dashboardPreview) {
            const tourObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        runTour();
                        tourObserver.disconnect();
                    }
                });
            }, { threshold: 0.5 });

            tourObserver.observe(dashboardPreview);
        }
    </script>
</x-landing-layout>