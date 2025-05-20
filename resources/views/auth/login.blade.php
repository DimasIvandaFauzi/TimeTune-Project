@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="flex-grow flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-lg bg-white rounded-2xl shadow-lg p-6 fade-in">
            <h2 class="text-3xl font-bold text-center text-white bg-blue-900 rounded-t-xl py-4 mb-6">Login</h2>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-4 bg-red-100 text-red-700 rounded-lg p-3 text-center">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email <i class="fas fa-envelope text-gray-400"></i></label>
                    <input type="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-gray-900 @error('email') border-red-500 @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @endif
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password <i class="fas fa-lock text-gray-400"></i></label>
                    <input type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-gray-900 @error('password') border-red-500 @enderror" id="password" name="password" required>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @endif
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" class="h-4 w-4 text-teal-500 focus:ring-teal-500 border-gray-300 rounded" id="remember" name="remember">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">Ingat Saya</label>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-200 btn-pulse disabled:bg-gray-400" onclick="this.disabled=true; this.form.submit();">
                    Login
                </button>

                <!-- Register Link -->
                <div class="text-center">
                    Belum punya akun? <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800">Daftar di sini</a>
                </div>
            </form>
        </div>
    </div>
@endsection