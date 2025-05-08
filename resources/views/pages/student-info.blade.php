<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold text-gray-800">Student List</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto">
        <div class="bg-white p-6 shadow rounded">

            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Add Student Button --}}
            <button onclick="document.getElementById('addStudentModal').classList.remove('hidden')" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mb-4">
                + Add Student
            </button>

            {{-- Student Table --}}
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Age</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Course</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($students as $student)
                        <tr>
                            <td class="px-6 py-4">{{ $student->student_id }}</td>
                            <td class="px-6 py-4">{{ $student->name }}</td>
                            <td class="px-6 py-4">{{ $student->age }}</td>
                            <td class="px-6 py-4">{{ $student->course }}</td>
                            <td class="px-6 py-4">
                                @if($student->image_path)
                                    <img src="{{ asset('storage/' . $student->image_path) }}" class="w-12 h-12 object-cover rounded" alt="Student Image">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                {{-- Status Dropdown --}}
                                <form action="{{ route('students.update-status', $student->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH') <!-- This is important -->
                                    
                                    <select name="status">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                        <option value="suspended">Suspended</option>
                                    </select>
                                    
                                    <button type="submit">Update Status</button>
                                </form>
                                
                                
                            </td>
                            <td class="px-6 py-4 space-x-2">
                                <button onclick="document.getElementById('editStudentModal-{{ $student->id }}').classList.remove('hidden')" class="text-blue-600 hover:underline">Edit</button>
                                <button onclick="document.getElementById('deleteStudentModal-{{ $student->id }}').classList.remove('hidden')" class="text-red-600 hover:underline">Delete</button>
                            </td>
                        </tr>

                        {{-- Edit Modal --}}
                        <div id="editStudentModal-{{ $student->id }}" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex justify-center items-center hidden">
                            <div class="bg-white p-6 rounded shadow-md w-full max-w-lg relative">
                                <button onclick="document.getElementById('editStudentModal-{{ $student->id }}').classList.add('hidden')" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800">&times;</button>

                                <h3 class="text-lg font-semibold mb-4">Edit Student</h3>

                                <form action="{{ route('students.update', $student) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">Name</label>
                                        <input type="text" name="name" value="{{ $student->name }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">Age</label>
                                        <input type="number" name="age" value="{{ $student->age }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">Course</label>
                                        <input type="text" name="course" value="{{ $student->course }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" name="email" value="{{ $student->email }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">Image</label>
                                        <input type="file" name="image" class="mt-1 block w-full">
                                        @if($student->image_path)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $student->image_path) }}" class="w-24 h-24 object-cover rounded" alt="Current Image">
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex justify-end">
                                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Delete Confirmation Modal --}}
                        <div id="deleteStudentModal-{{ $student->id }}" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex justify-center items-center hidden">
                            <div class="bg-white p-6 rounded shadow-md w-full max-w-md relative">
                                <button onclick="document.getElementById('deleteStudentModal-{{ $student->id }}').classList.add('hidden')" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800">&times;</button>

                                <h3 class="text-lg font-semibold mb-4 text-red-600">Delete Confirmation</h3>
                                <p class="mb-4">Are you sure you want to delete <strong>{{ $student->name }}</strong>?</p>

                                <form action="{{ route('students.destroy', $student) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="flex justify-end space-x-2">
                                        <button type="button" onclick="document.getElementById('deleteStudentModal-{{ $student->id }}').classList.add('hidden')" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Cancel</button>
                                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Add Student Modal --}}
    <div id="addStudentModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
        <div class="bg-white p-6 rounded shadow-md w-full max-w-lg relative">
            <button onclick="document.getElementById('addStudentModal').classList.add('hidden')" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800">&times;</button>

            <h3 class="text-lg font-semibold mb-4">Add Student</h3>

            <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Age</label>
                    <input type="number" name="age" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Course</label>
                    <input type="text" name="course" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Image</label>
                    <input type="file" name="image" class="mt-1 block w-full">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
