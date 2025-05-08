<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    // StudentController
    
    public function index()
    {
        $students = Student::paginate(3); // or any number per page
        return view('pages.student-list', compact('students'));
    }

    public function edit(Student $student)
    {
        $students = Student::all();
        return view('pages.student-info', compact('student', 'students'));
    }

    public function create()
    {
        $students = Student::all();
        return view('pages.student-info', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user_accounts,username',
            'age' => 'required|integer',
            'course' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $year = Carbon::now()->format('y');
        $studentCount = Student::whereYear('created_at', Carbon::now()->year)->count();
        $student_id = 'S-' . $year . '-' . ($studentCount + 1);
    
        $student = new Student();
        $student->student_id = $student_id;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->age = $request->age;
        $student->course = $request->course;
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('students', 'public');
            $student->image_path = $imagePath;
        }
    
        $student->save();
    
        // Create hashed default password
        $firstName = explode(' ', trim($request->name))[0];
        $defaultPassword = $student_id . $firstName;
        $hashedPassword = Hash::make($defaultPassword);
    
        // Create a user account with default 'student' role and 'active' status
        UserAccount::create([
            'username'         => $request->email,
            'password'         => $hashedPassword,
            'defaultpassword'  => $hashedPassword,
            'role'             => 'student',  // Default role for students
            'status'           => 'active',   // Default status for students
        ]);
    
        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'course' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($student->image_path && \Storage::disk('public')->exists($student->image_path)) {
                \Storage::disk('public')->delete($student->image_path);
            }

            // Upload new image
            $student->image_path = $request->file('image')->store('images', 'public');
        }

        $student->name = $request->name;
        $student->age = $request->age;
        $student->course = $request->course;
        $student->save();

        return redirect()->route('student.list')->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        // Delete associated image if exists
        if ($student->image_path && Storage::exists($student->image_path)) {
            Storage::delete($student->image_path);
        }

        // Delete the student
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }

    // Function to update user account status by admin
    public function updateStatus(Request $request, $id)
    {
        // Validate status: allow only active, inactive, or suspended
        $request->validate([
            'status' => 'required|in:active,inactive,suspended',
        ]);
    
        // Find the student
        $student = Student::findOrFail($id);
    
        // Find the related user account using the email
        $userAccount = UserAccount::where('username', $student->email)->firstOrFail();
    
        // Update the user's status
        $userAccount->status = $request->input('status');
        $userAccount->save();
    
        return redirect()->route('students.index')->with('success', 'Student account status updated successfully.');
    }
    
    

}
