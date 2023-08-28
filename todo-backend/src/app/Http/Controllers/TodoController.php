<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Category;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Todo::query();

        if ($request->has('content')) {
            $query->where('content', $request->input('content'));
        }

        if ($request->has('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        $todos = $query->get();

        return response()->json(['data' => $todos]);
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = Todo::create($request->all());
        return response()->json([
          'data' => $item
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        $item = Todo::find($todo);
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
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $update = [
          'content' => $request->content,
          
        ];
        $item = Todo::where('id', $todo->id)->update($update);
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
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $item = Todo::where('id', $todo->id)->delete();
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
