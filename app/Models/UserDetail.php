<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = [
        'user_id',
        'address',
        'zip_code',
        'city',
        'phone',
        'salary',
        'admission_date',
    ];

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
