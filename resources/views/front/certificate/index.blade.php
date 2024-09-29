<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Certificates List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <table class="table-auto w-full bg-gray-100 border border-gray-200 rounded-lg">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2 border-b text-center">Certificate Code</th>
                            <th class="px-4 py-2 border-b text-center">Course</th>
                            <th class="px-4 py-2 border-b text-center">User</th>
                            <th class="px-4 py-2 border-b text-center">Issued Date</th>
                            <th class="px-4 py-2 border-b text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($certificates as $certificate)
                            <tr class="hover:bg-gray-50">
                                <td class="border px-4 py-2 text-center">{{ $certificate->certificate_code }}</td>
                                <td class="border px-4 py-2 text-center">{{ $certificate->course->name }}</td>
                                <td class="border px-4 py-2 text-center">{{ $certificate->user->name }}</td>
                                <td class="border px-4 py-2 text-center">{{ $certificate->issued_date }}</td>
                                <td class="border px-4 py-2 text-center">
                                    <a href="{{ route('front.certificate.show', $certificate->certificate_code) }}"
                                        class="text-blue-500 hover:underline">View</a>

                                    <a href="{{ route('front.certificate.edit', $certificate->id) }}"
                                        class="text-blue-500 hover:underline ml-4">Edit</a>
                                    <form action="{{ route('front.certificate.destroy', $certificate->id) }}"
                                        method="POST" style="display:inline-block;">
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

        .table-auto th,
        .table-auto td {
            padding: 12px;
            text-align: left;
            vertical-align: middle;
        }

        .table-auto th {
            background-color: #f3f4f6;
            font-weight: bold;
            text-align: center;
        }

        .table-auto td {
            text-align: center;
        }

        .table-auto tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .table-auto tr:hover {
            background-color: #f1f5f9;
        }

        .max-w-7xl {
            display: flex;
            justify-content: center;
        }

        h2 {
            text-align: center;
        }
    </style>
</x-app-layout>
