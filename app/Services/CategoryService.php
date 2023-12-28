<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CategoryService
{
    public function getCategories()
    {
        return Category::whereUserId(\Auth::id())->whereNull('parent_id')->with('items','allChildren')->first();
    }

    public function addCategory($name, $parent_id, $desc=null, $discount_percentage = null)
    {
        $parent = Category::find($parent_id);
        if ($parent->user_id != \Auth::id())
            throw new UnauthorizedException('UnAuthorized',403);
        if ($parent->items()->exists())
            throw new BadRequestException('This category has items');
        if ($parent->level > 3)
            throw new BadRequestException('Can\'t add more categories');

        return Category::create([
            'name' => $name,
            'description' => $desc,
            'parent_id' => $parent_id,
            'user_id' => \Auth::id(),
            'level' => $parent->level + 1,
            'discount_percentage' => $discount_percentage
        ]);
    }

    public function updateCategory($id, $updatedData)
    {
        $category = Category::find($id);
        if ($category->user_id != \Auth::id())
            throw new UnauthorizedException('UnAuthorized',403);
        return $category->update($updatedData);
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        if ($category->user_id != \Auth::id())
            throw new UnauthorizedException('UnAuthorized',403);
        return $category->delete();
    }
}
