<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'designation',
        'category',
        'state',
        'district',
        'photo_path',
        'pdf_path',
        'contact_info',
        'locale',
    ];
}
