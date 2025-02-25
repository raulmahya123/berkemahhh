<x-app-layout>
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md mt-10">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Coupons</h1>
        <a href="{{ route('admin.coupon.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">Create Coupon</a>

        <table class="w-full mt-4 border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Coupon Code</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($coupons->isEmpty())
                    <tr>
                        <td colspan="3" class="border border-gray-300 px-4 py-2 text-center text-gray-600">No coupons found.</td>
                    </tr>
                @else
                    @foreach ($coupons as $coupon)
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2">{{ $coupon->id }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $coupon->code }}</td>
                            <td class="border border-gray-300 px-4 py-2 flex space-x-2">
                                <a href="{{ route('admin.coupon.show', $coupon->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">View</a>
                                <a href="{{ route('admin.coupon.edit', $coupon->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">Edit</a>
                                <form action="{{ route('admin.coupon.destroy', $coupon->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</x-app-layout>
