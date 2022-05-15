<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'company_id',
        'phone',
        'email',
        'profile_photo_url',
        'profile_photo_path',
        'profile_photo_disk',
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
