<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Certificates List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <a href="{{ route('front.certificate.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">Create New Certificate</a>
                <table class="table-auto w-full bg-gray-100 border border-gray-200 rounded-lg">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2 border-b">Certificate Code</th>
                            <th class="px-4 py-2 border-b">Course</th>
                            <th class="px-4 py-2 border-b">User</th>
                            <th class="px-4 py-2 border-b">Issued Date</th>
                            <th class="px-4 py-2 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($certificates as $certificate)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2">{{ $certificate->certificate_code }}</td>
                            <td class="border px-4 py-2">{{ $certificate->course->name }}</td>
                            <td class="border px-4 py-2">{{ $certificate->user->name }}</td>
                            <td class="border px-4 py-2">{{ $certificate->issued_date }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('front.certificate.show', $certificate->certificate_code) }}" class="text-blue-500 hover:underline">View</a>

                                <a href="{{ route('front.certificate.edit', $certificate->id) }}" class="text-blue-500 hover:underline ml-4">Edit</a>
                                <form action="{{ route('front.certificate.destroy', $certificate->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline ml-4">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        .table-auto {
            border-collapse: collapse;
            width: 100%;
        }

        .table-auto th, .table-auto td {
            padding: 12px;
            text-align: left;
        }

        .table-auto th {
            background-color: #f3f4f6;
        }

        .table-auto tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .table-auto tr:hover {
            background-color: #f1f5f9;
        }
    </style>
</x-app-layout>
