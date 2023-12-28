<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $appends = ['actual_discount'];
    protected $guarded = [];
    
    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function allChildren()
    {
        return $this->children()->with('items','allChildren');
    }
    public function getActualDiscountAttribute()
    {
        return $this->discount_percentage ?? $this->parent->actual_discount;
    }
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
