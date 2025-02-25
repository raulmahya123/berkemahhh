<x-app-layout>
    <div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Create Coupon</h1>

        <form action="{{ route('admin.coupon.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="code" class="block text-gray-700 font-medium">Coupon Code</label>
                <input type="text" name="code" id="code" required
                    class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                Create
            </button>
        </form>

        @if(session('success'))
            <div class="mt-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
    </div>
</x-app-layout>
