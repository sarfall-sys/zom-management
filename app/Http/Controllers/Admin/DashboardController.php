<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
    public function userStats()
    {
        $user = User::count();

        $recentUsers = User::where('created_at', '>=', now()->subMonth())->count();
        $roleManager = User::where('role_id', '2')->count();
        $roleStaff = User::where('role_id', '3')->count();

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
        $products = \App\Models\Product::count();
        $availableProducts = \App\Models\Product::where('status', 1)->count();
        $unavailableProducts = \App\Models\Product::where('status', 0)->count();

        $stats = [
            'total_products' => $products,
            'available_products' => $availableProducts,
            'unavailable_products' => $unavailableProducts,
        ];

        return Response::json($stats);
    }
}
