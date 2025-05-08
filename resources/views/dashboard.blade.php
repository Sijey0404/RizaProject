<x-app-layout>
    <x-slot name="header">
        <div class="relative flex items-center justify-between w-full">
            <h2 class="font-semibold text-lg text-gray-800 z-10">Dashboard</h2>

            <div class="absolute left-1/2 transform -translate-x-1/2 z-0">
               
            </div>

            <form method="POST" action="{{ route('logout') }}" class="z-10">
                @csrf
               
            </form>
        </div>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        @if(session('success'))
            <div class="bg-green-100 p-4 rounded mb-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded px-8 py-6">
            <p class="text-gray-800">Welcome, {{ Auth::user()->username }}!</p>
        </div>
    </div>
</x-app-layout>
