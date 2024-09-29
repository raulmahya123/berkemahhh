<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
</head>

<body class="text-black font-poppins pt-10 pb-[50px]">
    <div id="hero-section"
        class="max-w-[1200px] mx-auto w-full flex flex-col gap-10 pb-[50px] bg-[url('assets/background/Hero-Banner.png')] bg-center bg-no-repeat bg-cover rounded-[32px] overflow-hidden">
        <nav class="flex justify-between items-center pt-6 px-[50px]">
            <a href="{{ route('front.index') }}">

                <img src="{{ asset('assets/logo/logo.png') }}" alt="Logo" style="width: 70px;">


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
                        <img src="{{ Storage::url(Auth::user()->avatar) }}" class="w-full h-full object-cover"
                            alt="photo">

                    </a>
                    <div class="flex gap-[10px] items-center">
                        <form method="POST" action="{{ route('logout') }}" class="text-white font-semibold rounded-[30px] p-[16px_32px] ring-1 ring-white transition-all duration-300 hover:ring-2 hover:ring-[#FF6129]">
                            @csrf
                            <x-dropdown-link :href="route('front.index')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Logout') }}
                            </x-dropdown-link>
                        </form>
                        </div>
                </div>

            @endauth
            @guest
                <div class="flex gap-[10px] items-center">
                    <a href="{{ route('register') }}"
                        class="text-white font-semibold rounded-[30px] p-[16px_32px] ring-1 ring-white transition-all duration-300 hover:ring-2 hover:ring-[#FF6129]">Sign
                        Up</a>
                    <a href="{{ route('login') }}"
                        class="text-white font-semibold rounded-[30px] p-[16px_32px] bg-[#FF6129] transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF612980]">Sign
                        In</a>
                </div>
            @endguest
        </nav>
        <div class="flex flex-col items-center gap-[30px]">
            <div class="w-fit flex items-center gap-3 p-2 pr-6 rounded-full bg-[#FFFFFF1F] border border-[#3477FF24]">
                <div class="w-[100px] h-[48px] flex shrink-0">
                    <img src={{ asset('assets/photo/potocewe.png') }} class="object-contain" alt="icon">
                    <img src={{ asset('assets/photo/potocowo.png') }} class="object-contain" alt="icon">
                </div>
                <p class="font-semibold text-sm text-white">Bergabunglah dengan 1000 pengguna</p>
            </div>
            <div class="flex flex-col gap-[10px]">
                <h1 class="font-semibold text-[80px] leading-[82px] text-center gradient-text-hero">Bangun Karier Masa
                    Depan</h1>
                <p class="text-center text-xl leading-[36px] text-[#F5F8FA]">Berkemah menyediakan kursus online
                    berkualitas tinggi untuk Anda meningkatkan <br>
                    keterampilan dan membangun portofolio luar biasa guna menghadapi wawancara kerja</p>
                <h1 class="text-center text-xl leading-[36px] text-[#F5F8FA]">#bayarsekaliaksessemuah</h1>
            </div>

            <div class="flex gap-6 w-fit">
                <a href=""
                    class="text-white font-semibold rounded-[30px] p-[16px_32px] bg-[#FF6129] transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF612980]">Jelajahi
                    Kursus</a>
                <a href=""
                    class="text-white font-semibold rounded-[30px] p-[16px_32px] ring-1 ring-white transition-all duration-300 hover:ring-2 hover:ring-[#FF6129]">Panduan
                    Karir</a>

            </div>
        </div>
        <div class="flex gap-[70px] items-center justify-center">
            <div>
                <img src={{ asset('assets/icon/logo5.png') }} alt="icon" style="width: 100px;">
            </div>
            <div>
                <img src={{ asset('assets/icon/logo1.png') }} alt="icon" style="width: 100px;">
            </div>
            <div>
                <img src={{ asset('assets/icon/logo2.png') }} alt="icon" style="width: 100px;">
            </div>
            <div>
                <img src={{ asset('assets/icon/logo3.png') }} alt="icon" style="width: 100px;">
            </div>
            <div>
                <img src={{ asset('assets/icon/logo4.png') }} alt="icon" style="width: 100px;">
            </div>
        </div>
    </div>
    <section id="Top-Categories" class="max-w-[1200px] mx-auto flex flex-col p-[70px_50px] gap-[30px]">
        <div class="flex flex-col gap-[30px]">
            <div
                class="gradient-badge w-fit p-[8px_16px] rounded-full border border-[#FED6AD] flex items-center gap-[6px]">
                <div>
                    <img src={{ asset('assets/icon/medal-star.svg') }} alt="ikon">
                </div>
                <p class="font-medium text-sm text-[#FF6129]">Kategori Teratas</p>
            </div>
            <div class="flex flex-col">
                <h2 class="font-bold text-[40px] leading-[60px]">Jelajahi Kursus</h2>
                <p class="text-[#6D7786] text-lg -tracking-[2%]">Mengembangkan keterampilan yang paling dicari di pasar
                    kerja saat ini dan mengejar karier dengan penghasilan tinggi yang sesuai dengan minat dan kemampuan
                    Anda di tahun ini.</p>
            </div>
        </div>

        <div class="grid grid-cols-4 gap-[30px]">
            @foreach ($categories as $key => $category)
                @if ($key <= 3)
                    <a href="{{ route('front.category', $category->slug) }}"
                        class="card flex items-center p-4 gap-3 ring-1 ring-[#DADEE4] rounded-2xl hover:ring-2 hover:ring-[#FF6129] transition-all duration-300">
                        <div class="w-[70px] h-[70px] flex shrink-0">
                            <img src="{{ Storage::url($category->icon) }}" class="object-contain" alt="icon">
                        </div>
                        <p class="font-bold text-lg">{{ $category->name }}</p>
                    </a>
                @endif
            @endforeach
        </div>
        <div class="grid grid-cols-3 gap-[30px]">
            @foreach ($categories as $key => $category)
                @if ($key >= 4)
                    <a href="{{ route('front.category', $category->slug) }}"
                        class="card flex items-center p-4 gap-3 ring-1 ring-[#DADEE4] rounded-2xl hover:ring-2 hover:ring-[#FF6129] transition-all duration-300">
                        <div class="w-[70px] h-[70px] flex shrink-0">
                            <img src="{{ Storage::url($category->icon) }}" class="object-contain" alt="icon">
                        </div>
                        <p class="font-bold text-lg">{{ $category->name }}</p>
                    </a>
                @endif
            @endforeach
        </div>
    </section>
    <section id="Popular-Courses"
        class="max-w-[1200px] mx-auto flex flex-col p-[70px_82px_0px] gap-[30px] bg-[#F5F8FA] rounded-[32px]">
        <div class="flex flex-col gap-[30px] items-center text-center">
            <div
                class="gradient-badge w-fit p-[8px_16px] rounded-full border border-[#FED6AD] flex items-center gap-[6px]">
                <div>
                    <img src={{ asset('assets/icon/medal-star.svg') }} alt="ikon">
                </div>
                <p class="font-medium text-sm text-[#FF6129]">Kursus Populer</p>
            </div>
            <div class="flex flex-col">
                <h2 class="font-bold text-[40px] leading-[60px]">Jangan Lewatkan, Belajar Sekarang</h2>
                <p class="text-[#6D7786] text-lg -tracking-[2%]">Mengembangkan keterampilan yang paling dicari di pasar
                    kerja saat ini dan mengejar karier dengan penghasilan tinggi yang sesuai dengan minat dan kemampuan
                    Anda di tahun ini.</p>
            </div>
        </div>

        <div class="relative">
            <button class="btn-prev absolute rotate-180 -left-[52px] top-[216px]">
                <img src={{ asset('assets/icon/arrow-right.svg') }} alt="icon">
            </button>
            <button class="btn-prev absolute -right-[52px] top-[216px]">
                <img src={{ asset('assets/icon/arrow-right.svg') }} alt="icon">
            </button>
            <div id="course-slider" class="w-full">
                @forelse ($courses as $course)
                    <div class="course-card w-1/3 px-3 pb-[70px] mt-[2px]">
                        <div
                            class="flex flex-col rounded-t-[12px] rounded-b-[24px] gap-[32px] bg-white w-full pb-[10px] overflow-hidden transition-all duration-300 hover:ring-2 hover:ring-[#FF6129]">
                            <a href="{{ route('front.details', $course->slug) }}"
                                class="thumbnail w-full h-[200px] shrink-0 rounded-[10px] overflow-hidden">
                                <img src="{{ Storage::url($course->thumbnail) }}" class="w-full h-full object-cover"
                                    alt="thumbnail">
                            </a>
                            <div class="flex flex-col px-4 gap-[10px]">
                                <a href="{{ route('front.details', $course->slug) }}"
                                    class="font-semibold text-lg line-clamp-2 hover:line-clamp-none min-h-[56px]">{{ $course->name }}</a>
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center gap-[2px]">
                                        @for ($i = 0; $i < 5; $i++)
                                            <div>
                                                <img src={{ asset('assets/icon/star.svg') }}>
                                            </div>
                                        @endfor
                                    </div>
                                    <p class="text-right text-[#6D7786]">{{ $course->students->count() }} students</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden">
                                        <img src="{{ Storage::url($course->teacher->user->avatar) }}"
                                            class="w-full h-full object-cover" alt="icon">
                                    </div>
                                    <div class="flex flex-col">
                                        <p class="font-semibold">{{ $course->teacher->user->name }}</p>
                                        <p class="text-[#6D7786]">{{ $course->category->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                <div class="alert alert-info custom-alert text-center" role="alert">
                    <h4 class="alert-heading">Tidak Ada Kelas Terbaru!</h4>
                    <p>Sepertinya belum ada kelas terbaru yang tersedia saat ini. Silakan cek kembali nanti.</p>
                    <hr>
                    <a href="{{ route('front.index') }}" class="btn btn-primary custom-btn">Lihat Semua Kelas</a>
                </div>
                @endforelse
            </div>
        </div>
    </section>
    <section id="Pricing" class="max-w-[1200px] mx-auto flex justify-between items-center p-[70px_100px]">
        <div class="relative">
            <div class="w-[355px] h-[488px]">
                <img src={{ asset('assets/background/benefit_illustration_man.png') }} alt="icon">
            </div>
            <div
                class="absolute w-[230px] transform -translate-y-1/2 top-1/2 left-[214px] bg-white z-10 rounded-[20px] gap-4 p-4 flex flex-col shadow-[0_17px_30px_0_#0D051D0A]">
                <p class="font-semibold">Materials</p>
                <div class="flex gap-2 items-center">
                    <div>
                        <img src={{ asset('assets/icon/video-play.svg') }} alt="icon">
                    </div>
                    <p class="font-medium">Videos</p>
                </div>
                <div class="flex gap-2 items-center">
                    <div>
                        <img src={{ asset('assets/icon/note-favorite.svg') }} alt="icon">
                    </div>
                    <p class="font-medium">Handbook</p>
                </div>
                <div class="flex gap-2 items-center">
                    <div>
                        <img src={{ asset('assets/icon/3dcube.svg') }} alt="icon">
                    </div>
                    <p class="font-medium">Assets</p>
                </div>
                <div class="flex gap-2 items-center">
                    <div>
                        <img src={{ asset('assets/icon/award.svg') }} alt="icon">
                    </div>
                    <p class="font-medium">Certificates</p>
                </div>
                <div class="flex gap-2 items-center">
                    <div>
                        <img src={{ asset('assets/icon/book.svg') }} alt="icon">
                    </div>
                    <p class="font-medium">Documentations</p>
                </div>
            </div>
        </div>
        <div class="flex flex-col text-left gap-[30px]">
            <h2 class="font-bold text-[36px] leading-[52px]">Belajar Dari Mana Saja,<br>Kapan Saja Anda Mau</h2>
            <p class="text-[#475466] text-lg leading-[34px]">Mengembangkan keterampilan baru akan <br>menjadi lebih
                fleksibel tanpa batas, <br> kami membantu Anda mengakses semua materi kursus.</p>
            <a href=""
                class="text-white font-semibold rounded-[30px] p-[16px_32px] bg-[#FF6129] transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF612980] w-fit">Lihat
                Harga</a>
        </div>
    </section>
    <section id="Zero-to-Success"
        class="max-w-[1200px] mx-auto flex flex-col py-[70px] px-[50px] gap-[30px] bg-[#F5F8FA] rounded-[32px]">
        <div class="flex flex-col gap-[30px] items-center text-center">
            <div
                class="gradient-badge w-fit p-[8px_16px] rounded-full border border-[#FED6AD] flex items-center gap-[6px]">
                <div>
                    <img src={{ asset('assets/icon/medal-star.svg') }} alt="icon">
                </div>
                <p class="font-medium text-sm text-[#FF6129]">Dari Nol Menuju Kesuksesan</p>
            </div>
            <div class="flex flex-col">
                <h2 class="font-bold text-[40px] leading-[60px]">Siswa yang Bahagia & Sukses</h2>
                <p class="text-[#6D7786] text-lg -tracking-[2%]">Memperoleh keterampilan dan karier dengan gaji tinggi
                    menjadi
                    jauh lebih mudah</p>
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
    <footer
        class="max-w-[1200px] mx-auto flex flex-col pt-[70px] pb-[50px] px-[100px] gap-[50px] bg-[#F5F8FA] rounded-[32px]">
        <div class="flex justify-between">
            <a href="">
                <div>
                    <img src={{ asset('assets/logo/logo.png') }} alt="logo" style="width: 70px;">
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
                        <div
                            class="gradient-badge w-fit p-[6px_10px] rounded-full border border-[#FED6AD] flex items-center">
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
