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
        <div class="mb-6 flex justify-end">
            <a href="{{ route('admin.quiz_questions.create') }}" class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                <i class="fas fa-plus-circle mr-2"></i> Add Question
            </a>
        </div>

        @foreach($quizQuestions->groupBy('course_id') as $courseId => $questions)
            <div class="mb-8">
                <!-- Display Quiz Name -->
                <h2 class="text-lg font-semibold mb-4 flex items-center text-gray-800">
                    <i class="fas fa-book mr-2 text-blue-600"></i>
                    {{ $questions->first()->course->name }} - Total Questions: {{ $questions->count() }}
                </h2>

                <!-- Quiz Questions Table -->
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-300 shadow-md rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
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
                            <tr class="hover:bg-gray-50 transition">
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $quizQuestion->id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $quizQuestion->question }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $quizQuestion->course->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    @if(is_array($quizQuestion->options))
                                        <ul class="list-disc pl-4 text-gray-700">
                                            @foreach($quizQuestion->options as $option)
                                                <li>{{ $option }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        {{ $quizQuestion->options }}
                                    @endif
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center font-semibold text-green-600">{{ $quizQuestion->correct_answer }}</td>
                                <td class="border border-gray-300 px-4 py-2 flex space-x-2">
                                    <a href="{{ route('admin.quiz_questions.show', $quizQuestion->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 transition">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.quiz_questions.edit', $quizQuestion->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 transition">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.quiz_questions.destroy', $quizQuestion->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach

        <!-- Courses Table -->
        <h2 class="text-xl font-semibold mt-8 text-gray-800">Courses</h2>
        <div class="overflow-x-auto mt-4">
            <table class="w-full border border-gray-300 shadow-md rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Course ID</th>
                        <th class="border border-gray-300 px-4 py-2">Course Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $course->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $course->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
