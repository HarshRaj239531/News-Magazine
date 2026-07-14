<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'link',
        'file_path',
        'icon_type',
        'is_highlighted',
        'sort_order',
        'status',
        'locale',
    ];
}
