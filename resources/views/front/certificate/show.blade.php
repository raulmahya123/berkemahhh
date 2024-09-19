<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Certificate Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-6">
                    <p class="text-lg font-semibold"><strong>Certificate Code:</strong> {{ $certificate->certificate_code }}</p>
                    <p class="text-lg font-semibold"><strong>Course:</strong> {{ $certificate->course->name }}</p>
                    <p class="text-lg font-semibold"><strong>User:</strong> {{ $certificate->user->name }}</p>
                    <p class="text-lg font-semibold"><strong>Issued Date:</strong> {{ $certificate->issued_date }}</p>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('front.certificate.edit', $certificate->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Edit</a>
                    <a href="{{ route('front.certificate.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Back to List</a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-white {
            background-color: #ffffff;
        }

        .bg-blue-500 {
            background-color: #3b82f6;
        }

        .bg-gray-500 {
            background-color: #6b7280;
        }

        .text-white {
            color: #ffffff;
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .rounded {
            border-radius: 0.375rem;
        }

        .hover\:bg-blue-600:hover {
            background-color: #2563eb;
        }

        .hover\:bg-gray-600:hover {
            background-color: #4b5563;
        }

        .transition {
            transition: background-color 0.2s ease-in-out;
        }
    </style>
</x-app-layout>
