@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="flex-grow flex items-center justify-center py-6 px-4 sm:py-8 sm:px-6">
        <div class="w-full max-w-md sm:max-w-lg bg-white rounded-2xl shadow-lg p-4 sm:p-6 fade-in">
            <h2 class="text-2xl sm:text-3xl font-bold text-center text-white bg-blue-900 rounded-t-xl py-3 sm:py-4 mb-4 sm:mb-6">Daftar Akun Baru</h2>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-3 sm:mb-4 bg-red-100 text-red-700 rounded-lg p-2 sm:p-3 text-center">
                    <ul class="list-disc list-inside text-sm sm:text-base">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Register Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-4 sm:space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-xs sm:text-sm font-medium text-gray-700">Nama Lengkap <i class="fas fa-user text-gray-400"></i></label>
                    <input type="text" class="w-full px-3 sm:px-4 py-2 sm:py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-gray-900 text-sm sm:text-base @error('name') border-red-500 @enderror" id="name" name="name" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                    @endif
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs sm:text-sm font-medium text-gray-700">Email <i class="fas fa-envelope text-gray-400"></i></label>
                    <input type="email" class="w-full px-3 sm:px-4 py-2 sm:py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-gray-900 text-sm sm:text-base @error('email') border-red-500 @enderror" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                    @endif
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-xs sm:text-sm font-medium text-gray-700">Password <i class="fas fa-lock text-gray-400"></i></label>
                    <input type="password" class="w-full px-3 sm:px-4 py-2 sm:py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-gray-900 text-sm sm:text-base @error('password') border-red-500 @enderror" id="password" name="password" required>
                    @error('password')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                    @endif
                </div>

                <!-- Password Confirmation -->
                <div>
                    <label for="password_confirmation" class="block text-xs sm:text-sm font-medium text-gray-700">Konfirmasi Password <i class="fas fa-lock text-gray-400"></i></label>
                    <input type="password" class="w-full px-3 sm:px-4 py-2 sm:py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-gray-900 text-sm sm:text-base @error('password_confirmation') border-red-500 @enderror" id="password_confirmation" name="password_confirmation" required>
                    @error('password_confirmation')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-200 btn-pulse disabled:bg-gray-400 text-sm sm:text-base" onclick="this.disabled=true; this.form.submit();">
                    Daftar
                </button>

                <!-- Login Link -->
                <div class="text-center text-xs sm:text-sm">
                    Sudah punya akun? <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800">Login di sini</a>
                </div>
            </form>
        </div>
    </div>
@endsection