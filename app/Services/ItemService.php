<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class ItemService
{
    public function addItem($name, $price, $category_id, $desc=null, $discount_percentage=null)
    {
        $category=Category::with('children')->find($category_id);
        if ($category->user_id != \Auth::id())
            throw new UnauthorizedException('UnAuthorized',403);
        if (isset($category->children) && count($category->children)>0)
            throw new BadRequestException('This category has subcategories');
        return Item::create([
            'name'=>$name,
            'description'=>$desc,
            'price'=>$price,
            'category_id'=>$category_id,
            'discount_percentage'=>$discount_percentage
        ]);
    }

    public function updateItem($id,$updatedData)
    {
        $item=Item::find($id);
        if ($item->category->user_id != \Auth::id())
            throw new UnauthorizedException('UnAuthorized',403);
       return $item->update($updatedData);
    }

    public function deleteItem($id)
    {
        $item=Item::find($id);
        if ($item->category->user_id != \Auth::id())
            throw new UnauthorizedException('UnAuthorized',403);
       return $item->delete();
    }
}
