<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
//use \Response;

class CategoryController extends Controller
{
    private CategoryService $categoryService;
    public function __construct(CategoryService $categoryService)
    {
       $this->categoryService=$categoryService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->response("success",$this->categoryService->getCategories());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string',
            'description'=>'string|nullable',
            'parent_id'=>'required|integer|exists:categories,id',
            'discount_percentage'=>'integer|nullable',
        ]);

        $this->categoryService->addCategory($data['name'],$data['parent_id'],$data['description'],$data['discount_percentage']);
        return $this->response("Category added successfully");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name'=>'required|string',
            'description'=>'string|nullable',
            'discount_percentage'=>'integer|nullable',
        ]);

        $this->categoryService->updateCategory($id,$data);
        return $this->response("Category updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->categoryService->deleteCategory($id);
        return $this->response("Category deleted successfully");
    }
}
