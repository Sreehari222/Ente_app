<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'parent_id'];

    // Main category → sub categories
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Sub category → main category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
