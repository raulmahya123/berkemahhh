<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Certificate') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('front.certificate.update', $certificate->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="certificate_code" class="block text-gray-700">Certificate Code</label>
                        <input type="text" name="certificate_code" id="certificate_code" class="form-input mt-1 block w-full" value="{{ $certificate->certificate_code }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="course_id" class="block text-gray-700">Course</label>
                        <select name="course_id" id="course_id" class="form-select mt-1 block w-full" required>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}" {{ $course->id == $certificate->course_id ? 'selected' : '' }}>{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="user_id" class="block text-gray-700">User</label>
                        <select name="user_id" id="user_id" class="form-select mt-1 block w-full" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id == $certificate->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="issued_date" class="block text-gray-700">Issued Date</label>
                        <input type="date" name="issued_date" id="issued_date" class="form-input mt-1 block w-full" value="{{ date('Y-m-d', strtotime($certificate->issued_date)) }}" required>

                    </div>
                    <div class="mb-4">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Certificate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
