<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavigationMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'title_en',
        'title_hi',
        'type',
        'slug',
        'url',
        'directory_category',
        'content_en',
        'content_hi',
        'layout_type',
        'sort_order',
        'status',
    ];

    public function parent()
    {
        return $this->belongsTo(NavigationMenu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(NavigationMenu::class, 'parent_id')->orderBy('sort_order');
    }

    public function publishedChildren()
    {
        return $this->hasMany(NavigationMenu::class, 'parent_id')
            ->where('status', 'published')
            ->orderBy('sort_order');
    }
}
