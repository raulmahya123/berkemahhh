<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berkemah</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('assets/logo/logo.png') }}">
        <link href="{{ asset('css/output.css') }}" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
        <!-- CSS -->
        <link
            rel="stylesheet"
            href="https://unpkg.com/flickity@2/dist/flickity.min.css"
        />
    </head>

    <body class="text-black bg-gray-50 pt-10 pb-12 font-poppins">
    <!-- Hero Section -->
    <div id="hero-section" class="w-full lg:w-[90%] xl:w-[80%] mx-auto flex flex-col gap-12 pb-16 px-4 sm:px-6 md:px-8 lg:px-12 
           bg-[url('{{ asset('assets/background/Hero-Banner.png') }}')] bg-center bg-no-repeat bg-cover 
           rounded-3xl overflow-hidden shadow-lg">
        
        <!-- Navbar -->
        <nav class="flex justify-between items-center pt-8">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/logo/logo.png') }}" alt="Logo" class="w-16 sm:w-20">
            </a>
            <ul class="hidden md:flex items-center gap-8 text-white text-lg">
                <li><a href="{{ url('/') }}" class="font-semibold hover:text-orange-400 transition">Home</a></li>
                <li><a href="{{ url('/pricing') }}" class="font-semibold hover:text-orange-400 transition">Pricing</a></li>
            </ul>
            <button id="menu-btn" class="md:hidden text-white text-2xl">&#9776;</button>
            <div class="hidden md:flex gap-4 items-center">
                <a href="{{ url('/register') }}" class="text-white font-semibold rounded-full px-6 py-2 ring-1 ring-white transition hover:ring-2 hover:ring-orange-500">Sign Up</a>
                <a href="{{ url('/login') }}" class="text-white font-semibold rounded-full px-6 py-2 bg-orange-500 transition hover:shadow-lg hover:shadow-orange-500/50">Sign In</a>
            </div>
        </nav>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden flex flex-col items-center mt-4 md:hidden">
            <ul class="flex flex-col gap-4 text-white text-lg">
                <li><a href="{{ url('/') }}" class="font-semibold">Home</a></li>
                <li><a href="{{ url('/pricing') }}" class="font-semibold">Pricing</a></li>
            </ul>
        </div>
        
        <!-- Hero Content -->
        <div class="flex flex-col items-center gap-8 text-center px-6 sm:px-10">
            <div class="flex items-center gap-3 p-3 pr-6 rounded-full bg-white/20 border border-blue-300/10">
                <div class="w-24 h-12 flex">
                    <img src="{{ asset('assets/photo/potocewe.png') }}" class="object-contain" alt="icon">
                    <img src="{{ asset('assets/photo/potocowo.png') }}" class="object-contain" alt="icon">
                </div>
                <p class="font-semibold text-sm sm:text-lg text-white">Bergabunglah dengan 1000 pengguna</p>
            </div>
            <h1 class="font-semibold text-4xl sm:text-6xl md:text-7xl leading-tight bg-gradient-to-r from-blue-400 to-purple-500 text-transparent bg-clip-text">
                Bangun Karier Masa Depan
            </h1>
            <p class="text-lg sm:text-xl text-gray-200 max-w-2xl">
                Berkemah menyediakan kursus online berkualitas tinggi untuk Anda meningkatkan keterampilan dan membangun
                portofolio luar biasa guna menghadapi wawancara kerja.
            </p>
            <h2 class="text-lg sm:text-xl text-gray-200 font-semibold">#bayarsekaliaksessemuah</h2>
            <div class="flex flex-col sm:flex-row gap-4 sm:gap-6">
                <a href="#" class="text-white font-semibold rounded-full px-8 py-3 bg-orange-500 transition hover:shadow-lg hover:shadow-orange-500/50">Jelajahi Kursus</a>
                <a href="#" class="text-white font-semibold rounded-full px-8 py-3 ring-1 ring-white transition hover:ring-2 hover:ring-orange-500">Panduan Karir</a>
            </div>
        </div>
        
        <!-- Partner Logos -->
        <div class="grid grid-cols-2 sm:flex gap-8 items-center justify-center pt-8 sm:pt-12">
            <img src="{{ asset('assets/icon/logo5.png') }}" alt="icon" class="w-20 sm:w-24">
            <img src="{{ asset('assets/icon/logo1.png') }}" alt="icon" class="w-20 sm:w-24">
            <img src="{{ asset('assets/icon/logo2.png') }}" alt="icon" class="w-20 sm:w-24">
            <img src="{{ asset('assets/icon/logo3.png') }}" alt="icon" class="w-20 sm:w-24">
            <img src="{{ asset('assets/icon/logo4.png') }}" alt="icon" class="w-20 sm:w-24">
        </div>
    </div>
    <!--batas section -->

    <!--section Top-Categories -->
    <section id="Top-Categories" class="max-w-[1200px] mx-auto flex flex-col p-[70px_50px] gap-[30px]">
        <div class="flex flex-col gap-[30px]">
            <div class="gradient-badge w-fit p-[8px_16px] rounded-full border border-[#FED6AD] flex items-center gap-[6px]">
                <div>
                    <img src="{{ asset('assets/icon/medal-star.svg') }}" alt="ikon">
                </div>
                <p class="font-medium text-sm text-[#FF6129]">
                    Kategori Teratas
                </p>
            </div>
            <div class="flex flex-col">
                <h2 class="font-bold text-[40px] leading-[60px]">
                    Jelajahi Kursus
                </h2>
                <p class="text-[#6D7786] text-lg -tracking-[2%]">
                    Mengembangkan keterampilan yang paling dicari di pasar
                    kerja saat ini dan mengejar karier dengan penghasilan
                    tinggi yang sesuai dengan minat dan kemampuan Anda di
                    tahun ini.
                </p>
            </div>
        </div>

        <!-- Grid Top Categories -->
        <div class="grid grid-cols-4 gap-[30px]">
            @foreach ($categories as $key => $category)
                @if ($key <= 3)
                    <a
                        href="{{ Auth::check() ? route('front.category', $category->slug) : '/categoryWithoutAuth/' . $category->slug }}"
                        class="card flex items-center p-4 gap-3 ring-1 ring-[#DADEE4] rounded-2xl hover:ring-2 hover:ring-[#FF6129] transition-all duration-300"
                    >
                        <div class="w-[70px] h-[70px] flex shrink-0">
                            <img src="{{ Storage::url($category->icon) }}" class="object-contain" alt="icon">
                        </div>
                        <p class="font-bold text-lg">{{ $category->name }}</p>
                    </a>
                @endif
            @endforeach
        </div>

        <!-- Grid More Categories -->
        <div class="grid grid-cols-3 gap-[30px]">
            @foreach ($categories as $key => $category)
                @if ($key >= 4)
                    <a
                        href="{{ Auth::check() ? route('front.category', $category->slug) : '/categoryWithoutAuth/' . $category->slug }}"
                        class="card flex items-center p-4 gap-3 ring-1 ring-[#DADEE4] rounded-2xl hover:ring-2 hover:ring-[#FF6129] transition-all duration-300"
                    >
                        <div class="w-[70px] h-[70px] flex shrink-0">
                            <img src="{{ Storage::url($category->icon) }}" class="object-contain" alt="icon">
                        </div>
                        <p class="font-bold text-lg">{{ $category->name }}</p>
                    </a>
                @endif
            @endforeach
        </div>
    </section>
    <!--batas section -->

    <!--section Popular-Courses-->
    <section id="Popular-Courses" class="max-w-[1200px] mx-auto flex flex-col p-[70px_82px_0px] gap-[30px] bg-[#F5F8FA] rounded-[32px]">
        <div class="flex flex-col gap-[30px] items-center text-center">
            <div class="gradient-badge w-fit p-[8px_16px] rounded-full border border-[#FED6AD] flex items-center gap-[6px]">
                <div>
                    <img src="{{ asset('assets/icon/medal-star.svg') }}" alt="ikon">
                </div>
                <p class="font-medium text-sm text-[#FF6129]">
                    Kursus Populer
                </p>
            </div>
            <div class="flex flex-col">
                <h2 class="font-bold text-[40px] leading-[60px]">
                    Jangan Lewatkan, Belajar Sekarang
                </h2>
                <p class="text-[#6D7786] text-lg -tracking-[2%]">
                    Mengembangkan keterampilan yang paling dicari di pasar
                    kerja saat ini dan mengejar karier dengan penghasilan
                    tinggi yang sesuai dengan minat dan kemampuan Anda di
                    tahun ini.
                </p>
            </div>
        </div>

        <div class="relative">
            <button class="btn-prev absolute rotate-180 -left-[52px] top-[216px]">
                <img src="{{ asset('assets/icon/arrow-right.svg') }}" alt="icon">
            </button>
            <button class="btn-prev absolute -right-[52px] top-[216px]">
                <img src="{{ asset('assets/icon/arrow-right.svg') }}" alt="icon">
            </button>

            <div id="course-slider" class="w-full">
                @forelse ($courses as $course)
                    <div class="course-card w-1/3 px-3 pb-[70px] mt-[2px]">
                        <div class="flex flex-col rounded-t-[12px] rounded-b-[24px] gap-[32px] bg-white w-full pb-[10px] overflow-hidden transition-all duration-300 hover:ring-2 hover:ring-[#FF6129]">
                            <a href="{{ route('front.details', $course->slug) }}" class="thumbnail w-full h-[200px] shrink-0 rounded-[10px] overflow-hidden">
                                <img src="{{ Storage::url($course->thumbnail) }}" class="w-full h-full object-cover" alt="thumbnail" />
                            </a>
                            <div class="flex flex-col px-4 gap-[10px]">
                                <a href="{{ route('front.details', $course->slug) }}" class="font-semibold text-lg line-clamp-2 hover:line-clamp-none min-h-[56px]">
                                    {{ $course->name }}
                                </a>
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center gap-[2px]">
                                        @for ($i = 0; $i < 5; $i++)
                                            <div>
                                                <img src="{{ asset('assets/icon/star.svg') }}" alt="star icon">
                                            </div>
                                        @endfor
                                    </div>
                                    <p class="text-right text-[#6D7786]">
                                        {{ $course->students->count() }} students
                                    </p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden">
                                        <img src="{{ Storage::url($course->teacher->user->avatar) }}" class="w-full h-full object-cover" alt="teacher avatar" />
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
                        <p>
                            Sepertinya belum ada kelas terbaru yang tersedia
                            saat ini. Silakan cek kembali nanti.
                        </p>
                        <hr />
                        <div class="flex justify-center">
                            <a href="{{ route('front.index') }}"
                                class="btn btn-primary bg-[#007bff] text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300">
                                Lihat Semua Kelas
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!--batas section -->

    <!--section Pricing-->
    <section id="Pricing" class="max-w-[1200px] mx-auto flex flex-col md:flex-row justify-between items-center px-6 sm:px-10 md:px-20 py-10 sm:py-16">

<div class="relative">
    <div class="w-[250px] sm:w-[300px] md:w-[355px] h-[350px] sm:h-[420px] md:h-[488px]">
        <img src="{{ asset('assets/background/benefit_illustration_man.png') }}" alt="illustration man">
    </div>
    <div class="absolute w-[180px] sm:w-[200px] md:w-[230px] transform -translate-y-1/2 top-1/2 left-[120px] sm:left-[150px] md:left-[214px] bg-white z-10 rounded-[15px] sm:rounded-[20px] gap-3 sm:gap-4 p-3 sm:p-4 flex flex-col shadow-[0_10px_20px_0_#0D051D0A]">
        <p class="font-semibold text-sm sm:text-base">Materials</p>

        <div class="flex gap-2 items-center">
            <img src="{{ asset('assets/icon/video-play.svg') }}" alt="video play icon" class="w-5 sm:w-6">
            <p class="font-medium text-sm sm:text-base">Videos</p>
        </div>
        <div class="flex gap-2 items-center">
            <img src="{{ asset('assets/icon/note-favorite.svg') }}" alt="note favorite icon" class="w-5 sm:w-6">
            <p class="font-medium text-sm sm:text-base">Handbook</p>
        </div>
        <div class="flex gap-2 items-center">
            <img src="{{ asset('assets/icon/3dcube.svg') }}" alt="3d cube icon" class="w-5 sm:w-6">
            <p class="font-medium text-sm sm:text-base">Assets</p>
        </div>
        <div class="flex gap-2 items-center">
            <img src="{{ asset('assets/icon/award.svg') }}" alt="award icon" class="w-5 sm:w-6">
            <p class="font-medium text-sm sm:text-base">Certificates</p>
        </div>
        <div class="flex gap-2 items-center">
            <img src="{{ asset('assets/icon/book.svg') }}" alt="book icon" class="w-5 sm:w-6">
            <p class="font-medium text-sm sm:text-base">Documentations</p>
        </div>
    </div>
</div>

<div class="flex flex-col text-left gap-6 sm:gap-8">
    <h2 class="font-bold text-2xl sm:text-3xl md:text-[36px] leading-[36px] sm:leading-[42px] md:leading-[52px]">
        Belajar Dari Mana Saja,<br />Kapan Saja Anda Mau
    </h2>
    <p class="text-[#475466] text-base sm:text-lg leading-[28px] sm:leading-[34px]">
        Mengembangkan keterampilan baru akan <br />menjadi lebih
        fleksibel tanpa batas, <br />
        kami membantu Anda mengakses semua materi kursus.
    </p>
    <a href="{{ route('front.pricing') }}" class="text-white font-semibold rounded-[30px] p-[12px_24px] sm:p-[16px_32px] bg-[#FF6129] transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF612980] w-fit">
        Lihat Harga
    </a>
</div>
</section>

    <!--batas section -->

    <!--section Zero-to-Success-->
        <section
            id="Zero-to-Success"
            class="max-w-[1200px] mx-auto flex flex-col py-[70px] px-[50px] gap-[30px] bg-[#F5F8FA] rounded-[32px]">
            <div class="flex flex-col gap-[30px] items-center text-center">
                <div
                    class="gradient-badge w-fit p-[8px_16px] rounded-full border border-[#FED6AD] flex items-center gap-[6px]"
                >
                    <div>
                        <img src={{ asset("assets/icon/medal-star.svg") }}
                        alt="icon">
                    </div>
                    <p class="font-medium text-sm text-[#FF6129]">
                        Dari Nol Menuju Kesuksesan
                    </p>
                </div>
                <div class="flex flex-col">
                    <h2 class="font-bold text-[40px] leading-[60px]">
                        Siswa yang Bahagia & Sukses
                    </h2>
                    <p class="text-[#6D7786] text-lg -tracking-[2%]">
                        Memperoleh keterampilan dan karier dengan gaji tinggi
                        menjadi jauh lebih mudah
                    </p>
                </div>
            </div>
            <div
                class="testi w-full overflow-hidden flex flex-col gap-6 relative"
            >
                <div
                    class="fade-overlay absolute z-10 h-full w-[50px] bg-gradient-to-r from-[#F5F8FA] to-[#F5F8FA00]"
                ></div>
                <div
                    class="fade-overlay absolute right-0 z-10 h-full w-[50px] bg-gradient-to-r from-[#F5F8FA00] to-[#F5F8FA]"
                ></div>
                <div class="group/slider flex flex-nowrap w-max items-center">
                    <div
                        class="testi-container animate-[slideToL_50s_linear_infinite] group-hover/slider:pause-animate flex gap-6 pl-6 items-center flex-nowrap"
                    >
                        <div
                            class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5"
                        >
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden"
                                >
                                    <img src={{
                                        asset("assets/photo/potocewe.png")
                                    }}
                                    class="w-full h-full object-cover"
                                    alt="photo">
                                </div>
                                <p class="font-semibold">Shayna</p>
                            </div>
                            <p class="text-sm text-[#475466]">
                                Berkemah telah membantu saya berkembang dari nol
                                hingga memiliki karier yang sempurna, terima
                                kasih!
                            </p>
                            <div class="flex gap-[2px]">
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                            </div>
                        </div>

                        <div
                            class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5"
                        >
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden"
                                >
                                    <img src={{
                                        asset("assets/photo/potocowo.png")
                                    }}
                                    class="w-full h-full object-cover"
                                    alt="photo">
                                </div>
                                <p class="font-semibold">Rizky</p>
                            </div>
                            <p class="text-sm text-[#475466]">
                                Materi kursusnya sangat bermanfaat dan
                                aplikatif, cocok untuk mengembangkan karier
                                saya.
                            </p>
                            <div class="flex gap-[2px]">
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                            </div>
                        </div>

                        <!-- Testimonial 3 -->
                        <div
                            class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5"
                        >
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden"
                                >
                                    <img src={{
                                        asset("assets/photo/potocewe.png")
                                    }}
                                    class="w-full h-full object-cover"
                                    alt="photo">
                                </div>
                                <p class="font-semibold">Nadia</p>
                            </div>
                            <p class="text-sm text-[#475466]">
                                Dengan berkemah, saya bisa belajar kapan saja
                                dan di mana saja sesuai jadwal saya.
                            </p>
                            <div class="flex gap-[2px]">
                                <img src={{
                                    asset("assets/icon/star.svg")
                                }}
                                alt="star"> <img src={{
                                    asset("assets/icon/star.svg")
                                }}> <img src={{
                                    asset("assets/icon/star.svg")
                                }}> <img src={{
                                    asset("assets/icon/star.svg")
                                }}> <img src={{
                                    asset("assets/icon/star.svg")
                                }}>
                            </div>
                        </div>

                        <!-- Testimonial 4 -->
                        <div
                            class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5"
                        >
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden"
                                >
                                    <img src={{
                                        asset("assets/photo/potocowo.png")
                                    }}
                                    class="w-full h-full object-cover"
                                    alt="photo">
                                </div>
                                <p class="font-semibold">Dimas</p>
                            </div>
                            <p class="text-sm text-[#475466]">
                                Program ini memberikan banyak ilmu yang langsung
                                dapat diaplikasikan di tempat kerja.
                            </p>
                            <div class="flex gap-[2px]">
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                            </div>
                        </div>
                    </div>
                    <div
                        class="logo-container animate-[slideToL_50s_linear_infinite] group-hover/slider:pause-animate flex gap-6 pl-6 items-center flex-nowrap"
                    >
                        <div
                            class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5"
                        >
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden"
                                >
                                    <img src={{
                                        asset("assets/photo/potocewe.png")
                                    }}
                                    class="w-full h-full object-cover"
                                    alt="photo">
                                </div>
                                <p class="font-semibold">Maya</p>
                            </div>
                            <p class="text-sm text-[#475466]">
                                Belajar di platform ini membuat saya lebih
                                percaya diri saat menghadapi tantangan baru.
                            </p>
                            <div class="flex gap-[2px]">
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                            </div>
                        </div>

                        <!-- Testimonial 6 -->
                        <div
                            class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5"
                        >
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden"
                                >
                                    <img src={{
                                        asset("assets/photo/potocowo.png")
                                    }}
                                    class="w-full h-full object-cover"
                                    alt="photo">
                                </div>
                                <p class="font-semibold">Arya</p>
                            </div>
                            <p class="text-sm text-[#475466]">
                                Kursus yang menarik dan penuh tantangan, saya
                                merekomendasikan ini kepada teman-teman saya.
                            </p>
                            <div class="flex gap-[2px]">
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                            </div>
                        </div>
                        <!-- Testimonial 7 -->
                        <div
                            class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5"
                        >
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden"
                                >
                                    <img src={{
                                        asset("assets/photo/potocewe.png")
                                    }}
                                    class="w-full h-full object-cover"
                                    alt="photo">
                                </div>
                                <p class="font-semibold">Intan</p>
                            </div>
                            <p class="text-sm text-[#475466]">
                                Platform ini memberikan akses ke banyak kursus
                                berkualitas, saya sangat terbantu dalam
                                meningkatkan keahlian saya.
                            </p>
                            <div class="flex gap-[2px]">
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                            </div>
                        </div>

                        <!-- Testimonial 8 -->
                        <div
                            class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5"
                        >
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden"
                                >
                                    <img src={{
                                        asset("assets/photo/potocowo.png")
                                    }}
                                    class="w-full h-full object-cover"
                                    alt="photo">
                                </div>
                                <p class="font-semibold">Joko</p>
                            </div>
                            <p class="text-sm text-[#475466]">
                                Belajar di sini sangat memudahkan saya dalam
                                mengembangkan keterampilan baru dengan fleksibel
                                dan efektif.
                            </p>
                            <div class="flex gap-[2px]">
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="group/slider flex flex-nowrap w-max items-center">
                    <div
                        class="logo-container animate-[slideToR_50s_linear_infinite] group-hover/slider:pause-animate flex gap-6 pl-6 items-center flex-nowrap"
                    >
                        <!-- Testimonial 7 -->
                        <div
                            class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5"
                        >
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden"
                                >
                                    <img src={{
                                        asset("assets/photo/potocewe.png")
                                    }}
                                    class="w-full h-full object-cover"
                                    alt="photo">
                                </div>
                                <p class="font-semibold">Intan</p>
                            </div>
                            <p class="text-sm text-[#475466]">
                                Platform ini memberikan akses ke banyak kursus
                                berkualitas, saya sangat terbantu dalam
                                meningkatkan keahlian saya.
                            </p>
                            <div class="flex gap-[2px]">
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                            </div>
                        </div>

                        <!-- Testimonial 8 -->
                        <div
                            class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5"
                        >
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden"
                                >
                                    <img src={{
                                        asset("assets/photo/potocowo.png")
                                    }}
                                    class="w-full h-full object-cover"
                                    alt="photo">
                                </div>
                                <p class="font-semibold">Joko</p>
                            </div>
                            <p class="text-sm text-[#475466]">
                                Belajar di sini sangat memudahkan saya dalam
                                mengembangkan keterampilan baru dengan fleksibel
                                dan efektif.
                            </p>
                            <div class="flex gap-[2px]">
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                            </div>
                        </div>

                        <!-- Testimonial 5 -->
                        <div
                            class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5"
                        >
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden"
                                >
                                    <img src={{
                                        asset("assets/photo/potocewe.png")
                                    }}
                                    class="w-full h-full object-cover"
                                    alt="photo">
                                </div>
                                <p class="font-semibold">Maya</p>
                            </div>
                            <p class="text-sm text-[#475466]">
                                Belajar di platform ini membuat saya lebih
                                percaya diri saat menghadapi tantangan baru.
                            </p>
                            <div class="flex gap-[2px]">
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                            </div>
                        </div>

                        <!-- Testimonial 6 -->
                        <div
                            class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5"
                        >
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden"
                                >
                                    <img src={{
                                        asset("assets/photo/potocowo.png")
                                    }}
                                    class="w-full h-full object-cover"
                                    alt="photo">
                                </div>
                                <p class="font-semibold">Arya</p>
                            </div>
                            <p class="text-sm text-[#475466]">
                                Kursus yang menarik dan penuh tantangan, saya
                                merekomendasikan ini kepada teman-teman saya.
                            </p>
                            <div class="flex gap-[2px]">
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                            </div>
                        </div>
                    </div>
                    <div
                        class="logo-container animate-[slideToR_50s_linear_infinite] group-hover/slider:pause-animate flex gap-6 pl-6 items-center flex-nowrap"
                    >
                        <!-- Testimonial 7 -->
                        <div
                            class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5"
                        >
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden"
                                >
                                    <img src={{
                                        asset("assets/photo/potocewe.png")
                                    }}
                                    class="w-full h-full object-cover"
                                    alt="photo">
                                </div>
                                <p class="font-semibold">Lina</p>
                            </div>
                            <p class="text-sm text-[#475466]">
                                Platform ini sangat membantu dalam meningkatkan
                                keterampilan saya secara signifikan.
                            </p>
                            <div class="flex gap-[2px]">
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                            </div>
                        </div>

                        <!-- Testimonial 8 -->
                        <div
                            class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5"
                        >
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden"
                                >
                                    <img src={{
                                        asset("assets/photo/potocowo.png")
                                    }}
                                    class="w-full h-full object-cover"
                                    alt="photo">
                                </div>
                                <p class="font-semibold">Hadi</p>
                            </div>
                            <p class="text-sm text-[#475466]">
                                Materi yang disediakan sangat lengkap dan mudah
                                dipahami. Pengalaman belajar yang luar biasa!
                            </p>
                            <div class="flex gap-[2px]">
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                            </div>
                        </div>

                        <!-- Testimonial 9 -->
                        <div
                            class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5"
                        >
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden"
                                >
                                    <img src={{
                                        asset("assets/photo/potocewe.png")
                                    }}
                                    class="w-full h-full object-cover"
                                    alt="photo">
                                </div>
                                <p class="font-semibold">Sari</p>
                            </div>
                            <p class="text-sm text-[#475466]">
                                Fitur dan pelatihan yang ditawarkan sangat
                                membantu saya dalam memajukan karier saya.
                            </p>
                            <div class="flex gap-[2px]">
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                            </div>
                        </div>

                        <!-- Testimonial 10 -->
                        <div
                            class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5"
                        >
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden"
                                >
                                    <img src={{
                                        asset("assets/photo/potocowo.png")
                                    }}
                                    class="w-full h-full object-cover"
                                    alt="photo">
                                </div>
                                <p class="font-semibold">Dani</p>
                            </div>
                            <p class="text-sm text-[#475466]">
                                Kursus ini memberikan wawasan yang berharga dan
                                tips praktis untuk mengatasi tantangan
                                sehari-hari.
                            </p>
                            <div class="flex gap-[2px]">
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                                <img src={{ asset("assets/icon/star.svg") }}>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!--batas section -->

    <!--section FAQ -->
    <section id="FAQ" class="max-w-[1200px] mx-auto flex flex-col py-[70px] px-6 sm:px-8 md:px-[100px]">
        <div class="flex flex-col md:flex-row justify-between items-start gap-10">
            <div class="flex flex-col gap-[30px] w-full md:w-1/2">
                <!-- Badge Section -->
                <div class="gradient-badge w-fit p-[8px_16px] rounded-full border border-[#FED6AD] flex items-center gap-[6px]">
                    <div>
                        <img src="{{ asset('assets/icon/medal-star.svg') }}" alt="star medal icon">
                    </div>
                    <p class="font-medium text-sm text-[#FF6129]">Kembangkan Karier Anda</p>
                </div>

                <!-- Heading and Description -->
                <div class="flex flex-col">
                    <h2 class="font-bold text-[28px] sm:text-[32px] md:text-[36px] leading-[40px] md:leading-[52px]">
                        Dapatkan Jawaban Anda
                    </h2>
                    <p class="text-base md:text-lg text-[#475466]">Saatnya untuk meningkatkan keterampilan tanpa batas!</p>
                </div>

                <!-- Contact Button -->
                <a href="https://wa.me/62881023806530" class="text-white font-semibold rounded-[30px] p-[16px_32px] bg-[#FF6129] transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF612980] w-fit">
                    Contact Our Sales
                </a>
            </div>

            <!-- FAQ Section -->
            <div class="flex flex-col gap-[30px] w-full md:w-1/2">
                @php
                    $faqs = [
                        ['id' => '1', 'question' => 'Apakah pemula bisa bergabung dengan kursus?', 'answer' => 'Ya, kami telah menyediakan berbagai kursus dari tingkat pemula hingga menengah untuk mempersiapkan karier besar Anda berikutnya.'],
                        ['id' => '2', 'question' => 'Berapa lama waktu yang dibutuhkan untuk implementasi?', 'answer' => 'Waktu implementasi dapat bervariasi tergantung pada kompleksitas dan skala proyek. Biasanya, proses ini memakan waktu antara 4 hingga 8 minggu untuk diselesaikan.'],
                        ['id' => '3', 'question' => 'Apakah Anda menyediakan program jaminan pekerjaan?', 'answer' => 'Kami tidak dapat menjamin pekerjaan, namun kami menyediakan dukungan karier yang komprehensif dan bantuan untuk mempersiapkan Anda memasuki dunia kerja dengan percaya diri.'],
                        ['id' => '4', 'question' => 'Bagaimana cara mengeluarkan semua sertifikat kursus?', 'answer' => 'Sertifikat kursus dapat dikeluarkan melalui platform kami setelah menyelesaikan kursus dengan sukses. Anda dapat mengunduh atau mencetak sertifikat tersebut dari akun Anda.']
                    ];
                @endphp

                <!-- Loop FAQ -->
                @foreach ($faqs as $faq)
                    <div class="flex flex-col p-5 rounded-2xl bg-[#FFF8F4] border-t-4 border-[#FF6129] w-full">
                        <!-- Accordion Button -->
                        <button class="accordion-button flex justify-between gap-1 items-center w-full" data-accordion="accordion-faq-{{ $faq['id'] }}">
                            <span class="font-semibold text-lg text-left">{{ $faq['question'] }}</span>
                            <div class="arrow w-9 h-9 flex shrink-0">
                                <img src="{{ asset('assets/icon/add.svg') }}" alt="accordion icon">
                            </div>
                        </button>

                        <!-- Accordion Content -->
                        <div id="accordion-faq-{{ $faq['id'] }}" class="accordion-content hidden">
                            <p class="leading-[30px] text-[#475466] pt-[10px]">{{ $faq['answer'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--batas section -->

    <!--Footer-->
    <footer class="max-w-[1200px] mx-auto flex flex-col pt-10 pb-8 px-6 sm:px-12 md:px-20 gap-10 bg-[#F5F8FA] rounded-3xl">
        <!-- Footer Content -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-12">
            <div>
                <a href="">
                    <img src="{{ asset('assets/logo/logo.png') }}" alt="logo" class="w-14 sm:w-16">
                </a>
            </div>
            <div class="flex flex-col gap-4">
                <p class="font-semibold text-lg sm:text-xl">Products</p>
                <ul class="flex flex-col gap-3">
                    <li><a href="" class="text-[#6D7786]">Online Courses</a></li>
                    <li><a href="" class="text-[#6D7786]">Career Guidance</a></li>
                    <li><a href="" class="text-[#6D7786]">Expert Handbook</a></li>
                    <li><a href="" class="text-[#6D7786]">Interview Simulations</a></li>
                </ul>
            </div>
            <div class="flex flex-col gap-4">
                <p class="font-semibold text-lg sm:text-xl">Company</p>
                <ul class="flex flex-col gap-3">
                    <li><a href="" class="text-[#6D7786]">About Us</a></li>
                    <li><a href="" class="text-[#6D7786]">Media Press</a></li>
                    <li class="flex items-center gap-2">
                        <a href="https://www.linkedin.com/company/berkemah/?viewAsMember=true" class="text-[#6D7786]">Careers</a>
                        <div class="gradient-badge p-1 px-3 rounded-full border border-[#FED6AD] flex items-center">
                            <p class="font-medium text-xs text-[#FF6129]">We’re Hiring</p>
                        </div>
                    </li>
                    <li><a href="" class="text-[#6D7786]">Developer APIs</a></li>
                </ul>
            </div>
            <div class="flex flex-col gap-4">
                <p class="font-semibold text-lg sm:text-xl">Resources</p>
                <ul class="flex flex-col gap-3">
                    <li><a href="" class="text-[#6D7786]">Blog</a></li>
                    <li><a href="" class="text-[#6D7786]">FAQ</a></li>
                    <li><a href="" class="text-[#6D7786]">Help Center</a></li>
                    <li><a href="" class="text-[#6D7786]">Terms & Conditions</a></li>
                </ul>
            </div>
        </div>

        <!-- Copyright Section -->
        <div class="w-full h-12 flex items-center justify-center border-t border-[#E7EEF2]">
            <p class="text-sm text-[#6D7786]">All Rights Reserved Berkemah 2024</p>
        </div>
    </footer>

        <!-- JavaScript -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const menuBtn = document.getElementById("menu-btn");
                const mobileMenu = document.getElementById("mobile-menu");

                menuBtn.addEventListener("click", function () {
                    mobileMenu.classList.toggle("hidden");
                });
            });
        </script>
        <script
            src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
            crossorigin="anonymous"
        ></script>
        <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
        <script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>
