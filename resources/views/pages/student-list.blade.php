<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Student List</h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto px-4">
        <div class="bg-white p-6 rounded-lg shadow-md">
            @if($students->isEmpty())
                <p class="text-gray-500 text-center">No students found.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border border-gray-200 shadow-sm rounded-lg">
                        <thead class="bg-gray-100 text-gray-700 text-sm font-semibold uppercase">
                            <tr>
                                <th class="px-4 py-3 border-b">Student ID</th>
                                <th class="px-4 py-3 border-b">Name</th>
                                <th class="px-4 py-3 border-b">Age</th>
                                <th class="px-4 py-3 border-b">Course</th>
                                <th class="px-4 py-3 border-b">Image</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-800">
                            @foreach($students as $student)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 border-b">{{ $student->student_id }}</td>
                                    <td class="px-4 py-3 border-b">{{ $student->name }}</td>
                                    <td class="px-4 py-3 border-b">{{ $student->age }}</td>
                                    <td class="px-4 py-3 border-b">{{ $student->course }}</td>
                                    <td class="px-4 py-3 border-b">
                                        @if($student->image_path)
                                            <img src="{{ asset('storage/' . $student->image_path) }}" alt="Student Image" class="w-16 h-16 object-cover rounded-md">
                                        @else
                                            <span class="text-gray-400 italic">No image</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $students->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
