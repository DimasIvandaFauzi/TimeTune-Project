@extends('layouts.app')

@section('content')
<div class="relative w-full h-screen flex flex-col items-center justify-center text-center text-white" style="background: url('{{ asset('images/background.jpg') }}') no-repeat center center/cover;">
    <div class="bg-black bg-opacity-50 p-12 w-3/4 md:w-2/3 lg:w-1/2 rounded-lg">
        <h1 class="text-5xl font-bold mb-6">Welcome to TimeTune</h1>
        <p class="text-xl mb-8">TimeTune membantu Anda mengatur jadwal dengan mudah dan efisien.</p>
        
        <div class="space-x-10">
            <a href="{{ route('jadwal.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded text-lg">
                Tambah Jadwal
           
                <a href="{{ route('jadwal.list') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-4 px-4 rounded">
                    List Jadwal
                </a>  
        </div>
    </div>
</div>
@endsection
