<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserAccount extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'password',
        'defaultpassword',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    // Using default 'id' as primary key (do NOT set useraccount_id anymore)

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function getAuthIdentifier()
    {
        return $this->getKey(); // Uses default 'id'
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
