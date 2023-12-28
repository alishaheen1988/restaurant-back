<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $appends = ['actual_discount'];
    protected $guarded = [];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getActualDiscountAttribute()
    {
        return $this->discount_percentage ?? $this->category->actual_discount;
    }
}
