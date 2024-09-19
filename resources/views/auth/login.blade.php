<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf

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
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="form-link forgot-password">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
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
        .login-form {
            background-color: #f9f9f9;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            max-width: 400px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
            transition: border-color 0.2s ease-in-out;
        }

        .form-input:focus {
            border-color: #5b8c5a;
            outline: none;
            box-shadow: 0 0 0 2px rgba(91,140,90,0.2);
        }

        .form-error {
            color: #e74c3c;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .form-checkbox-label {
            display: flex;
            align-items: center;
        }

        .form-checkbox {
            margin-right: 0.5rem;
            cursor: pointer;
        }

        .form-checkbox-text {
            color: #555;
            font-size: 0.875rem;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
        }

        .forgot-password {
            color: #007bff;
            text-decoration: none;
            font-size: 0.875rem;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .form-button {
            padding: 0.75rem 1.5rem;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .form-button:hover {
            background-color: #0056b3;
        }
    </style>
</x-guest-layout>
