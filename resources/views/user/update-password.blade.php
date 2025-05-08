<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Update Password</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        @if ($errors->any())
            <div class="bg-red-100 p-4 rounded mb-4 text-red-700">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('user.updatePassword') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">New Password</label>
                <input type="password" name="new_password" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
            </div>

            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                Update Password
            </button>
        </form>
    </div>
</x-app-layout>
