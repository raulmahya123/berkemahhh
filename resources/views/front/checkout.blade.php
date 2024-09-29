<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/output.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
</head>
<body class="text-black font-poppins pt-10">
    <div id="checkout-section" class="max-w-[1200px] mx-auto w-full min-h-[calc(100vh-40px)] flex flex-col gap-[30px] bg-[url('assets/background/Hero-Banner.png')] bg-center bg-no-repeat bg-cover rounded-t-[32px] overflow-hidden relative pb-6">
        <nav class="flex justify-between items-center pt-6 px-[50px]">
            <a href="index.html">
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
        <<div class="flex flex-col gap-[10px] items-center">
            <div class="gradient-badge w-fit p-[8px_16px] rounded-full border border-[#FED6AD] flex items-center gap-[6px]">
                <div>
                    <img src={{ asset('assets/icon/medal-star.svg') }} alt="ikon">
                </div>
                <p class="font-medium text-sm text-[#FF6129]">Investasikan pada diri Anda hari ini</p>
            </div>
            <h2 class="font-bold text-[40px] leading-[60px] text-white">Checkout Langganan</h2>
        </div>
        <div class="flex gap-10 px-[100px] relative z-10">
            <div class="w-[400px] flex shrink-0 flex-col bg-white rounded-2xl p-5 gap-4 h-fit">
                <p class="font-bold text-lg">Paket</p>
                <div class="flex items-center justify-between w-full">
                    <div class="flex items-center gap-3">
                        <div class="w-[50px] h-[50px] flex shrink-0 rounded-full overflow-hidden">
                            <img src={{ asset('assets/logo/logo.png') }} class="w-full h-full object-cover" alt="loto">
                        </div>
                        <div class="flex flex-col gap-[2px]">
                            <p class="font-semibold">Premium</p>
                            <p class="text-sm text-[#6D7786]">Akses 30 hari</p>
                        </div>
                    </div>
                    <p class="p-[4px_12px] rounded-full bg-[#FF6129] font-semibold text-xs text-white text-center">Populer</p>
                </div>
                <hr>
                <div class="flex flex-col gap-5">
                    <div class="flex gap-3">
                        <div class="w-6 h-6 flex shrink-0">
                            <img src={{ asset('assets/icon/tick-circle.svg') }} class="w-full h-full object-cover" alt="ikon">
                        </div>
                        <p class="text-[#475466]">Akses semua materi kursus</p>
                    </div>
                    <div class="flex gap-3">
                        <div class="w-6 h-6 flex shrink-0">
                            <img src={{ asset('assets/icon/tick-circle.svg') }} class="w-full h-full object-cover" alt="ikon">
                        </div>
                        <p class="text-[#475466]">Buka semua lencana kursus untuk pekerjaan</p>
                    </div>
                    <div class="flex gap-3">
                        <div class="w-6 h-6 flex shrink-0">
                            <img src={{ asset('assets/icon/tick-circle.svg') }} class="w-full h-full object-cover" alt="ikon">
                        </div>
                        <p class="text-[#475466]">Dapatkan hadiah premium</p>
                    </div>
                    <div class="flex gap-3">
                        <div class="w-6 h-6 flex shrink-0">
                            <img src={{ asset('assets/icon/award-outline.svg') }} class="w-full h-full object-cover" alt="ikon">
                        </div>
                        <p class="text-[#475466]">Free E-Certificate</p>
                    </div>
                </div>
                <p class="font-semibold text-4xl leading-[42px] price">
                    Rp <span class="strikethrough"></span> 200.000
                </p>
            </div>
            <form method="POST" action="{{ route('front.checkout.store') }}" enctype="multipart/form-data" class="w-full flex flex-col bg-white rounded-2xl p-5 gap-5">
                @csrf
                <p class="font-bold text-lg">Kirim Pembayaran</p>
                <div class="flex flex-col gap-5">
                    <div class="flex items-center justify-between">
                        <div class="flex gap-3">
                            <div class="w-6 h-6 flex shrink-0">
                                <img src={{ asset('assets/icon/tick-circle.svg') }} class="w-full h-full object-cover" alt="ikon">
                            </div>
                            <p class="text-[#475466]">Nama Bank</p>
                        </div>
                        <p class="font-semibold">BCA</p>
                        <input type="hidden" name="bankName" value="Berkemah.id">
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex gap-3">
                            <div class="w-6 h-6 flex shrink-0">
                                <img src={{ asset('assets/icon/tick-circle.svg') }} class="w-full h-full object-cover" alt="ikon">
                            </div>
                            <p class="text-[#475466]">No Rekening</p>
                        </div>
                        <p class="font-semibold">4372794465</p>
                        <input type="hidden" name="accountNumber" value="22081996202191404">
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex gap-3">
                            <div class="w-6 h-6 flex shrink-0">
                                <img src={{ asset('assets/icon/tick-circle.svg') }} class="w-full h-full object-cover" alt="ikon">
                            </div>
                            <p class="text-[#475466]">Nama No Rekening</p>
                        </div>
                        <p class="font-semibold">Raul Mahya</p>
                        <input type="hidden" name="accountName" value="Alqowy Education First">
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex gap-3">
                            <div class="w-6 h-6 flex shrink-0">
                                <img src={{ asset('assets/icon/icons8-swift.svg') }} class="w-full h-full object-cover" alt="ikon">
                            </div>
                            <p class="text-[#475466]">Kode Swift</p>
                        </div>
                        <p class="font-semibold">{{ $codeSwift }}</p>
                        <input type="hidden" name="code_swift" value="{{ $codeSwift }}">
                    </div>
                </div>
                <hr>
                <p class="font-bold text-lg">Konfirmasi Pembayaran Anda</p>
                <div class="relative">
                    <button type="button" class="p-4 rounded-full flex gap-3 w-full ring-1 ring-black transition-all duration-300 hover:ring-2 hover:ring-[#FF6129]" onclick="document.getElementById('file').click()">
                        <div class="w-6 h-6 flex shrink-0">
                            <img src={{ asset('assets/icon/note-add.svg') }} alt="ikon">
                        </div>
                        <p id="fileLabel">Tambahkan lampiran file</p>
                    </button>
                    <input id="file" type="file" name="proof" class="hidden" onchange="updateFileName(this)">
                </div>
                <a href="{{ route('dashboard') }}">
                    <button class="p-[20px_32px] bg-[#FF6129] text-white rounded-full text-center font-semibold transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF612980]">
                        Saya Telah Melakukan Pembayaran
                    </button>
                </a>

            </form>
        </div>
        <div class="flex justify-center absolute transform -translate-x-1/2 left-1/2 bottom-0 w-full">
        </div>

    </div>

    <!-- JavaScript -->
    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>
</html>
