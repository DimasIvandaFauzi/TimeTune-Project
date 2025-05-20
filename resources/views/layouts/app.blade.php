<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TimeTune - @yield('title', 'Dashboard')</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html {
            scroll-behavior: smooth;
        }
        body {
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .btn-pulse:hover {
            animation: pulse 1.5s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .icon-hover:hover {
            transform: rotate(360deg);
            transition: transform 0.5s ease;
        }
        .tooltip {
            position: relative;
        }
        .tooltip:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            top: 100%;
            right: 0;
            background: #1e3a8a;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 0.875rem;
            z-index: 10;
            white-space: nowrap;
        }
        .nav-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: #1e3a8a;
            border-radius: 0 0 6px 6px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 50;
            width: 200px;
        }
        .nav-menu.active {
            display: block;
        }
        .nav-item {
            padding: 0.75rem 1rem;
            color: white;
            text-align: right;
        }
        .nav-item:hover {
            background-color: #3b82f6;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col text-gray-800 bg-gradient-to-br from-blue-900 via-blue-700 to-blue-500">
    <!-- Navbar -->
    <nav class="bg-blue-900 shadow-lg p-4 sticky top-0 z-50">
        <div class="container mx-auto flex items-center justify-between relative">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/logo.png') }}" alt="TimeTune Logo" class="h-10 sm:h-12 w-auto transition-transform hover:scale-105">
                <span class="text-xl sm:text-2xl font-bold text-white">TimeTune</span>
            </div>
            <div class="flex items-center space-x-4">
                <button id="menu-toggle" class="sm:hidden text-white focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
                <div id="nav-menu" class="nav-menu">
                    @auth
                        <div class="nav-item tooltip bg-blue-600 text-white font-medium px-3 py-2 rounded-full text-xs shadow-md" data-tooltip="Email: {{ Auth::user()->email }}">
                            Login sebagai: {{ Auth::user()->name }}
                        </div>
                        <form action="{{ route('logout') }}" method="POST" class="nav-item">
                            @csrf
                            <button type="submit" class="w-full text-right bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-2 rounded-full transition-colors duration-200 btn-pulse text-sm">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="nav-item bg-teal-500 hover:bg-teal-600 text-white font-bold py-1 px-2 rounded-full transition-colors duration-200 btn-pulse text-sm">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const navMenu = document.getElementById('nav-menu');

        menuToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });

        // Close menu when clicking outside
        document.addEventListener('click', (event) => {
            if (!menuToggle.contains(event.target) && !navMenu.contains(event.target)) {
                navMenu.classList.remove('active');
            }
        });
    </script>
</body>
</html>