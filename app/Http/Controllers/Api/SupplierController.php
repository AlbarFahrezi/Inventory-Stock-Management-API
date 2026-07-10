<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    public function index()
    {
        return response()->json([
            'data'=>Supplier::all()
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'phone'=>'nullable|string',
            'address'=>'nullable|string'
        ]);


        $supplier = Supplier::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'address'=>$request->address
        ]);


        return response()->json([
            'message'=>'Supplier created successfully',
            'data'=>$supplier
        ],201);
    }


    public function show(Supplier $supplier)
    {
        return response()->json([
            'data'=>$supplier
        ]);
    }


    public function update(Request $request, Supplier $supplier)
    {

        $supplier->update([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'address'=>$request->address
        ]);


        return response()->json([
            'message'=>'Supplier updated successfully',
            'data'=>$supplier
        ]);
    }


    public function destroy(Supplier $supplier)
    {

        $supplier->delete();

        return response()->json([
            'message'=>'Supplier deleted successfully'
        ]);

    }

}