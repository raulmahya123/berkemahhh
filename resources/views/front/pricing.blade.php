<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
    />
</head>
<body class="text-black font-poppins pt-10 pb-[50px]">
    <div id="hero-section" class="max-w-[1200px] mx-auto w-full h-[536px] flex flex-col gap-10 pb-[50px] bg-[url('assets/background/Hero-Banner.png')] bg-center bg-no-repeat bg-cover rounded-[32px] overflow-hidden relative">
        <nav class="flex justify-between items-center pt-6 px-[50px]">
            <a href="index.html">
               <img src="{{ asset('assets/logo/logo.png') }}" alt="Logo" style="width: 50px;">

            </a>
            <ul class="flex items-center gap-[30px] text-white">
                <li>
                    <a href="{{ route('front.index') }}" class="font-semibold">Home</a>
                </li>
                <li>
                    <a href="{{ route('front.pricing') }}" class="font-semibold">Pricing</a>
                </li>

            </ul>
            @auth
            <div class="flex gap-[10px] items-center">
              <div class="flex flex-col items-end justify-center">
                  <p class="font-semibold text-white">Hi, {{ Auth::user()->name }}</p>
                  @if (Auth::user()->hasActiveSubscription())
                  <p class="p-[2px_10px] rounded-full bg-[#FF6129] font-semibold text-xs text-white text-center">
                  PRO
                  </p>
                  @endif
              </div>
              <a href="{{ route('dashboard') }}" class="w-[56px] h-[56px] overflow-hidden rounded-full flex shrink-0">

                  <img src="{{ Storage::url(Auth::user()->avatar) }}" class="w-full h-full object-cover" alt="photo">

              </a>
            </div>
            @endauth
            @guest
            <div class="flex gap-[10px] items-center">
              <a href="{{ route('register') }}" class="text-white font-semibold rounded-[30px] p-[16px_32px] ring-1 ring-white transition-all duration-300 hover:ring-2 hover:ring-[#FF6129]">Sign Up</a>
              <a href="{{ route('login') }}" class="text-white font-semibold rounded-[30px] p-[16px_32px] bg-[#FF6129] transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF612980]">Sign In</a>
            </div>
            @endguest
        </nav>
    </div>
    <section class="max-w-[1100px] w-full mx-auto absolute -translate-x-1/2 left-1/2 top-[170px]">
        <div class="flex flex-col gap-[30px] items-center">
            <div class="gradient-badge w-fit p-[8px_16px] rounded-full border border-[#FED6AD] flex items-center gap-[6px]">
                <div>
                    <img src="{{ asset('assets/icon/medal-star.svg') }}" alt="ikon">
                </div>
                <p class="font-medium text-sm text-[#FF6129]">Harga Lebih Baik Untuk Anda</p>
            </div>
            <div class="flex flex-col text-white text-center">
                <h2 class="font-bold text-[40px] leading-[60px]">Investasi & Dapatkan Pengembalian Lebih Besar</h2>
                <p class="text-lg -tracking-[2%]">Menguasai keterampilan yang dibutuhkan dan karier dengan gaji tinggi tahun ini</p>
            </div>
            <div class="max-w-[1000px] w-full flex gap-[30px]">
                <div class="flex flex-col rounded-3xl p-8 gap-[30px] bg-white h-fit">
                    <div class="flex flex-col gap-5">
                        <div class="flex flex-col gap-4">
                            <p class="font-semibold text-4xl leading-[54px]">Beasiswa</p>
                            <p class="text-[#475466] text-lg">Akses ke beberapa kursus online yang membantu Anda memulai jalur karir baru Anda</p>
                        </div>
                        <div class="flex flex-col gap-1">
                            <p class="font-semibold text-4xl leading-[54px]">Rp 0</p>
                            <p class="text-[#475466] text-lg">Gratis Selamanya</p>
                        </div>
                        <div class="flex flex-col gap-4">
                            <div class="flex gap-3">
                                <div class="w-6 h-6 flex shrink-0">
                                    <img src="{{ asset('assets/icon/tick-circle.svg') }}" class="w-full h-full object-cover" alt="ikon">
                                </div>
                                <p class="text-[#475466]">Akses semua materi kursus termasuk video, dokumen, panduan karir, dll.</p>
                            </div>
                            <div class="flex gap-3">
                                <div class="w-6 h-6 flex shrink-0">
                                    <img src="{{ asset('assets/icon/tick-circle.svg') }}" class="w-full h-full object-cover" alt="ikon">
                                </div>
                                <p class="text-[#475466]">Unlock semua lencana kursus untuk meningkatkan profil karir untuk melamar pekerjaan setelah selesai</p>
                            </div>
                        </div>
                    </div>
                    <a href="" class="p-[20px_32px] rounded-full text-center font-semibold text-xl ring-1 ring-black transition-all duration-300 hover:ring-2 hover:ring-[#FF6129]">Minta Akses</a>
                </div>
                <div class="flex flex-col rounded-3xl p-8 gap-[30px] bg-white h-fit">
                    <div class="flex flex-col gap-5">
                        <div class="flex flex-col gap-4">
                            <p class="font-semibold text-4xl leading-[54px]">Premium</p>
                            <p class="text-[#475466] text-lg">Akses penuh ke lebih dari 20.000 kursus online untuk memudahkan pertumbuhan karir Anda</p>
                        </div>
                        <div class="flex flex-col gap-1">
                            <p class="font-semibold text-4xl leading-[54px] price">
                                Rp <span class="strikethrough">42900</span> Gratis
                            </p>
                            <p class="text-[#475466] text-lg">Per Bulan</p>
                        </div>
                        <div class="flex flex-col gap-4">
                            <div class="flex gap-3">
                                <div class="w-6 h-6 flex shrink-0">
                                    <img src="{{ asset('assets/icon/tick-circle.svg') }}" class="w-full h-full object-cover" alt="ikon">
                                </div>
                                <p class="text-[#475466]">Akses semua materi kursus termasuk video, dokumen, panduan karir, dll.</p>
                            </div>
                            <div class="flex gap-3">
                                <div class="w-6 h-6 flex shrink-0">
                                    <img src="{{ asset('assets/icon/tick-circle.svg') }}" class="w-full h-full object-cover" alt="ikon">
                                </div>
                                <p class="text-[#475466]">Unlock semua lencana kursus untuk meningkatkan profil karir untuk melamar pekerjaan setelah selesai</p>
                            </div>
                            <div class="flex gap-3">
                                <div class="w-6 h-6 flex shrink-0">
                                    <img src="{{ asset('assets/icon/tick-circle.svg') }}" class="w-full h-full object-cover" alt="ikon">
                                </div>
                                <p class="text-[#475466]">Menerima hadiah premium seperti template</p>
                            </div>
                            <div class="flex gap-3">
                                <div class="w-6 h-6 flex shrink-0">
                                    <img src="{{ asset('assets/icon/tick-circle.svg') }}" class="w-full h-full object-cover" alt="ikon">
                                </div>
                                <p class="text-[#475466]">Unlock semua lencana kursus untuk meningkatkan profil karir untuk melamar pekerjaan setelah selesai</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('front.checkout') }}" class="p-[20px_32px] bg-[#FF6129] text-white rounded-full text-center font-semibold text-xl transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF612980]">Berlangganan Sekarang</a>
                </div>
            </div>
        </div>
    </section>

    <section id="Zero-to-Success" class="h-[885px] mt-[264px] max-w-[1200px] mx-auto flex flex-col justify-end py-[70px] px-[50px] gap-[30px] bg-[#F5F8FA] rounded-[32px]">
        <div class="flex flex-col gap-[30px] items-center text-center">
            <div class="gradient-badge w-fit p-[8px_16px] rounded-full border border-[#FED6AD] flex items-center gap-[6px]">
                <div>
                    <img src={{ asset('assets/icon/medal-star.svg') }} alt="icon">
                </div>
                <p class="font-medium text-sm text-[#FF6129]">Dari Nol ke Sukses</p>
            </div>
            <div class="flex flex-col">
                <h2 class="font-bold text-[40px] leading-[60px]">Siswa yang Bahagia & Sukses</h2>
                <p class="text-[#6D7786] text-lg -tracking-[2%]">Mendapatkan keterampilan dan karier dengan gaji tinggi menjadi jauh lebih mudah</p>
            </div>

        </div>
        <div class="testi w-full overflow-hidden flex flex-col gap-6 relative">
            <div class="fade-overlay absolute z-10 h-full w-[50px] bg-gradient-to-r from-[#F5F8FA] to-[#F5F8FA00]">
            </div>
            <div
                class="fade-overlay absolute right-0 z-10 h-full w-[50px] bg-gradient-to-r from-[#F5F8FA00] to-[#F5F8FA]">
            </div>
            <div class="group/slider flex flex-nowrap w-max items-center">
                <div
                    class="testi-container animate-[slideToL_50s_linear_infinite] group-hover/slider:pause-animate flex gap-6 pl-6 items-center flex-nowrap">
                    <div class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden">
                                <img src={{ asset('assets/photo/potocewe.png') }} class="w-full h-full object-cover"
                                    alt="photo">
                            </div>
                            <p class="font-semibold">Shayna</p>
                        </div>
                        <p class="text-sm text-[#475466]">Berkemah telah membantu saya berkembang dari nol hingga
                            memiliki karier yang sempurna, terima kasih!</p>
                        <div class="flex gap-[2px]">
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                        </div>
                    </div>

                    <div class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden">
                                <img src={{ asset('assets/photo/potocowo.png') }} class="w-full h-full object-cover"
                                    alt="photo">
                            </div>
                            <p class="font-semibold">Rizky</p>
                        </div>
                        <p class="text-sm text-[#475466]">Materi kursusnya sangat bermanfaat dan aplikatif, cocok untuk
                            mengembangkan karier saya.</p>
                        <div class="flex gap-[2px]">
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                        </div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden">
                                <img src={{ asset('assets/photo/potocewe.png') }} class="w-full h-full object-cover"
                                    alt="photo">
                            </div>
                            <p class="font-semibold">Nadia</p>
                        </div>
                        <p class="text-sm text-[#475466]">Dengan berkemah, saya bisa belajar kapan saja dan di mana
                            saja sesuai jadwal saya.</p>
                        <div class="flex gap-[2px]">
                            <img src={{ asset('assets/icon/star.svg') }} alt="star">
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                        </div>
                    </div>

                    <!-- Testimonial 4 -->
                    <div class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden">
                                <img src={{ asset('assets/photo/potocowo.png') }} class="w-full h-full object-cover"
                                    alt="photo">
                            </div>
                            <p class="font-semibold">Dimas</p>
                        </div>
                        <p class="text-sm text-[#475466]">Program ini memberikan banyak ilmu yang langsung dapat
                            diaplikasikan di tempat kerja.</p>
                        <div class="flex gap-[2px]">
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                        </div>
                    </div>
                </div>
                <div
                    class="logo-container animate-[slideToL_50s_linear_infinite] group-hover/slider:pause-animate flex gap-6 pl-6 items-center flex-nowrap ">
                    <div class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden">
                                <img src={{ asset('assets/photo/potocewe.png') }} class="w-full h-full object-cover"
                                    alt="photo">
                            </div>
                            <p class="font-semibold">Maya</p>
                        </div>
                        <p class="text-sm text-[#475466]">Belajar di platform ini membuat saya lebih percaya diri saat
                            menghadapi tantangan baru.</p>
                        <div class="flex gap-[2px]">
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                        </div>
                    </div>

                    <!-- Testimonial 6 -->
                    <div class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden">
                                <img src={{ asset('assets/photo/potocowo.png') }} class="w-full h-full object-cover"
                                    alt="photo">
                            </div>
                            <p class="font-semibold">Arya</p>
                        </div>
                        <p class="text-sm text-[#475466]">Kursus yang menarik dan penuh tantangan, saya
                            merekomendasikan ini kepada teman-teman saya.</p>
                        <div class="flex gap-[2px]">
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                        </div>
                    </div>
                    <!-- Testimonial 7 -->
                    <div class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden">
                                <img src={{ asset('assets/photo/potocewe.png') }} class="w-full h-full object-cover"
                                    alt="photo">
                            </div>
                            <p class="font-semibold">Intan</p>
                        </div>
                        <p class="text-sm text-[#475466]">Platform ini memberikan akses ke banyak kursus berkualitas,
                            saya sangat terbantu dalam meningkatkan keahlian saya.</p>
                        <div class="flex gap-[2px]">
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                        </div>
                    </div>

                    <!-- Testimonial 8 -->
                    <div class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden">
                                <img src={{ asset('assets/photo/potocowo.png') }} class="w-full h-full object-cover"
                                    alt="photo">
                            </div>
                            <p class="font-semibold">Joko</p>
                        </div>
                        <p class="text-sm text-[#475466]">Belajar di sini sangat memudahkan saya dalam mengembangkan
                            keterampilan baru dengan fleksibel dan efektif.</p>
                        <div class="flex gap-[2px]">
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                        </div>
                    </div>

                </div>
            </div>
            <div class="group/slider flex flex-nowrap w-max items-center">
                <div
                    class="logo-container animate-[slideToR_50s_linear_infinite] group-hover/slider:pause-animate flex gap-6 pl-6 items-center flex-nowrap">
                    <!-- Testimonial 7 -->
                    <div class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden">
                                <img src={{ asset('assets/photo/potocewe.png') }} class="w-full h-full object-cover"
                                    alt="photo">
                            </div>
                            <p class="font-semibold">Intan</p>
                        </div>
                        <p class="text-sm text-[#475466]">Platform ini memberikan akses ke banyak kursus berkualitas,
                            saya sangat terbantu dalam meningkatkan keahlian saya.</p>
                        <div class="flex gap-[2px]">
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                        </div>
                    </div>

                    <!-- Testimonial 8 -->
                    <div class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden">
                                <img src={{ asset('assets/photo/potocowo.png') }} class="w-full h-full object-cover"
                                    alt="photo">
                            </div>
                            <p class="font-semibold">Joko</p>
                        </div>
                        <p class="text-sm text-[#475466]">Belajar di sini sangat memudahkan saya dalam mengembangkan
                            keterampilan baru dengan fleksibel dan efektif.</p>
                        <div class="flex gap-[2px]">
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                        </div>
                    </div>

                    <!-- Testimonial 5 -->
                    <div class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden">
                                <img src={{ asset('assets/photo/potocewe.png') }} class="w-full h-full object-cover"
                                    alt="photo">
                            </div>
                            <p class="font-semibold">Maya</p>
                        </div>
                        <p class="text-sm text-[#475466]">Belajar di platform ini membuat saya lebih percaya diri saat
                            menghadapi tantangan baru.</p>
                        <div class="flex gap-[2px]">
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                        </div>
                    </div>

                    <!-- Testimonial 6 -->
                    <div class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden">
                                <img src={{ asset('assets/photo/potocowo.png') }} class="w-full h-full object-cover"
                                    alt="photo">
                            </div>
                            <p class="font-semibold">Arya</p>
                        </div>
                        <p class="text-sm text-[#475466]">Kursus yang menarik dan penuh tantangan, saya
                            merekomendasikan ini kepada teman-teman saya.</p>
                        <div class="flex gap-[2px]">
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                        </div>
                    </div>
                </div>
                <div
                    class="logo-container animate-[slideToR_50s_linear_infinite] group-hover/slider:pause-animate flex gap-6 pl-6 items-center flex-nowrap ">
                    <!-- Testimonial 7 -->
                    <div class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden">
                                <img src={{ asset('assets/photo/potocewe.png') }} class="w-full h-full object-cover"
                                    alt="photo">
                            </div>
                            <p class="font-semibold">Lina</p>
                        </div>
                        <p class="text-sm text-[#475466]">Platform ini sangat membantu dalam meningkatkan keterampilan
                            saya secara signifikan.</p>
                        <div class="flex gap-[2px]">
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                        </div>
                    </div>

                    <!-- Testimonial 8 -->
                    <div class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden">
                                <img src={{ asset('assets/photo/potocowo.png') }} class="w-full h-full object-cover"
                                    alt="photo">
                            </div>
                            <p class="font-semibold">Hadi</p>
                        </div>
                        <p class="text-sm text-[#475466]">Materi yang disediakan sangat lengkap dan mudah dipahami.
                            Pengalaman belajar yang luar biasa!</p>
                        <div class="flex gap-[2px]">
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                        </div>
                    </div>

                    <!-- Testimonial 9 -->
                    <div class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden">
                                <img src={{ asset('assets/photo/potocewe.png') }} class="w-full h-full object-cover"
                                    alt="photo">
                            </div>
                            <p class="font-semibold">Sari</p>
                        </div>
                        <p class="text-sm text-[#475466]">Fitur dan pelatihan yang ditawarkan sangat membantu saya
                            dalam memajukan karier saya.</p>
                        <div class="flex gap-[2px]">
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                        </div>
                    </div>

                    <!-- Testimonial 10 -->
                    <div class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden">
                                <img src={{ asset('assets/photo/potocowo.png') }} class="w-full h-full object-cover"
                                    alt="photo">
                            </div>
                            <p class="font-semibold">Dani</p>
                        </div>
                        <p class="text-sm text-[#475466]">Kursus ini memberikan wawasan yang berharga dan tips praktis
                            untuk mengatasi tantangan sehari-hari.</p>
                        <div class="flex gap-[2px]">
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                            <img src={{ asset('assets/icon/star.svg') }}>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section id="FAQ" class="max-w-[1200px] mx-auto flex flex-col py-[70px] px-[100px]">
        <div class="flex justify-between items-center">
            <div class="flex flex-col gap-[30px]">
                <div
                    class="gradient-badge w-fit p-[8px_16px] rounded-full border border-[#FED6AD] flex items-center gap-[6px]">
                    <div>
                        <img src={{ asset('assets/icon/medal-star.svg') }} alt="icon">
                    </div>
                    <p class="font-medium text-sm text-[#FF6129]">Kembangkan Karier Anda</p>
                </div>
                <div class="flex flex-col">
                    <h2 class="font-bold text-[36px] leading-[52px]">Dapatkan Jawaban Anda</h2>
                    <p class="text-lg text-[#475466]">Saatnya untuk meningkatkan keterampilan tanpa batas!</p>
                </div>

                <a href="https://wa.me/62881023806530"
                class="text-white font-semibold rounded-[30px] p-[16px_32px] bg-[#FF6129] transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF612980] w-fit">
                Contact Our Sales
            </a>

            </div>
            <div class="flex flex-col gap-[30px] w-[552px] shrink-0">
                <div
                    class="flex flex-col p-5 rounded-2xl bg-[#FFF8F4] has-[.hide]:bg-transparent border-t-4 border-[#FF6129] has-[.hide]:border-0 w-full">
                    <button class="accordion-button flex justify-between gap-1 items-center"
                        data-accordion="accordion-faq-1">
                        <span class="font-semibold text-lg text-left">Apakah pemula bisa bergabung dengan
                            kursus?</span>
                        <div class="arrow w-9 h-9 flex shrink-0">
                            <img src={{ asset('assets/icon/add.svg') }} alt="icon">
                        </div>
                    </button>
                    <div id="accordion-faq-1" class="accordion-content hide">
                        <p class="leading-[30px] text-[#475466] pt-[10px]">Ya, kami telah menyediakan berbagai kursus
                            dari tingkat pemula hingga menengah untuk mempersiapkan karier besar Anda berikutnya.</p>
                    </div>
                </div>
                <div
                    class="flex flex-col p-5 rounded-2xl bg-[#FFF8F4] has-[.hide]:bg-transparent border-t-4 border-[#FF6129] has-[.hide]:border-0 w-full">
                    <button class="accordion-button flex justify-between gap-1 items-center"
                        data-accordion="accordion-faq-2">
                        <span class="font-semibold text-lg text-left">Berapa lama waktu yang dibutuhkan untuk
                            implementasi?</span>
                        <div class="arrow w-9 h-9 flex shrink-0">
                            <img src={{ asset('assets/icon/add.svg') }} alt="icon">
                        </div>
                    </button>
                    <div id="accordion-faq-2" class="accordion-content hide">
                        <p class="leading-[30px] text-[#475466] pt-[10px]">Waktu implementasi dapat bervariasi
                            tergantung pada kompleksitas dan skala proyek. Biasanya, proses ini memakan waktu antara 4
                            hingga 8 minggu untuk diselesaikan.</p>
                    </div>
                </div>
                <div
                    class="flex flex-col p-5 rounded-2xl bg-[#FFF8F4] has-[.hide]:bg-transparent border-t-4 border-[#FF6129] has-[.hide]:border-0 w-full">
                    <button class="accordion-button flex justify-between gap-1 items-center"
                        data-accordion="accordion-faq-3">
                        <span class="font-semibold text-lg text-left">Apakah Anda menyediakan program jaminan
                            pekerjaan?</span>
                        <div class="arrow w-9 h-9 flex shrink-0">
                            <img src={{ asset('assets/icon/add.svg') }} alt="icon">
                        </div>
                    </button>
                    <div id="accordion-faq-3" class="accordion-content hide">
                        <p class="leading-[30px] text-[#475466] pt-[10px]">Kami tidak dapat menjamin pekerjaan, namun
                            kami menyediakan dukungan karier yang komprehensif dan bantuan untuk mempersiapkan Anda
                            memasuki dunia kerja dengan percaya diri.</p>
                    </div>
                </div>
                <div
                    class="flex flex-col p-5 rounded-2xl bg-[#FFF8F4] has-[.hide]:bg-transparent border-t-4 border-[#FF6129] has-[.hide]:border-0 w-full">
                    <button class="accordion-button flex justify-between gap-1 items-center"
                        data-accordion="accordion-faq-4">
                        <span class="font-semibold text-lg text-left">Bagaimana cara mengeluarkan semua sertifikat
                            kursus?</span>
                        <div class="arrow w-9 h-9 flex shrink-0">
                            <img src={{ asset('assets/icon/add.svg') }} alt="icon">
                        </div>
                    </button>
                    <div id="accordion-faq-4" class="accordion-content hide">
                        <p class="leading-[30px] text-[#475466] pt-[10px]">Sertifikat kursus dapat dikeluarkan melalui
                            platform kami setelah menyelesaikan kursus dengan sukses. Anda dapat mengunduh atau mencetak
                            sertifikat tersebut dari akun Anda.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <footer class="max-w-[1200px] mx-auto flex flex-col pt-[70px] pb-[50px] px-[100px] gap-[50px] bg-[#F5F8FA] rounded-[32px]">
        <div class="flex justify-between">
            <a href="">
                <div>
                    <img src="assets/logo/logo.png" alt="logo" style="width: 50px;">
                </div>
            </a>
            <div class="flex flex-col gap-5">
                <p class="font-semibold text-lg">Products</p>
                <ul class="flex flex-col gap-[14px]">
                    <li>
                        <a href="" class="text-[#6D7786]">Online Courses</a>
                    </li>
                    <li>
                        <a href="" class="text-[#6D7786]">Career Guidance</a>
                    </li>
                    <li>
                        <a href="" class="text-[#6D7786]">Expert Handbook</a>
                    </li>
                    <li>
                        <a href="" class="text-[#6D7786]">Interview Simulations</a>
                    </li>
                </ul>
            </div>
            <div class="flex flex-col gap-5">
                <p class="font-semibold text-lg">Company</p>
                <ul class="flex flex-col gap-[14px]">
                    <li>
                        <a href="" class="text-[#6D7786]">About Us</a>
                    </li>
                    <li>
                        <a href="" class="text-[#6D7786]">Media Press</a>
                    </li>
                    <li class="flex items-center gap-[10px]">
                        <a href="https://www.linkedin.com/company/berkemah/?viewAsMember=true" class="text-[#6D7786]">Careers</a>
                        <div class="gradient-badge w-fit p-[6px_10px] rounded-full border border-[#FED6AD] flex items-center">
                            <p class="font-medium text-xs text-[#FF6129]">We’re Hiring</p>
                        </div>
                    </li>
                    <li>
                        <a href="" class="text-[#6D7786]">Developer APIs</a>
                    </li>
                </ul>
            </div>
            <div class="flex flex-col gap-5">
                <p class="font-semibold text-lg">Resources</p>
                <ul class="flex flex-col gap-[14px]">
                    <li>
                        <a href="" class="text-[#6D7786]">Blog</a>
                    </li>
                    <li>
                        <a href="" class="text-[#6D7786]">FAQ</a>
                    </li>
                    <li>
                        <a href="" class="text-[#6D7786]">Help Center</a>
                    </li>
                    <li>
                        <a href="" class="text-[#6D7786]">Terms & Conditions</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="w-full h-[51px] flex items-end border-t border-[#E7EEF2]">
            <p class="mx-auto text-sm text-[#6D7786] -tracking-[2%]">All Rights Reserved Berkemah 2024</p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous">
    </script>

    <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

    <script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>
