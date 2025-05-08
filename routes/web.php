    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\UserAccountController;
    use App\Http\Middleware\SessionUserAccountMW;
    use App\Http\Controllers\StudentController;

    Route::get('/', function () {
        return view('welcome');
    });

    // User account registration and login
    Route::get('/register', [UserAccountController::class, 'createForm'])->name('user.createForm');
    Route::post('/register', [UserAccountController::class, 'store'])->name('user.store');

    Route::get('/login', [UserAccountController::class, 'loginForm'])->name('login');
    Route::post('/login', [UserAccountController::class, 'login'])->name('user.login');

    // Protected routes (require session middleware)
    Route::middleware([SessionUserAccountMW::class])->group(function () {
        Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
        Route::get('/update-password', [UserAccountController::class, 'updatePasswordForm'])->name('user.updatePasswordForm');
        Route::post('/update-password', [UserAccountController::class, 'updatePassword'])->name('user.updatePassword');
        Route::post('/logout', [UserAccountController::class, 'logout'])->name('logout');

        // Navigation pages accessible after login
        Route::view('/profile', 'pages.profile')->name('profile');
        Route::view('/about', 'pages.about')->name('about');
        Route::view('/contact', 'pages.contact')->name('contact');
        Route::get('/conditional/{grade?}', function ($grade = null) {
            $equivalent = null;
        
            if ($grade !== null && is_numeric($grade)) {
                $grade = (int) $grade;
        
                if ($grade >= 97) $equivalent = "1.0";
                elseif ($grade >= 94) $equivalent = "1.25";
                elseif ($grade >= 91) $equivalent = "1.5";
                elseif ($grade >= 88) $equivalent = "1.75";
                elseif ($grade >= 85) $equivalent = "2.0";
                elseif ($grade >= 82) $equivalent = "2.25";
                elseif ($grade >= 79) $equivalent = "2.5";
                elseif ($grade >= 76) $equivalent = "2.75";
                elseif ($grade >= 75) $equivalent = "3.0";
                else $equivalent = "5.0";
            }
        
            return view('pages.conditional', compact('grade', 'equivalent'));
        })->name('conditional');
                Route::view('/student-list', 'pages.student-list')->name('student.list');
                
        Route::view('/student-info', 'pages.student-info')->name('student.info');
    });

    //contact
    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

//

    //student

    Route::middleware([SessionUserAccountMW::class])->group(function () {
        // ... other routes

        Route::get('/student-list', [StudentController::class, 'index'])->name('student.list');
        Route::get('/student-info', [StudentController::class, 'create'])->name('student.info');
        Route::post('/student-info', [StudentController::class, 'store'])->name('student.store');
        Route::resource('students', StudentController::class)->except(['show']); 
        // Route for displaying the list of students
        Route::get('/students', [StudentController::class, 'index'])->name('students.list');
        Route::resource('students', StudentController::class);
        Route::resource('students', App\Http\Controllers\StudentController::class);
        Route::resource('students', StudentController::class);
    // web.php
    Route::patch('/students/{id}/update-status', [StudentController::class, 'updateStatus'])->name('students.update-status');

    });

