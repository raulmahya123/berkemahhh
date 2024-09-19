<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results for {{ $course->name }}</title>
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header>
            <h1>Quiz Results for {{ $course->name }}</h1>
        </header>

        <div class="results">
            <p><strong>Correct Answers:</strong> {{ $correctCount }}</p>
            <p><strong>Incorrect Answers:</strong> {{ $incorrectCount }}</p>

            <a href="{{ route('front.quiz', ['course' => $course->slug]) }}" class="btn">Take the Quiz Again</a>
            {{-- Back to Home --}}
            <a href="{{ route('front.details', ['course' => $course->slug]) }}" class="btn">Back to Home</a>

            {{-- Generate Certificate Button --}}
            @php
            $totalQuestions = $correctCount + $incorrectCount;
            $passingThreshold = $totalQuestions / 2;
            @endphp

            @if ($correctCount > $passingThreshold)
                {{-- Cek jika pengguna sudah generate sertifikat --}}
                @if (!$certificateGenerated) {{-- Variabel $certificateGenerated harus diset dari controller --}}
                    <form action="{{ route('front.generate_certificate') }}" method="POST">
                        @csrf
                        <input type="hidden" name="course_slug" value="{{ $course->slug }}">
                        <input type="hidden" name="user_name" value="{{ auth()->check() ? auth()->user()->name : '' }}">
                        <button type="submit" class="btn btn-primary">Generate Certificate</button>
                    </form>
                @else
                    <p class="alert alert-success">You have already generated your certificate for this course.</p>
                @endif
            @endif
        </div>
    </div>
</body>
</html>
