<?php

namespace App\Http\Controllers;

use App\Domain\Assets\Models\Asset;
use App\Domain\Assets\Models\Product;
use App\Domain\Employees\Models\Employee;
use App\Domain\Users\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $assets = Cache::remember('dashboard.assets_count', now()->addMinutes(5), function () {
            return Asset::count();
        });
        $employees = Cache::remember('dashboard.employees_count', now()->addMinutes(5), function () {
            return Employee::count();
        });
        $products = Cache::remember('dashboard.products_count', now()->addMinutes(5), function () {
            return Product::count();
        });
        $users = Cache::remember('dashboard.users_count', now()->addMinutes(5), function () {
            return User::count();
        });

        return view('dashboard', [
            'assets' => $assets,
            'employees' => $employees,
            'products' => $products,
            'staff' => $users
        ]);
    }
}
