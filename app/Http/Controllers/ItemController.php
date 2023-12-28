<?php

namespace App\Http\Controllers;

use App\Services\ItemService;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    private ItemService $itemService;
    public function __construct(ItemService $itemService)
    {
       $this->$itemService=$itemService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'price' => 'required|integer',
            'category_id'=>'required|integer|exists:categories,id',
            'discount_percentage'=>'integer|nullable',
        ]);

        $this->itemService->addItem($data['name'],$data['price'],$data['category_id'],$data['description'],$data['discount_percentage']);
        return $this->response("Item added successfully");
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
            'price' => 'required|integer'
        ]);

        $this->itemService->updateItem($id,$data);
        return $this->response("Item updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->itemService->deleteItem($id);
        return $this->response("Item deleted successfully");
    }
}
