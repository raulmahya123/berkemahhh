{{-- resources/views/front/quiz.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz for {{ $course->name }}</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>
    <div class="container">
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
            <button type="submit" class="btn">Submit Answers</button>
            <a href="{{ route('front.details',['course' => $course->slug]) }}" class="btn">Back to Home</a>

        </form>
    </div>
</body>
</html>
