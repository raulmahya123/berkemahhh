<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="{{ asset('assets/logo/logo.png') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>

        <!-- Email Address -->
        <div class="form-group">
            <x-input-label for="email" :value="__('Email')" class="form-label" />
            <x-text-input id="email" class="form-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="form-error" />
        </div>

        <!-- Password -->
        <div class="form-group">
            <x-input-label for="password" :value="__('Password')" class="form-label" />

            <x-text-input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="form-error" />
        </div>

        <!-- Remember Me -->
        <div class="form-group">
            <label for="remember_me" class="form-checkbox-label">
                <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                <span class="form-checkbox-text">{{ __('Remember me') }}</span>
            </label>
        </div>
        {{-- create account --}}
        <div class="form-group text-center">
            <!-- Link to Create an Account -->
            <a href="{{ route('register') }}" class="form-link create-account">
                {{ __('Create an Account') }}
            </a>
        </div>

        <div class="form-actions text-center">
            <!-- Conditional Check for Password Reset Route -->
                <a href="/forgot/password" class="form-link forgot-password">
                    Forgot your password?
                </a>
        </div>

        <style>
            .form-group, .form-actions {
                margin: 20px 0;
            }

            .form-link {
                font-size: 16px;
                color: #0056b3;
                text-decoration: none;
                transition: color 0.2s ease-in-out;
            }

            .form-link:hover {
                color: #003d7a;
            }

            .create-account {
                display: inline-block;
                margin-bottom: 15px;
                font-weight: bold;
            }

            .forgot-password {
                display: inline-block;
                font-style: italic;
            }

            .text-center {
                text-align: center;
            }
        </style>


            <x-primary-button class="form-button">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <style>
        @tailwind base;
        @tailwind components;
        @tailwind utilities;

        /* Apply Poppins font globally */
        body {
            font-family: 'Poppins', sans-serif;
        }

    </style>
</head>

<body class="h-screen bg-gray-100 font-sans">
    <div class="grid grid-cols-1 md:grid-cols-2 h-full">
        <!-- Logo -->
        <img src="{{ asset('assets/logo/logo.png') }}" alt="Logo" class="absolute top-4 left-4 w-20">

        <!-- Form Section -->
        <div class="flex items-center justify-center bg-white">
            <div class="w-full max-w-md p-6 bg-white rounded shadow-lg">
                <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Welcome Back!</h2>
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" style="color: black;" />
                        <x-text-input id="email" class="w-full mt-1 px-4 py-2 border rounded-lg text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="text-red-500 text-sm mt-1" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" style="color: black;" />
                        <x-text-input id="password" class="w-full mt-1 px-4 py-2 border rounded-lg text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="text-red-500 text-sm mt-1" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                        <label for="remember_me" class="ml-2 text-sm text-gray-700">{{ __('Remember me') }}</label>
                    </div>

                    <!-- Forgot Password -->
                    @if (Route::has('password.request'))
                        <div class="text-right">
                            <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:underline">Forgot Password?</a>
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        {{ __('Log in') }}
                    </button>
                </form>

                <!-- Register Link -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">Don't have an account?
                        <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Sign Up</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Image Section -->
        <div
            class="hidden md:flex flex-col items-center justify-center bg-blue-500 text-white text-center px-8 py-12 rounded-tl-3xl rounded-bl-3xl">
            <img src="{{ asset('assets/icon/undraw_login.png') }}" alt="Illustration" class="w-3/4 mb-6">
        </div>
    </div>
</body>

</html>
