<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
