<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticable
{
    protected $fillable = [
    'name',
    'email',
    'password',
    'role',
    'permissions',
    'department_id',
    ];

    use HasFactory;
    use Notifiable;

    public function detail(){
        return $this->hasOne(UserDetail::class);
    }


    public function department(){
        return $this->belongsTo(Department::class);
    }

}
