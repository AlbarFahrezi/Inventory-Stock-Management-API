<?php

namespace App\Http\Controllers\Api;

use OpenApi\Attributes as OA;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Models\StockHistory;

#[OA\Tag(
    name: "Dashboard",
    description: "Dashboard Summary"
)]
class DashboardController extends Controller
{
    #[OA\Get(
        path: "/api/dashboard",
        summary: "Get Dashboard Summary",
        tags: ["Dashboard"],
        security: [["sanctum" => []]]
    )]
    #[OA\Response(
        response: 200,
        description: "Dashboard data retrieved successfully"
    )]
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