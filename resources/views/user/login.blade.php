<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Login</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        @if($errors->has('login'))
            <div class="bg-red-100 p-4 rounded mb-4 text-red-700">
                {{ $errors->first('login') }}
            </div>
        @endif

        <form method="POST" action="{{ route('user.login') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                <input type="text" name="username" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Login
                </button>
                <a href="{{ route('user.createForm') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Register
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
