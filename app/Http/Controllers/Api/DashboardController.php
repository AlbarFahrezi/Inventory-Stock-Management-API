<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Models\StockHistory;


class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'total_products' => Product::count(),
                'total_categories' => Category::count(),
                'total_suppliers' => Supplier::count(),
                'total_warehouses' => Warehouse::count(),

                'total_stock' => Product::sum('stock'),

                'stock_in_today' => StockHistory::whereDate('created_at', today())
                    ->where('type', 'IN')
                    ->sum('quantity'),

                'stock_out_today' => StockHistory::whereDate('created_at', today())
                    ->where('type', 'OUT')
                    ->sum('quantity'),

                'stock_adjustment_today' => StockHistory::whereDate('created_at', today())
                    ->where('type', 'ADJUSTMENT')
                    ->count(),
            ]
        ]);
    }
}