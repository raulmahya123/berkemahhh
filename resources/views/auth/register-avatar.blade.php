<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Avatar</title>
    <link rel="icon" href="{{ asset('assets/logo/Logo White BG@2x.png') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @tailwind base;
        @tailwind components;
        @tailwind utilities;

        /* Apply Poppins font globally */
        body {
            font-family: 'Poppins', sans-serif;
        }

        @layer utilities {
            .bg-gradient-custom {
                background: linear-gradient(135deg, rgba(47, 69, 150, 1) 0%, rgba(77, 114, 249, 1) 100%);
            }
        }
    </style>
</head>

<body class="h-screen bg-gray-100 font-sans">
    <div class="grid grid-cols-1 md:grid-cols-2 h-full">
        <!-- Logo -->
        <img src="{{ asset('assets/logo/Logo White BG@2x.png') }}" alt="Logo" class="absolute top-4 left-4 w-20">

        <!-- Form Section -->
        <div class="flex items-center justify-center bg-white">
            <div class="w-full max-w-md p-6 bg-white rounded shadow-lg">
                <h2 class="text-4xl font-bold text-gray-800 text-center mb-6">Add Your Avatar</h2>
                <p class="text-center text-sm text-gray-600 mb-4">
                    Show us who's behind the keyboard! Pick your best pic to personalize your profile.
                </p>
                <form method="POST" action="{{ route('register.complete') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Drag or Upload Image Section -->
                    <div class="flex flex-col items-center justify-center border-2 border-dashed border-blue-500 rounded-lg p-6 bg-gray-50 hover:bg-gray-100 transition">
                        <!-- Image Preview -->
                        <img id="imagePreview" class="w-32 h-32 mb-4 object-cover rounded-full hidden" alt="Image Preview">
                        
                        <label for="avatar" class="cursor-pointer text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-blue-500 mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5V19a2 2 0 002 2h14a2 2 0 002-2v-2.5m-2-4.5l-4-4m0 0L7 12m4-4v12" />
                                </svg>
                                <span class="text-sm font-medium text-gray-600">Drag or Upload Image Here</span>
                            </div>
                        </label>
                        <input id="avatar" name="avatar" type="file" class="hidden" required accept="image/*" onchange="previewImage(event)">
                    </div>
                    <x-input-error :messages="$errors->get('avatar')" class="text-red-500 text-sm" />

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Create Account
                    </button>
                </form>
            </div>
        </div>

        <!-- Image Section -->
        <div class="hidden md:flex flex-col items-center justify-center bg-gradient-custom text-white text-center px-8 py-12 rounded-tl-3xl rounded-bl-3xl">
            <img src="{{ asset('assets/icon/undraw_avatar.png') }}" alt="Avatar Illustration" class="w-3/4 mb-6">
        </div>
    </div>

    <script>
        function previewImage(event) {
            const imagePreview = document.getElementById ('imagePreview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.src = '';
                imagePreview.classList.add('hidden');
            }
        }
    </script>
</body>

</html>
