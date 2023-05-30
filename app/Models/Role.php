<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    // Additional code for Role model
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
