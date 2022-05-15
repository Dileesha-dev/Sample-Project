<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyCover extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'cover_url',
        'cover_path',
        'cover_disk',
    ];
}
