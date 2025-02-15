<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/certificate/certificate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/certificate/previewCertificate.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
</head>

<body class=" pt-10 pb-[50px]">
    <div id="hero-section"
        class="max-w-[1200px] mx-auto w-full flex flex-col gap-10 bg-[url('assets/background/Hero-Banner.png')] bg-center bg-no-repeat bg-cover rounded-[32px] overflow-hidden">
        <nav class="flex justify-between items-center py-6 px-[50px]">

            <a href="{{ route('front.index') }}">
                <img src="{{ asset('assets/logo/logo.png') }}" alt="logo"style="width: 70px;">

            </a>
            @if (Auth::user())
                <div class="flex gap-[10px] items-center">
                    <div class="flex flex-col items-end justify-center">
                        <p class="font-semibold text-white">Hi, {{ Auth::user()->name }}</p>
                        @if (Auth::user()->subscribe_transactions('is_paid' == true))
                            <p
                                class="p-[2px_10px] rounded-full bg-[#FF6129] font-semibold text-xs text-white text-center">
                                PRO
                            </p>
                        @else
                            <p
                                class="p-[2px_10px] rounded-full bg-[#FF6129] font-semibold text-xs text-white text-center">
                                -
                            </p>
                        @endif
                    </div>
                    <a href="{{ route('dashboard') }}"
                        class="w-[56px] h-[56px] overflow-hidden rounded-full flex shrink-0">
                        <img src="{{ Storage::url(Auth::user()->avatar) }}" class="w-full h-full object-cover"
                            alt="photo">
                    </a>
                </div>
            @else
                <div class="flex gap-[10px] items-center">
                    <a href="{{ route('register') }}"
                        class="text-white font-semibold rounded-[30px] p-[16px_32px] ring-1 ring-white transition-all duration-300 hover:ring-2 hover:ring-[#FF6129]">Sign
                        Up</a>
                    <a href="{{ route('login') }}"
                        class="text-white font-semibold rounded-[30px] p-[16px_32px] bg-[#FF6129] transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF612980]">Sign
                        In</a>
                </div>
            @endif
        </nav>

        <div class="certificate-section">
            <p class="page-title">Sertifikat</p>
            <div class="certificate-background">
                <img src="{{ asset('assets/background/Desain Sertifikat.svg') }}" class="certificate-image">
                <div class="certificate-container">
                    <div class="certificate-data">
                        <p class="course-title">PROGRAM KURSUS: {{ strtoupper($course->name) }}</p>
                        <p class="course-givento">Sertifikat ini diberikan kepada</p>
                        <p class="user-name">{{ strtoupper($user->name) }}</p>
                        <p class="course-desc">Sebagai apresiasi atas penyelesaian program dengan hasil memuaskan.</p>
                        <p class="course-finished">Pada tanggal
                            {{ $issuedDate }}</p>
                        <p class="course-privider">Program Belajar Koding Bersama Mahya</p>
                    </div>
                    <div class="certificate-links">
                        <p class="certificate-no">NO: {{ $certificate->certificate_code }}</p>
                        <p class="certificate-link">{{ url('/certificates/' . $certificate->certificate_code) }}</p>
                    </div>
                </div>
            </div>
            <div class="buttons">
                <a class="back-btn" href="{{ route('front.certificate.index_by_user') }}">Beranda</a>
                <a class="download-btn">Unduh Sertifikat</a>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/certificate/certificateDownload.js') }}"></script>
</body>

</html>
