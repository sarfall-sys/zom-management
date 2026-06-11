<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
    public function userStats()
    {
        \Log::info('UserStats: Fetching user statistics');

        $this->authorize('view', User::class);

        $user = User::count();
        $recentUsers = User::where('created_at', '>=', now()->subMonth())->count();
        $roleManager = User::where('role_id', '2')->count();
        $roleStaff = User::where('role_id', '3')->count();

        \Log::info('UserStats: Users data', [
            'total' => $user,
            'managers' => $roleManager,
            'staff' => $roleStaff,
            'recent_users' => $recentUsers,
        ]);

        $stats = [
            'total_users' => $user,
            'managers' => $roleManager,
            'staff' => $roleStaff,
            'recent_users' => $recentUsers,
        ];

        return Response::json($stats);
    }

    public function productStats()
    {
        // Logic to gather product statistics
        \Log::info('ProductStats: Fetching product statistics');

        $this->authorize('view', User::class);

        $products = Product::count();
        $availableProducts = Product::where('is_active', 1)->count();
        $unavailableProducts = Product::where('is_active', 0)->count();
        $onSaleProducts = Product::where('is_on_sale', 1)->count();
        $unsale = Product::where('is_on_sale', 0)->count();

        \Log::info('ProductStats: Products data', [
            'total' => $products,
            'available' => $availableProducts,
            'unavailable' => $unavailableProducts,
            'sale' => $onSaleProducts,
            'unsale' => $unsale,
        ]);

        $stats = [
            'total_products' => $products,
            'available' => $availableProducts,
            'unavailable' => $unavailableProducts,
            'sale' => $onSaleProducts,
            'unsale' => $unsale,
        ];

        return Response::json($stats);
    }

    public function productsPerBrand()
    {
        $this->authorize('view', User::class);

        $brandCounts = Product::selectRaw('brands.name, COUNT(*) as total')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->groupBy( 'brands.name')
            ->get();

        \Log::info('ProductsPerBrand: Brand counts', $brandCounts->toArray());

        \Log::info('ProductsPerBrand: Response generated');

        return Response::json($brandCounts);
    }

    public function productsPerSubfamily()
    {
        $this->authorize('view', User::class);

        $product = Product::selectRaw('subfamilies.name, COUNT(*) as total')
        ->join('subfamilies','products.subfamily_id','=','subfamilies.id')
            ->groupBy('subfamilies.name')
            ->get();

        \Log::info('ProductsPerSubfamily: Subfamily counts', $product->toArray());

        return Response::json($product);
    }
}
