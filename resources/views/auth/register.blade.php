<x-guest-layout>
    <style>
        .form-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container div {
            margin-bottom: 1rem;
        }

        .form-container .input-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        .form-container .text-input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-container .error {
            color: red;
            margin-top: 0.5rem;
        }

        .form-container .primary-button {
            background-color: #FF6129;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .form-container .primary-button:hover {
            background-color: #e55d23;
        }
    </style>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="form-container">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="input-label" />
            <x-text-input id="name" class="text-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="error" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="input-label" />
            <x-text-input id="email" class="text-input" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="error" />
        </div>

        <!-- Occupation -->
       <!-- Occupation -->
       <div>
        <x-input-label for="occupation" :value="__('Occupation')" class="input-label" />
        <select id="occupation" name="occupation" class="text-input" required autocomplete="occupation" onchange="toggleCustomOccupation()">
            <option value="">Select Occupation</option>
            <option value="Developer" {{ old('occupation') == 'Developer' ? 'selected' : '' }}>Developer</option>
            <option value="Designer" {{ old('occupation') == 'Designer' ? 'selected' : '' }}>Designer</option>
            <option value="Manager" {{ old('occupation') == 'Manager' ? 'selected' : '' }}>Manager</option>
            <option value="Analyst" {{ old('occupation') == 'Analyst' ? 'selected' : '' }}>Analyst</option>
            <option value="Engineer" {{ old('occupation') == 'Engineer' ? 'selected' : '' }}>Engineer</option>
            <option value="Consultant" {{ old('occupation') == 'Consultant' ? 'selected' : '' }}>Consultant</option>
            <option value="Teacher" {{ old('occupation') == 'Teacher' ? 'selected' : '' }}>Teacher</option>
            <option value="Accountant" {{ old('occupation') == 'Accountant' ? 'selected' : '' }}>Accountant</option>
            <option value="Doctor" {{ old('occupation') == 'Doctor' ? 'selected' : '' }}>Doctor</option>
            <option value="Nurse" {{ old('occupation') == 'Nurse' ? 'selected' : '' }}>Nurse</option>
            <option value="Lawyer" {{ old('occupation') == 'Lawyer' ? 'selected' : '' }}>Lawyer</option>
            <option value="Marketing Specialist" {{ old('occupation') == 'Marketing Specialist' ? 'selected' : '' }}>Marketing Specialist</option>
            <option value="Sales Representative" {{ old('occupation') == 'Sales Representative' ? 'selected' : '' }}>Sales Representative</option>
            <!-- Add more options as needed -->
            <option value="Other" {{ old('occupation') == 'Other' ? 'selected' : '' }}>Other</option>
        </select>
        <x-input-error :messages="$errors->get('occupation')" class="error" />

        <!-- Custom Occupation Input -->
        <div id="customOccupationInput" style="display: none; margin-top: 10px;">
            <x-input-label for="custom_occupation" :value="__('Custom Occupation')" class="input-label" />
            <input type="text" id="custom_occupation" name="custom_occupation" class="text-input" value="{{ old('custom_occupation') }}" placeholder="Enter your occupation">
            <x-input-error :messages="$errors->get('custom_occupation')" class="error" />
        </div>
    </div>

    <script>
        function toggleCustomOccupation() {
            const selectElement = document.getElementById('occupation');
            const customInputDiv = document.getElementById('customOccupationInput');

            if (selectElement.value === 'Other') {
                customInputDiv.style.display = 'block';
            } else {
                customInputDiv.style.display = 'none';
            }
        }
    </script>



        <!-- Avatar -->
        <div>
            <x-input-label for="avatar" :value="__('Avatar')" class="input-label" />
            <x-text-input id="avatar" class="text-input" type="file" name="avatar" required autocomplete="avatar" />
            <x-input-error :messages="$errors->get('avatar')" class="error" />
        </div>

        <!-- Password -->
<div>
    <x-input-label for="password" :value="__('Password')" class="input-label" />
    <x-text-input id="password" class="text-input" type="password" name="password" required minlength="8" autocomplete="new-password" oninput="checkPasswordStrength()" />
    <x-input-error :messages="$errors->get('password')" class="error" />

    <!-- Password Strength Message -->
    <div id="password-strength" class="password-strength" style="margin-top: 5px; font-size: 14px; color: #777;"></div>
</div>

<!-- Confirm Password -->
<div>
    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="input-label" />
    <x-text-input id="password_confirmation" class="text-input" type="password" name="password_confirmation" required autocomplete="new-password" />
    <x-input-error :messages="$errors->get('password_confirmation')" class="error" />
</div>

<script>
    function checkPasswordStrength() {
        const password = document.getElementById('password').value;
        const strengthDisplay = document.getElementById('password-strength');
        let strength = 'LEMAH';
        let color = 'red';

        // Check password strength
        if (password.length >= 8) {
            if (/[a-z]/.test(password) && /[A-Z]/.test(password) && /[0-9]/.test(password) && /[^a-zA-Z0-9]/.test(password)) {
                strength = 'SANGAT KUAT';
                color = 'green';
            } else if (/[a-zA-Z]/.test(password) && /[0-9]/.test(password) && /[^a-zA-Z0-9]/.test(password)) {
                strength = 'KUAT';
                color = 'green';
            } else if (/[a-zA-Z]/.test(password) && /[0-9]/.test(password)) {
                strength = 'SEDANG';
                color = 'orange';
            }
        }

        // Display the password strength
        strengthDisplay.textContent = `Password Strength: ${strength}`;
        strengthDisplay.style.color = color;
    }
</script>


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="primary-button ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
