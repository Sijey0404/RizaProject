<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Register New User</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        @if(session('success'))
            <div class="bg-green-100 p-4 rounded mb-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('user.store') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            {{-- Username --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                @error('username')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                <p class="text-gray-500 text-xs mt-1">Leave empty to use the default password.</p>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Default Password (optional) --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Default Password (optional)</label>
                <input type="text" name="defaultpassword" value="changeme123" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                @error('defaultpassword')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Create User
            </button>
        </form>
    </div>
</x-app-layout>
