<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;

    const IS_LOGO = 0;
    const IS_COVER = 1;

    protected $fillable = [
        'name',
        'email',
        'telephone',
        'logo_url',
        'logo_path',
        'logo_disk',
        'website'
    ];

    public function covers(){
        return $this->hasMany(CompanyCover::class, 'company_id');
    }
}
