<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'UserAccount Management') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- If using Vite --}}
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen">

    @auth
        <!-- Global Navigation -->
        <nav class="flex items-center space-x-1 bg-gray-900 px-2 py-1 rounded-md m-4" aria-label="Main Navigation"> 
            <a href="{{ route('dashboard') }}" 
               class="bg-gray-800 text-white px-2 py-1 rounded text-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-white" 
               aria-current="{{ request()->routeIs('dashboard') ? 'page' : false }}">
                Dashboard
            </a>
            <a href="{{ route('profile') }}" 
               class="bg-gray-800 text-white px-2 py-1 rounded text-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-white" 
               aria-current="{{ request()->routeIs('profile') ? 'page' : false }}">
                Profile
            </a>
            <a href="{{ route('about') }}" 
               class="bg-gray-800 text-white px-2 py-1 rounded text-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-white" 
               aria-current="{{ request()->routeIs('about') ? 'page' : false }}">
                About Us
            </a>
            <a href="{{ route('contact') }}" 
               class="bg-gray-800 text-white px-2 py-1 rounded text-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-white" 
               aria-current="{{ request()->routeIs('contact') ? 'page' : false }}">
                Contact Us
            </a>
            <a href="{{ route('conditional') }}" 
               class="bg-gray-800 text-white px-2 py-1 rounded text-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-white" 
               aria-current="{{ request()->routeIs('conditional') ? 'page' : false }}">
                Conditional Statement
            </a>
            <a href="{{ route('student.list') }}" 
               class="bg-gray-800 text-white px-2 py-1 rounded text-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-white" 
               aria-current="{{ request()->routeIs('student.list') ? 'page' : false }}">
                Student List
            </a>
            <a href="{{ route('student.info') }}" 
               class="bg-gray-800 text-white px-2 py-1 rounded text-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-white" 
               aria-current="{{ request()->routeIs('student.info') ? 'page' : false }}">
                Student Info
            </a>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}" class="ml-auto">
                @csrf
                <button type="submit" 
                    class="bg-red-600 text-white px-2 py-1 rounded text-sm hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-white">
                    Logout
                </button>
            </form>
        </nav>

        <!-- Optional Header Section -->
        @if (isset($header))
            <header class="bg-white shadow mb-4">
                <div class="max-w-7xl mx-auto py-6 px-4">
                    {{ $header }}
                </div>
            </header>
        @endif
    @endauth

    <!-- Main Content Slot -->
    <main class="py-6 px-4 max-w-7xl mx-auto">
        {{ $slot }}
    </main>

</body>
</html>
