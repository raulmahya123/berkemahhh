<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/all.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
.paginationn {
    display: flex;
    flex-direction: column; /* Stack elements vertically */
    align-items: center; /* Center align items */
    margin-top: 20px;
}

.button-group {
    display: flex;
    gap: 15px; /* Space between buttons */
    margin-bottom: 20px; /* Space between buttons and pagination */
}

.paginationn .btn {
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

.paginationn .btn:hover {
    background-color: #1a0cbf; /* Darker color on hover */
    transform: translateY(-2px); /* Lift effect on hover */
}

.paginationn .btn.btn-back {
    background-color: #f39c12; /* Different color for Back to Home */
}

.paginationn .btn.btn-back:hover {
    background-color: #e67e22; /* Darker color on hover for Back to Home */
}

.paginationn .pagination {
    display: flex;
    gap: 10px; /* Spacing between pagination links */
}

.paginationn .pagination li {
    list-style: none;
}

.paginationn .pagination a {
    text-decoration: none;
    color: #1f05e6; /* Link color */
    padding: 10px 15px; /* Padding for links */
    border: 1px solid #1f05e6; /* Border color */
    border-radius: 5px; /* Rounded corners */
    transition: background-color 0.3s ease, color 0.3s ease;
    display: inline-block; /* Makes the link behave like a button */
    font-weight: bold; /* Bold text */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

.paginationn .pagination a:hover {
    background-color: #1f05e6; /* Background on hover */
    color: white; /* Text color on hover */
}

.paginationn .pagination .active a {
    background-color: #1f05e6; /* Active page background */
    color: white; /* Active page text color */
    border: none; /* Remove border for active page */
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

            <!-- Pagination Links -->
            <div class="paginationn">
                {{ $quizQuestions->links() }}

                <!-- Display the submit button only on the last page -->
                @if ($quizQuestions->onLastPage())
                    <button type="Submit Answers" class="btn btn-orangee">Submit Answers</button>
                @endif
                <a href="{{ route('front.details',['course' => $course->slug]) }}" class="btn btn-orangee">Back to Home</a>
            </div>
        </form>
    </div>

    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
