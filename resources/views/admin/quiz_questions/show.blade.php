<x-app-layout>
    <div class="container quiz-details-container">
        <h1 class="quiz-title">Quiz Question Details</h1>

        <div class="form-group">
            <label class="form-label">Quiz:</label>
            @if($quizQuestion->quiz)
                <p>{{ $quizQuestion->quiz->name }}</p>
            @else
                <p><em>No associated quiz</em></p>
            @endif
        </div>

        <div class="form-group">
            <label class="form-label">Question:</label>
            <p>{{ $quizQuestion->question }}</p>
        </div>

        <div class="form-group">
            <label class="form-label">Options:</label>
            <p>{{ json_encode($quizQuestion->options) }}</p>
        </div>

        <div class="form-group">
            <label class="form-label">Correct Answer:</label>
            <p>{{ $quizQuestion->correct_answer }}</p>
        </div>

        <a href="{{ route('admin.quiz_questions.index') }}" class="btn btn-secondary quiz-back-btn">Back to List</a>
    </div>

    <style>
        .quiz-details-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .quiz-title {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .quiz-back-btn {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #6c757d;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-align: center;
            display: inline-block;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .quiz-back-btn:hover {
            background-color: #5a6268;
        }
    </style>
</x-app-layout>
