<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/all.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    .button-group {
      display: flex;
      justify-content: center; /* Center align items horizontally */
      gap: 15px; /* Space between buttons */
      margin-top: 20px; /* Space above the button group */
    }

    .btn {
      background-color: #1f05e6; /* Primary button color */
      color: white;
      border: none;
      padding: 12px 25px; /* Padding for a larger button */
      border-radius: 30px; /* Rounded corners */
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.3s ease;
      font-weight: bold; /* Make button text bold */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow */
    }

    .btn:hover {
      background-color: #1a0cbf; /* Darker color on hover */
      transform: translateY(-2px); /* Lift effect on hover */
    }

    .btn.btn-back {
      background-color: #f39c12; /* Different color for Back to Home */
    }

    .btn.btn-back:hover {
      background-color: #e67e22; /* Darker color on hover for Back to Home */
    }
  </style>
</head>
<body class="text-black font-poppins pt-10 pb-[50px]">
    <div id="hero-section" class="max-w-[1200px] mx-auto w-full flex flex-col gap-10 bg-[url('assets/background/Hero-Banner.png')] bg-center bg-no-repeat bg-cover rounded-[32px] overflow-hidden">
        <nav class="flex justify-between items-center py-6 px-[50px]">
          <a href="">
            <img src="{{ asset('assets/logo/logo.png') }}" alt="logo" style="width: 50px;">
          </a>
          @if (Auth::user())
          <div class="flex gap-[10px] items-center">
              <div class="flex flex-col items-end justify-center">
                  <p class="font-semibold text-white">Hi, {{ Auth::user()->name }}</p>
                  @if (Auth::user()->subscribe_transactions('is_paid' == true))
                      <p class="p-[2px_10px] rounded-full bg-[#FF6129] font-semibold text-xs text-white text-center">PRO</p>
                  @else
                      <p class="p-[2px_10px] rounded-full bg-[#FF6129] font-semibold text-xs text-white text-center">-</p>
                  @endif
              </div>
              <a href="{{ route('dashboard') }}" class="w-[56px] h-[56px] overflow-hidden rounded-full flex shrink-0">
                  <img src="{{ Storage::url(Auth::user()->avatar) }}" class="w-full h-full object-cover" alt="photo">
              </a>
          </div>
          @else
          <div class="flex gap-[10px] items-center">
              <a href="{{ route('register') }}" class="text-white font-semibold rounded-[30px] p-[16px_32px] ring-1 ring-white transition-all duration-300 hover:ring-2 hover:ring-[#FF6129]">Sign Up</a>
              <a href="{{ route('login') }}" class="text-white font-semibold rounded-[30px] p-[16px_32px] bg-[#FF6129] transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF612980]">Sign In</a>
          </div>
          @endif
        </nav>

        <header>
            <h1>Quiz for {{ $course->name }}</h1>
        </header>

        @if($quizQuestions->isEmpty())
        <div class="alert alert-warning">
            Instruktur belum memberikan pertanyaan apa pun untuk kuis ini.
        <a href="{{ route('front.details',['course' => $course->slug]) }}" class="btn btn-back">Back to Home</a>

        </div>

    @else
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

            <!-- Submit button -->
            <div class="button-group">
                <button type="submit" class="btn">Submit Answers</button>
                <a href="{{ route('front.details',['course' => $course->slug]) }}" class="btn btn-back">Back to Home</a>
            </div>
        </form>
    @endif

    </div>
    <head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>

    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
