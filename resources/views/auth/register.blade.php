<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="flex items-center justify-center min-h-screen bg-coffee-restaurant bg-cover">
        <form method="POST" action="{{ route('register') }}" class="w-full max-w-md p-8 bg-white rounded-lg shadow-md">
            @csrf
    
            <!-- Icon -->
            <div class="flex justify-center mb-6">
                <span class="block w-12 h-12 rounded-full" style="background-color: #eee;">
                 <img src="data:image/png;base64,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">
                </span>
            </div>
            
            <!-- Title -->
            <h2 class="mb-6 text-2xl font-bold text-center">Create an account</h2>
    
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="peer w-full h-full mt-1 form-input g-transparent text-blue-gray-700 font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 border-t-transparent focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900g-transparent text-blue-gray-700 font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 border-t-transparent focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
    
            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="peer w-full h-full mt-1 form-input g-transparent text-blue-gray-700 font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 border-t-transparent focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900g-transparent text-blue-gray-700 font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 border-t-transparent focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
    
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="peer w-full h-full mt-1 form-input g-transparent text-blue-gray-700 font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 border-t-transparent focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900g-transparent text-blue-gray-700 font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 border-t-transparent focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                <p class="text-xs mt-1">Must be at least 8 characters and contain one special character</p>
            </div>
    
            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="peer w-full h-full mt-1 form-input g-transparent text-blue-gray-700 font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 border-t-transparent focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900g-transparent text-blue-gray-700 font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 border-t-transparent focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
    
            <!-- Buttons -->
            <div class="flex items-center justify-between mt-6">
                <a class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
    
                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>

</body>    
</html>
