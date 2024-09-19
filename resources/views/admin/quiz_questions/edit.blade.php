<x-app-layout>
    <div class="container mx-auto p-8 bg-gray-100 rounded-lg shadow-lg" style="max-width: 800px;">
        <h1 class="text-center text-2xl mb-8">Edit Quiz Question</h1>
        <form action="{{ route('admin.quiz_questions.update', $quizQuestion->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-6">
                <label for="course_id" class="font-bold">Course</label>
                <select name="course_id" id="course_id" class="form-control w-full p-2 rounded-md" required>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ $quizQuestion->course_id == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-6">
                <label for="question" class="font-bold">Question</label>
                <textarea name="question" id="question" class="form-control w-full p-2 rounded-md h-28" required>{{ old('question', $quizQuestion->question) }}</textarea>
            </div>

            <div class="form-group mb-6">
                <label for="options" class="font-bold">Options (JSON)</label>
                @php
                    // Decode the JSON and encode it again with pretty print for readability
                    $options = json_decode($quizQuestion->options, true);
                    $formattedOptions = json_encode($options, JSON_PRETTY_PRINT);
                @endphp
                <textarea name="options" id="options" class="form-control w-full p-2 rounded-md h-28" required>{{ old('options', $formattedOptions) }}</textarea>
                <small class="text-gray-600">Enter options as a JSON object. For example: { "A": "Harper Lee", "B": "Mark Twain", "C": "Ernest Hemingway", "D": "J.K. Rowling" }</small>
            </div>

            <div class="form-group mb-6">
                <label for="correct_answer" class="font-bold">Correct Answer</label>
                <input type="text" name="correct_answer" id="correct_answer" class="form-control w-full p-2 rounded-md" value="{{ old('correct_answer', $quizQuestion->correct_answer) }}" required>
            </div>

            <button type="submit" class="btn w-full py-3 text-lg bg-blue-500 hover:bg-blue-600 text-white font-bold rounded-md uppercase">
                Update
            </button>
        </form>
    </div>
</x-app-layout>
