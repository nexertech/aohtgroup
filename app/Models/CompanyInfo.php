<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use HasFactory;

    protected $table = 'company_info';

    protected $fillable = [
        'company_name',
        'tagline',
        'about',
        'about_image',
        'mission',
        'vision',
        'history',
        'logo',
        'phone',
        'email',
        'address',
    ];
}
