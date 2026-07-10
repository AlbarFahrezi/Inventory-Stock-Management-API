<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        return response()->json([
            'data' => Category::all()
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string'
        ]);


        $category = Category::create([
            'name'=>$request->name,
            'description'=>$request->description
        ]);


        return response()->json([
            'message'=>'Category created successfully',
            'data'=>$category
        ],201);
    }


    public function show(Category $category)
    {
        return response()->json([
            'data'=>$category
        ]);
    }


    public function update(Request $request, Category $category)
    {

        $request->validate([
            'name'=>'required|string',
            'description'=>'nullable|string'
        ]);


        $category->update([
            'name'=>$request->name,
            'description'=>$request->description
        ]);


        return response()->json([
            'message'=>'Category updated successfully',
            'data'=>$category
        ]);
    }


    public function destroy(Category $category)
    {

        $category->delete();


        return response()->json([
            'message'=>'Category deleted successfully'
        ]);

    }

}