<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    // STOCK IN
    public function stockIn(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string'
        ]);

        DB::transaction(function () use ($request) {

            $product = Product::findOrFail($request->product_id);

            $before = $product->stock;
            $after = $before + $request->quantity;

            $product->update([
                'stock' => $after
            ]);

            StockHistory::create([
                'product_id' => $product->id,
                'type' => 'IN',
                'quantity' => $request->quantity,
                'stock_before' => $before,
                'stock_after' => $after,
                'note' => $request->note
            ]);
        });

        return response()->json([
            'message' => 'Stock In success'
        ]);
    }

    // STOCK OUT
    public function stockOut(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string'
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return response()->json([
                'message' => 'Stock is not enough'
            ], 400);
        }

        DB::transaction(function () use ($request, $product) {

            $before = $product->stock;
            $after = $before - $request->quantity;

            $product->update([
                'stock' => $after
            ]);

            StockHistory::create([
                'product_id' => $product->id,
                'type' => 'OUT',
                'quantity' => $request->quantity,
                'stock_before' => $before,
                'stock_after' => $after,
                'note' => $request->note
            ]);
        });

        return response()->json([
            'message' => 'Stock Out success'
        ]);
    }

    // STOCK ADJUSTMENT
    public function stockAdjustment(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'stock' => 'required|integer|min:0',
            'note' => 'nullable|string'
        ]);

        DB::transaction(function () use ($request) {

            $product = Product::findOrFail($request->product_id);

            $before = $product->stock;
            $after = $request->stock;

            $product->update([
                'stock' => $after
            ]);

            StockHistory::create([
                'product_id' => $product->id,
                'type' => 'ADJUSTMENT',
                'quantity' => abs($after - $before),
                'stock_before' => $before,
                'stock_after' => $after,
                'note' => $request->note
            ]);
        });

        return response()->json([
            'message' => 'Stock adjusted successfully'
        ]);
    }

    // HISTORY
    public function history()
    {
        return response()->json([
            'data' => StockHistory::with('product')->latest()->get()
        ]);
    }
}