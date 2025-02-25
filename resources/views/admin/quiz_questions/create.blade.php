<x-app-layout>
    <x-slot name="header">
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-2xl font-semibold text-gray-900">Create Quiz Questions</h1>
            </div>
        </header>
    </x-slot>

    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <form action="{{ route('admin.quiz_questions.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="course_id" class="block text-sm font-medium text-gray-700">Course</label>
                <select name="course_id" id="course_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>

            <div id="questions-container" class="space-y-6">
                <div class="question-group p-4 border border-gray-300 rounded-lg bg-gray-50">
                    <label class="block text-sm font-medium text-gray-700">Question 1</label>
                    <textarea name="questions[0][question]" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required></textarea>

                    <label class="block text-sm font-medium text-gray-700 mt-2">Options (JSON)</label>
                    <textarea name="questions[0][options]" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>

                    <label class="block text-sm font-medium text-gray-700 mt-2">Correct Answer</label>
                    <input type="text" name="questions[0][correct_answer]" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                </div>
            </div>

            <div class="flex gap-4">
                <button type="button" id="add-question" class="px-4 py-2 bg-gray-500 text-white rounded-md shadow-sm hover:bg-gray-600 focus:ring focus:ring-gray-500">Add Another Question</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md shadow-sm hover:bg-blue-600 focus:ring focus:ring-blue-500">Save</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('add-question').addEventListener('click', function() {
            let container = document.getElementById('questions-container');
            let index = container.children.length;

            let questionHTML = `
                <div class="question-group p-4 border border-gray-300 rounded-lg bg-gray-50">
                    <label class="block text-sm font-medium text-gray-700">Question ${index + 1}</label>
                    <textarea name="questions[${index}][question]" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required></textarea>

                    <label class="block text-sm font-medium text-gray-700 mt-2">Options (JSON)</label>
                    <textarea name="questions[${index}][options]" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>

                    <label class="block text-sm font-medium text-gray-700 mt-2">Correct Answer</label>
                    <input type="text" name="questions[${index}][correct_answer]" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', questionHTML);
        });
    </script>
</x-app-layout>
