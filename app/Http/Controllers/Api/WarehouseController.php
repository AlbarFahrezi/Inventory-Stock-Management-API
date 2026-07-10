<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{

    public function index()
    {
        return response()->json([
            'data' => Warehouse::all()
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'location'=>'nullable|string',
            'description'=>'nullable|string'
        ]);


        $warehouse = Warehouse::create([
            'name'=>$request->name,
            'location'=>$request->location,
            'description'=>$request->description
        ]);


        return response()->json([
            'message'=>'Warehouse created successfully',
            'data'=>$warehouse
        ],201);
    }


    public function show(Warehouse $warehouse)
    {
        return response()->json([
            'data'=>$warehouse
        ]);
    }


    public function update(Request $request, Warehouse $warehouse)
    {
        $warehouse->update([
            'name'=>$request->name,
            'location'=>$request->location,
            'description'=>$request->description
        ]);


        return response()->json([
            'message'=>'Warehouse updated successfully',
            'data'=>$warehouse
        ]);
    }


    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();


        return response()->json([
            'message'=>'Warehouse deleted successfully'
        ]);
    }

}