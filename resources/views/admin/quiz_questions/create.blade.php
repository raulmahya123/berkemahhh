<!-- resources/views/admin/quiz_questions/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-2xl font-semibold text-gray-900">Create Quiz Questions</h1>
            </div>
        </header>
    </x-slot>

    <div class="container mx-auto p-6">
        <form action="{{ route('admin.quiz_questions.store') }}" method="POST">
            @csrf
            <div class="form-group mb-4">
                <label for="course_id" class="block text-sm font-medium text-gray-700">Course</label>
                <select name="course_id" id="course_id" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>

            <div id="questions-container">
                <div class="form-group mb-4">
                    <label for="questions[0][question]" class="block text-sm font-medium text-gray-700">Question 1</label>
                    <textarea name="questions[0][question]" id="questions[0][question]" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required></textarea>
                </div>
                <div class="form-group mb-4">
                    <label for="questions[0][options]" class="block text-sm font-medium text-gray-700">Options (JSON)</label>
                    <textarea name="questions[0][options]" id="questions[0][options]" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                </div>
                <div class="form-group mb-4">
                    <label for="questions[0][correct_answer]" class="block text-sm font-medium text-gray-700">Correct Answer</label>
                    <input type="text" name="questions[0][correct_answer]" id="questions[0][correct_answer]" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                </div>
            </div>

            <div class="flex gap-4">
                <button type="button" id="add-question" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-gray-500 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Add Another Question
                </button>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Save
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('add-question').addEventListener('click', function() {
            let container = document.getElementById('questions-container');
            let index = container.children.length / 3; // Assuming each question has 3 fields

            let questionHTML = `
                <div class="form-group mb-4">
                    <label for="questions[${index}][question]" class="block text-sm font-medium text-gray-700">Question ${index + 1}</label>
                    <textarea name="questions[${index}][question]" id="questions[${index}][question]" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required></textarea>
                </div>
                <div class="form-group mb-4">
                    <label for="questions[${index}][options]" class="block text-sm font-medium text-gray-700">Options (JSON)</label>
                    <textarea name="questions[${index}][options]" id="questions[${index}][options]" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                </div>
                <div class="form-group mb-4">
                    <label for="questions[${index}][correct_answer]" class="block text-sm font-medium text-gray-700">Correct Answer</label>
                    <input type="text" name="questions[${index}][correct_answer]" id="questions[${index}][correct_answer]" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', questionHTML);
        });
    </script>
</x-app-layout>
