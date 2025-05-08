<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    // app/Models/Student.php

    protected $fillable = ['student_id', 'name', 'age', 'course', 'image_path'];

    public function userAccount()
    {
        // Corrected relationship: Student.email → UserAccount.username
        return $this->hasOne(UserAccount::class, 'username', 'email');
    }
}
