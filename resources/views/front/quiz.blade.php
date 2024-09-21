<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/output.css') }}" rel="stylesheet">
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

        <header>
            <h1>Quiz for {{ $course->name }}</h1>
        </header>

        <form action="{{ route('front.submit_quiz', ['course' => $course->slug]) }}" method="POST">
            @csrf
            @foreach ($quizQuestions as $question)
                <div class="quiz-question">
                    <h2>{{ $question->question }}</h2>

                    <ul class="options">
                        @php
                            $options = json_decode($question->options, true);
                        @endphp
                        @foreach ($options as $index => $option)
                            <li>
                                <label>
                                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option }}" required>
                                    {{ $option }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>

            @endforeach
            <div class="button-container">
                <button type="submit" class="btn btn-orange">Submit Answers</button>
                <a href="{{ route('front.details',['course' => $course->slug]) }}" class="btn btn-orange">Back to Home</a>
            </div>

        </form>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('js/main.js') }}"></script>

</body>
</html>

