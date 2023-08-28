<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Category::all();
        return response()->json([
          'data' => $items
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $item = Category::create($request->all());
        return response()->json([
          'data' => $item
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $item = Category::find($category);
        if ($item) {
            return response()->json([
              'data' => $item
            ], 200);
        } else {
            return response()->json([
              'message' => 'Not found',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $update = [
          'name' => $request->name
        ];
        $item = Category::where('id', $category->id)->update($update);
        if ($item) {
            return response()->json([
              'message' => 'Updated successfully',
            ], 200);
        } else {
            return response()->json([
              'message' => 'Not found',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $item = Category::where('id', $category->id)->delete();
        if ($item) {
            return response()->json([
              'message' => 'Deleted successfully',
            ], 200);
        } else {
            return response()->json([
              'message' => 'Not found',
            ], 404);
        }
    }
}
