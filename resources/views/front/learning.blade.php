<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
    <link href="{{ asset('css/learning/style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <link rel="icon" href="{{ asset('assets/logo/logo.png') }}" type="image/png">
</head>

<body class="text-black font-poppins pt-10 pb-[50px]">
    <input type="hidden" value="{{ $course->id }}" id="courseId">
    <div style="background-image: url('{{ asset('assets/background/Hero-Banner.png') }}')" id="hero-section"
        class="max-w-[1200px] mx-auto w-full h-[393px] flex flex-col gap-10 pb-[50px] bg-[url('')] bg-center bg-no-repeat bg-cover rounded-[32px] overflow-hidden absolute transform -translate-x-1/2 left-1/2">
        <nav class="flex justify-between items-center pt-6 px-[50px]">
            <a href="{{ route('front.index') }}">
                <img src="{{ asset('assets/logo/logo.png') }}" alt="logo" style="width: 50px;">
            </a>
            <ul class="flex items-center gap-[30px] text-white">
                <li>
                    <a href="{{ route('front.index') }}" class="font-semibold">Home</a>
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
                    <a href="{{ route('dashboard') }}"
                        class="w-[56px] h-[56px] overflow-hidden rounded-full flex shrink-0">
                        <img src="{{ Storage::url(Auth::user()->avatar) }}" class="w-full h-full object-cover"
                            alt="photo">

                    </a>
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
    </div>
    <section id="video-content" class="max-w-[1100px] w-full mx-auto mt-[130px]">
        <div class="video-player relative flex flex-nowrap gap-5">
            <div class="plyr__video-embed w-full overflow-hidden relative rounded-[20px]" id="player">
                <iframe
                    src="https://www.youtube.com/embed/{{ $video->path_video }}?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1"
                    allowfullscreen allowtransparency allow="autoplay"></iframe>
            </div>
            <div
                class="video-player-sidebar flex flex-col shrink-0 w-[330px] h-[470px] bg-[#F5F8FA] rounded-[20px] p-5 gap-5 pb-0 overflow-y-scroll no-scrollbar">
                <p class="font-bold text-lg text-black">{{ $course->course_videos->count() }} Pelajaran</p>
                <div class="flex flex-col gap-3">
                    <div
                        class="group p-[12px_16px] flex items-center gap-[10px] bg-[#E9EFF3] rounded-full hover:bg-[#3525B3] transition-all duration-300">
                        <div class="text-black group-hover:text-white transition-all duration-300">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.97 2C6.44997 2 1.96997 6.48 1.96997 12C1.96997 17.52 6.44997 22 11.97 22C17.49 22 21.97 17.52 21.97 12C21.97 6.48 17.5 2 11.97 2ZM14.97 14.23L12.07 15.9C11.71 16.11 11.31 16.21 10.92 16.21C10.52 16.21 10.13 16.11 9.76997 15.9C9.04997 15.48 8.61997 14.74 8.61997 13.9V10.55C8.61997 9.72 9.04997 8.97 9.76997 8.55C10.49 8.13 11.35 8.13 12.08 8.55L14.98 10.22C15.7 10.64 16.13 11.38 16.13 12.22C16.13 13.06 15.7 13.81 14.97 14.23Z"
                                    fill="currentColor" />
                            </svg>
                        </div>
                        <a href="{{ route('front.details', $course) }}">
                            <p class="font-semibold group-hover:text-white transition-all duration-300">Course Trailer
                            </p>
                        </a>
                    </div>

                    @forelse ($course->course_videos as $course_video )

                        @php
                            $currentVideoId = Route::current()->parameter('courseVideoId');
                            $isActive = $currentVideoId == $course_video->id;
                        @endphp

                        <div
                            class="group p-[12px_16px] flex items-center gap-[10px] {{ $isActive ? 'bg-[#3525B3]' : 'bg-[#E9EFF3]' }} rounded-full hover:bg-[#3525B3] transition-all duration-300">
                            @if ($isActive)
                                <div class="text-white group-hover:text-white transition-all duration-300">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.97 2C6.44997 2 1.96997 6.48 1.96997 12C1.96997 17.52 6.44997 22 11.97 22C17.49 22 21.97 17.52 21.97 12C21.97 6.48 17.5 2 11.97 2ZM14.97 14.23L12.07 15.9C11.71 16.11 11.31 16.21 10.92 16.21C10.52 16.21 10.13 16.11 9.76997 15.9C9.04997 15.48 8.61997 14.74 8.61997 13.9V10.55C8.61997 9.72 9.04997 8.97 9.76997 8.55C10.49 8.13 11.35 8.13 12.08 8.55L14.98 10.22C15.7 10.64 16.13 11.38 16.13 12.22C16.13 13.06 15.7 13.81 14.97 14.23Z"
                                            fill="currentColor" />
                                    </svg>
                                </div>
                            @else
                                <div class="text-black group-hover:text-white transition-all duration-300">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.97 2C6.44997 2 1.96997 6.48 1.96997 12C1.96997 17.52 6.44997 22 11.97 22C17.49 22 21.97 17.52 21.97 12C21.97 6.48 17.5 2 11.97 2ZM14.97 14.23L12.07 15.9C11.71 16.11 11.31 16.21 10.92 16.21C10.52 16.21 10.13 16.11 9.76997 15.9C9.04997 15.48 8.61997 14.74 8.61997 13.9V10.55C8.61997 9.72 9.04997 8.97 9.76997 8.55C10.49 8.13 11.35 8.13 12.08 8.55L14.98 10.22C15.7 10.64 16.13 11.38 16.13 12.22C16.13 13.06 15.7 13.81 14.97 14.23Z"
                                            fill="currentColor" />
                                    </svg>
                                </div>
                            @endif
                                <!-- checkpoint button video -->
                            <a href="{{ route('front.learning', [$course, 'courseVideoId' => $course_video->id]) }}">
                                <p
                                    class="font-semibold {{ $isActive ? 'text-white' : 'text-black' }} group-hover:text-white duration-300" id="courseVideo-{{ $course_video->id }}">
                                    {{ $course_video->name }}</p>
                            </a>

                        </div>

                        @if (Auth::check())
                            @if (Auth::user()->subscribe_transactions('is_paid' == true))
                                <!-- User is PRO -->
                                <form id="quiz-form"
                                    action="{{ route('front.submit_quiz', ['course' => $course->slug]) }}"
                                    method="POST">
                                    @csrf

                                    <!-- Your quiz form content -->
                                </form>
                            @else
                                <!-- User is authenticated but not PRO -->
                                <form id="quiz-form-upgrade">
                                    <button type="button" class="btn-custom"
                                        onclick="window.location.href='{{ route('subscription.upgrade') }}'">
                                        Upgrade to PRO
                                    </button>
                                </form>
                            @endif
                        @else
                            <!-- User is not authenticated -->
                            <form id="quiz-form-login">
                                <button type="button" class="btn-custom"
                                    onclick="window.location.href='{{ route('login') }}'">
                                    Log In to Start Quiz
                                </button>
                            </form>
                        @endif



                        <script>
                            function redirectToQuiz() {
                                // Redirect to the quiz page first
                                window.location.href = "{{ route('front.quiz', ['course' => $course->slug]) }}";
                            }
                        </script>
                    @empty
                        <p>Belum ada video pembelajaran</p>
                    @endforelse
                    <form id="buttonProgressForm">
                        @csrf
                        <input id="course_id" type="hidden" name="course_id" value="{{ $courseVideo->course_id }}">
                        <input id="course_video_id" type="hidden" name="course_video_id" value="{{ $courseVideo->id }}">
                        <button type="submit" id="completeBtn" class="btn-customm hover:bg-blue-700 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Ya, saya sudah paham
                        </button>
                    </form>

                    <!-- <div class="buttonContainer" id="buttonContainer"> -->

                    </div>
                    <button type="button" class="btn-customm" style="background-color:  #3525B3;"
                        onclick="redirectToQuiz()">Mulai Quiz</button>
                </div>
            </div>
        </div>
    </section>
    <section id="Video-Resources" class="flex flex-col mt-5">
        <div class="max-w-[1100px] w-full mx-auto flex flex-col gap-3">
            <h1 class="title font-extrabold text-[30px] leading-[45px]">{{ $course->name }}</h1>

            <div class="flex items-center gap-5">
                <div class="flex items-center gap-[6px]">
                    <div>
                        <img src="{{ asset('assets/icon/crown.svg') }}" alt="icon">
                    </div>
                    <p class="font-semibold">{{ $course->category->name }}</p>
                </div>
                <div class="flex items-center gap-[6px]">
                    <div>
                        <img src="{{ asset('assets/icon/award-outline.svg') }}" alt="icon">
                    </div>
                    <p class="font-semibold">Certificate</p>
                </div>
                <div class="flex items-center gap-[6px]">
                    <div>
                        <img src="{{ asset('assets/icon/profile-2user.svg') }}" alt="icon">
                    </div>
                    <p class="font-semibold">{{ $course->students->count() }} students</p>
                </div>
                <div class="flex items-center gap-[6px]">
                    <div>
                        <img src="{{ asset('assets/icon/brifecase-tick.svg') }}" alt="icon">
                    </div>
                    <p class="font-semibold">Job-Guarantee</p>
                </div>
            </div>
        </div>
        <div
            class="max-w-[1100px] w-full mx-auto mt-10 tablink-container flex gap-3 px-4 sm:p-0 no-scrollbar overflow-x-scroll">
            <div class="tablink font-semibold text-lg h-[47px] transition-all duration-300 cursor-pointer hover:text-[#FF6129]"
                onclick="openPage('About', this)" id="defaultOpen">Tentang</div>
            <div class="tablink font-semibold text-lg h-[47px] transition-all duration-300 cursor-pointer hover:text-[#FF6129]"
                onclick="openPage('Resources', this)">Sumber Daya</div>
            <div class="tablink font-semibold text-lg h-[47px] transition-all duration-300 cursor-pointer hover:text-[#FF6129]"
                onclick="openPage('Reviews', this)">Ulasan</div>
            <div class="tablink font-semibold text-lg h-[47px] transition-all duration-300 cursor-pointer hover:text-[#FF6129]"
                onclick="openPage('Discussions', this)">Diskusi</div>
            <div class="tablink font-semibold text-lg h-[47px] transition-all duration-300 cursor-pointer hover:text-[#FF6129]"
                onclick="openPage('Rewards', this)">Hadiah</div>
        </div>
        <div class="bg-[#F5F8FA] py-[50px]">
            <div class="max-w-[1100px] w-full mx-auto flex flex-col gap-[70px]">
                <div class="flex gap-[50px]">
                    <div class="tabs-container w-[700px] flex shrink-0">
                        <div id="About" class="tabcontent hidden">
                            <div class="flex flex-col gap-5 w-[700px] shrink-0">
                                <h3 class="font-bold text-2xl">Grow Your Career</h3>
                                <p class="font-medium leading-[30px]">
                                    {{ $course->about }}
                                </p>
                                <div class="grid grid-cols-2 gap-x-[30px] gap-y-5">
                                    @foreach ($course->course_keypoints as $keypoint)
                                        <div class="benefit-card flex items-center gap-3">
                                            <div class="w-6 h-6 flex shrink-0">
                                                <img src="{{ asset('assets/icon/tick-circle.svg') }}" alt="icon">
                                            </div>
                                            <p class="font-medium leading-[30px]">{{ $keypoint->name }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div id="Resources" class="tabcontent hidden">
                            <div class="flex flex-col gap-5 w-[700px] shrink-0">
                                <h3 class="font-bold text-2xl">Sumber Daya</h3>
                                <p class="font-medium leading-[30px]">
                                    Temukan berbagai sumber daya tambahan yang mendukung pembelajaran Anda, termasuk
                                    materi bacaan, video tutorial, dan alat bantu lainnya yang dirancang untuk
                                    memperdalam pemahaman Anda tentang topik ini.
                                </p>
                            </div>
                        </div>

                        <div id="Reviews" class="tabcontent hidden">
                            <div class="flex flex-col gap-5 w-[700px] shrink-0">
                                <h3 class="font-bold text-2xl">Ulasan</h3>
                                <p class="font-medium leading-[30px]">
                                    Baca ulasan dari peserta lain yang telah mengikuti kursus ini. Temukan apa yang
                                    mereka katakan tentang pengalaman mereka dan bagaimana kursus ini telah membantu
                                    mereka dalam mencapai tujuan mereka.
                                </p>
                            </div>
                        </div>

                        <div id="Discussions" class="tabcontent hidden">
                            <div class="flex flex-col gap-5 w-[700px] shrink-0">
                                <h3 class="font-bold text-2xl">Diskusi</h3>
                                <p class="font-medium leading-[30px]">
                                    Bergabunglah dalam diskusi dengan instruktur dan peserta lain. Ajukan pertanyaan,
                                    berbagi ide, dan dapatkan wawasan lebih dalam tentang topik yang dibahas dalam
                                    kursus ini.
                                </p>
                            </div>
                        </div>

                        <div id="Rewards" class="tabcontent hidden">
                            <div class="flex flex-col gap-5 w-[700px] shrink-0">
                                <h3 class="font-bold text-2xl">Hadiah</h3>
                                <p class="font-medium leading-[30px]">
                                    Jelajahi berbagai hadiah yang dapat Anda peroleh dengan menyelesaikan kursus ini.
                                    Hadiah ini dirancang untuk mengakui pencapaian Anda dan memberikan dorongan tambahan
                                    dalam perjalanan pembelajaran Anda.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mentor-sidebar flex flex-col gap-[30px] w-full">
                        <div class="mentor-info bg-white flex flex-col gap-4 rounded-2xl p-5">
                            <p class="font-bold text-lg text-left w-full">Teacher</p>
                            <div class="flex items-center justify-between w-full">
                                <div class="flex items-center gap-3">
                                    <a href=""
                                        class="w-[50px] h-[50px] flex shrink-0 rounded-full overflow-hidden">
                                        <img src="{{ Storage::url($course->teacher->user->avatar) }}"
                                            class="w-full h-full object-cover" alt="photo">
                                    </a>
                                    <div class="flex flex-col gap-[2px]">
                                        <a href=""
                                            class="font-semibold">{{ $course->teacher->user->name }}</a>
                                        <p class="text-sm text-[#6D7786]">{{ $course->teacher->user->occupation }}</p>
                                    </div>
                                </div>
                                <a href=""
                                    class="p-[4px_12px] rounded-full bg-[#FF6129] font-semibold text-xs text-white text-center">Ikuti</a>
                            </div>
                        </div>

                        <div class="bg-white flex flex-col gap-5 rounded-2xl p-5">
                            <a class="btn-customm" id="openModalBtn" style="background-color:  #3525B3;">Tanya
                                Mentor</a>
                            {{-- <a href="/comments/{{ $course->slug }}" class="btn-customm" id="openModalBtn" style="background-color:  #3525B3;">Tanya Mentor</a> --}}

                            <p class="font-bold text-lg text-left w-full">Buka Lencana</p>

                            <div class="flex items-center gap-3">
                                <div class="w-[50px] h-[50px] flex shrink-0 rounded-full overflow-hidden">
                                    <img src="{{ asset('assets/icon/Group 7.svg') }}"
                                        class="w-full h-full object-cover" alt="ikon">
                                </div>
                                <div class="flex flex-col gap-[2px]">
                                    <div class="font-semibold">Semangat Belajar</div>
                                    <p class="text-sm text-[#6D7786]">18.393 diperoleh</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-[50px] h-[50px] flex shrink-0 rounded-full overflow-hidden">
                                    <img src="{{ asset('assets/icon/Group 7-1.svg') }}"
                                        class="w-full h-full object-cover" alt="ikon">
                                </div>
                                <div class="flex flex-col gap-[2px]">
                                    <div class="font-semibold">Setiap Hari Baru</div>
                                    <p class="text-sm text-[#6D7786]">6.392 diperoleh</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-[50px] h-[50px] flex shrink-0 rounded-full overflow-hidden">
                                    <img src="{{ asset('assets/icon/Group 7-2.svg') }}"
                                        class="w-full h-full object-cover" alt="ikon">
                                </div>
                                <div class="flex flex-col gap-[2px]">
                                    <div class="font-semibold">Pembelajar Cepat Pro</div>
                                    <p class="text-sm text-[#6D7786]">44 diperoleh</p>
                                </div>
                            </div>
                            <!-- resources/views/your_view.blade.php -->
                            <a href="{{ route('front.certificate.index_by_user') }}" class="btn-customm"
                                style="background-color:  #3525B3;">
                                Lihat Sertifikat Saya
                            </a>


                        </div>

                    </div>
                </div>
                <div id="Screenshots" class="flex flex-col gap-3">
                    <h3 class="title-section font-bold text-xl leading-[30px] ">Students Portfolio</h3>
                    <div class="grid grid-cols-4 gap-5">
                        <div class="rounded-[20px] overflow-hidden w-full h-[200px] hover:shadow-[0_10px_20px_0_#0D051D20] transition-all duration-300"
                            data-src={{ asset('assets/thumbnail/image.png') }} data-fancybox="gallery"
                            data-caption="Caption #1">
                            <img src="{{ asset('assets/thumbnail/image.png') }}" class="object-cover h-full w-full"
                                alt="image">
                        </div>
                        <div class="rounded-[20px] overflow-hidden w-full h-[200px] hover:shadow-[0_10px_20px_0_#0D051D20] transition-all duration-300"
                            data-src={{ asset('assets/thumbnail/image-1.png') }} data-fancybox="gallery"
                            data-caption="Caption #1">
                            <img src="{{ asset('assets/thumbnail/image-1.png') }}" class="object-cover h-full w-full"
                                alt="image">
                        </div>
                        <div class="rounded-[20px] overflow-hidden w-full h-[200px] hover:shadow-[0_10px_20px_0_#0D051D20] transition-all duration-300"
                            data-src={{ asset('assets/thumbnail/image-2.png') }} data-fancybox="gallery"
                            data-caption="Caption #1">
                            <img src="{{ asset('assets/thumbnail/image-2.png') }}" class="object-cover h-full w-full"
                                alt="image">
                        </div>
                        <div class="rounded-[20px] overflow-hidden w-full h-[200px] hover:shadow-[0_10px_20px_0_#0D051D20] transition-all duration-300"
                            data-src={{ asset('assets/thumbnail/image-3.png') }} data-fancybox="gallery"
                            data-caption="Caption #1">
                            <img src="{{ asset('assets/thumbnail/image-3.png') }}" class="object-cover h-full w-full"
                                alt="image">
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
    {{-- comment modal --}}
    <div id="commentModal" class="modal initial-modal">
        <!-- Modal Content -->
        <!-- Modal Header -->
        <div class="modal-section">
            <div class="modal-content" id="modal-content-comment">

                <div class="modal-header">
                    <div>
                        <span style="color: #838383; font-size: 14px;">Diskusi</span>
                        <h2 class="text-2xl font-semibold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight"
                            style="margin-bottom: 20px;">
                            {{ $course->name }}
                        </h2>
                    </div>
                    <span class="close">&times;</span>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Label dan Select untuk Judul -->
                    <form id="commentForm" action="{{ url('comments/' . $course->slug) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <select name="course_video_id" id="judul" class="form-control">
                                @foreach ($courseVideos as $video)
                                    <option value="{{ $video->id }}">{{ $video->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Label dan Textarea untuk Pertanyaan -->

                        <div class="form-group">
                            <label for="pertanyaan">Pertanyaan Anda</label>
                            <textarea name="body" id="pertanyaan" rows="4" class="form-control"></textarea>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="form-actions end-to-end">
                            <button class="btn btn-primary" type="submit">Kirim</button>
                            <button class="btn btn-secondary" type="button" id="cancelComment">Batal</button>

                        </div>
                        <div style="margin-top: 10px" id="responseMessage"></div>
                    </form>

                    <h2 class="text-2xl font-semibold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight"
                        style="margin-top: 20px;">
                        Pertanyaan terbaru</h2>
                    <span style="color: #838383; font-size: 14px;">Cari solusi untuk kendalamu</span>

                    <div id="commentsContainer"></div>

                    <div class="options-card" id="options-forComment">
                        <input type="hidden" id="commentIdforDelete">
                        <div class="option-element" style="color: #131313"
                            onclick="editorComment(event, document.querySelector('#commentIdforDelete').value)">
                            <span class="icon">
                                <img src="{{ asset('assets/icon/edit-pencil.svg') }}" alt="reply icon"
                                    width="11.52" height="11.52">
                            </span>
                            Edit
                        </div>
                        <div class="option-element" style="color: #131313"
                            onclick="deleteComment(document.querySelector('#commentIdforDelete').value)">
                            <span class="icon">
                                <img src="{{ asset('assets/icon/hapus-trash.svg') }}" alt="reply icon"
                                    width="10.89" height="14">
                            </span>
                            Hapus
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            {{-- <div class="modal-footer">
            <button>Save</button>
            <button class="close">Close</button>
        </div> --}}
        </div>
    </div>
    {{-- reply modal --}}
    <div id="replyModal" class="modal">
        <!-- Modal Content -->
        <!-- Modal Header -->
        <div class="modal-section">
            <div class="modal-content" id="modal-content-reply">

                <div class="modal-header">
                    <div>
                        <span style="color: #838383; font-size: 14px;">Diskusi</span>
                        <h2 class="text-2xl font-semibold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight"
                            style="margin-bottom: 20px;">
                            {{ $course->name }}
                        </h2>
                    </div>
                    <span class="replyclose">&times;</span>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Label dan Select untuk Judul -->
                    <div id="commentContainer"></div>

                    <!-- Tombol Aksi -->
                    <div class="form-actions end-to-end" id="replyActions" style="margin-top: 20px;">
                        <button class="btn btn-primary" id="writeReply">Bantu jawab</button>
                        <button class="btn btn-secondary" id="kembaliButton">Kembali</button>
                    </div>

                    <div class="replying" style="margin-top: 20px;">
                        <form action="{{ url('replies/') }}" method="POST" id="replyForm">
                            @csrf
                            <input type="hidden" id="commentIdForReply" name="comment_id" />
                            <div class="form-group">
                                <textarea name="body" placeholder="Berikan balasan" rows="3" class="form-control" required></textarea>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="form-actions end-to-end">
                                <button class="btn btn-primary" type="submit">Kirim</button>
                                <button class="btn btn-secondary" id="cancelReply" type="button">Batal</button>
                            </div>
                        </form>
                    </div>

                    <div style="margin-top: 10px" id="replyResponseMessage"></div>

                    <h2 class="text-2xl font-semibold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight"
                        style="margin-top: 20px;">
                        Jawaban</h2>
                    <span style="color: #838383; font-size: 14px;">Solusi dari mentor</span>

                    <div id="repliesContainer"></div>

                    <div class="options-card" id="options-forReply">
                        <input type="hidden" id="replyId">
                        <div class="option-element" style="color: #131313"
                            onclick="editorReply(document.querySelector('#replyId').value)">
                            <span class="icon">
                                <img src="{{ asset('assets/icon/edit-pencil.svg') }}" alt="reply icon"
                                    width="11.52" height="11.52">
                            </span>
                            Edit
                        </div>
                        <div class="option-element" style="color: #131313"
                            onclick="deleteReply(document.querySelector('#replyId').value)">
                            <span class="icon">
                                <img src="{{ asset('assets/icon/hapus-trash.svg') }}" alt="reply icon"
                                    width="10.89" height="14">
                            </span>
                            Hapus
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer
        class="max-w-[1200px] mx-auto flex flex-col pt-[70px] pb-[50px] px-[100px] gap-[50px] bg-[#F5F8FA] rounded-[32px]">
        <div class="flex justify-between">
            <a href="">
                <div>
                    <img src="{{ asset('assets/logo/logo.png') }}" alt="logo" style="width: 50px;">

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
                        <a href="https://www.linkedin.com/company/berkemah/?viewAsMember=true"
                            class="text-[#6D7786]">Careers</a>
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

    <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        const assetBaseUrl = "{{ asset('') }}";
        const storageUrl = "{{ Storage::url('') }}";
        const loggedInUserId = "{{ Auth::user()->id }}";
    </script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/modal.js') }}"></script>
    <script src="{{ asset('js/comment/comments.js') }}"></script>
    <script src="{{ asset('js/comment/commentPost.js') }}"></script>
    <script src="{{ asset('js/comment/commentDelete.js') }}"></script>
    <script src="{{ asset('js/comment/commentUpdate.js') }}"></script>
    <script src="{{ asset('js/replies/replies.js') }}"></script>
    <script src="{{ asset('js/replies/replyPost.js') }}"></script>


    <script>
        $('#buttonProgressForm').on("submit", function (e) {
            e.preventDefault();
            const id = $("#course_video_id").val();
            const formData = new FormData(this);
            let url = "/course-progress";
            let method = "POST";
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    type: method,
                    url: url,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response.progress);
                        $("#courseVideo-"+id).html("checklis");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        errorValidation(jqXHR.responseJSON.errors);
                    },
                });
        });
    </script>

    <script src="{{ asset('js/replies/replyDelete.js') }}"></script>
    <script src="{{ asset('js/replies/replyUpdate.js') }}"></script>

</body>

</html>
