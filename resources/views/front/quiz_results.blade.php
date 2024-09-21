<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/all.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
</head>
<body class="text-black font-poppins pt-10 pb-[50px]">
    <div id="hero-section" class="max-w-[1200px] mx-auto w-full flex flex-col gap-10 bg-[url('assets/background/Hero-Banner.png')] bg-center bg-no-repeat bg-cover rounded-[32px] overflow-hidden">
        <nav class="flex justify-between items-center py-6 px-[50px]">
          <a href="">
            <img src="{{ asset('assets/logo/logo.png') }}" alt="logo"style="width: 50px;">

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

        <!-- Quiz Results Section -->
        <header>
            <h1 class="text-lg font-bold mb-4">Quiz Results for {{ $course->name }}</h1>
        </header>

        <div class="results-box mx-auto text-center bg-white p-8 rounded-lg shadow-lg max-w-md">
            <div class="results-content bg-gray-100 p-6 rounded-lg">
                <p class="text-gray-700 text-xl font-semibold mb-2">Correct Answers: <span class="text-green-500">{{ $correctCount }}</span></p>
                <p class="text-gray-700 text-xl font-semibold mb-4">Incorrect Answers: <span class="text-red-500">{{ $incorrectCount }}</span></p>
                <div class="flex justify-around">
                    <a href="{{ route('front.quiz', ['course' => $course->slug]) }}" class="btn bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Take the Quiz Again</a>
                    <a href="{{ route('front.details', ['course' => $course->slug]) }}" class="btn bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Back to Home</a>
                </div>
            </div>

            @php
                $totalQuestions = $correctCount + $incorrectCount;
                $passingThreshold = $totalQuestions / 2;
            @endphp

@if (Auth::check())
    @if (Auth::user()->subscribe_transactions('is_paid' == true))
        @if ($correctCount > $passingThreshold)
            <form action="{{ route('front.generate_certificate') }}" method="POST" class="mt-6">
                @csrf
                <input type="hidden" name="course_slug" value="{{ $course->slug }}">
                <input type="hidden" name="user_name" value="{{ auth()->check() ? auth()->user()->name : '' }}">
                <button type="submit" class="btn bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600">
                    Generate Certificate
                </button>
            </form>
        @endif
    @else
        <div class="mt-6">
            <p class="text-red-500 font-semibold">You need a PRO membership to generate the certificate.</p>
            <a href="{{ route('subscription.upgrade') }}" class="btn bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">
                Upgrade to PRO
            </a>
        </div>
    @endif
@else
@endif


        </div>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('js/main.js') }}"></script>

</body>
</html>
