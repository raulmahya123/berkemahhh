<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMU5hZoYoA1vAOT4H5fD4rYtZtstM9xchURfJf7" crossorigin="anonymous">

    <x-slot name="header">
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-2xl font-semibold text-gray-900">Quiz Questions</h1>
            </div>
        </header>
    </x-slot>

    <div class="container mx-auto p-6">
        <!-- Create Question Button -->
        <div class="mb-4">
            <a href="{{ route('admin.quiz_questions.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Question</a>
        </div>

        @foreach($quizQuestions->groupBy('course_id') as $courseId => $questions)
            <div class="mb-8">
                <!-- Display Quiz Name -->
                <h2 class="text-lg font-semibold mb-4">
                    <i class="fas fa-book mr-2"></i> <!-- Ikon sebelum nama course -->
                    {{ $questions->first()->course->name }} - Total Questions: {{ $questions->count() }}
                </h2>

                <!-- Quiz Questions Table -->
                <table class="table-auto w-full mt-4 border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">ID</th>
                            <th class="border border-gray-300 px-4 py-2">Question</th>
                            <th class="border border-gray-300 px-4 py-2">Quiz</th>
                            <th class="border border-gray-300 px-4 py-2">Options</th>
                            <th class="border border-gray-300 px-4 py-2">Correct Answer</th>
                            <th class="border border-gray-300 px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $quizQuestion)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $quizQuestion->id }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $quizQuestion->question }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $quizQuestion->course->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                @if(is_array($quizQuestion->options))
                                    <ul class="list-disc pl-4">
                                        @foreach($quizQuestion->options as $option)
                                            <li>{{ $option }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    {{ $quizQuestion->options }}
                                @endif
                            </td>
                            <td class="border border-gray-300 px-4 py-2">{{ $quizQuestion->correct_answer }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="{{ route('admin.quiz_questions.show', $quizQuestion->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">View</a>
                                <a href="{{ route('admin.quiz_questions.edit', $quizQuestion->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Edit</a>
                                <form action="{{ route('admin.quiz_questions.destroy', $quizQuestion->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach

        <!-- Courses Table -->
        <h2 class="text-xl font-semibold mt-8">Courses</h2>
        <table class="table-auto w-full mt-4 border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">Course ID</th>
                    <th class="border border-gray-300 px-4 py-2">Course Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $course->id }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $course->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
