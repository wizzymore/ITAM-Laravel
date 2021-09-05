<?php

namespace App\Http\Controllers;

use App\Domain\Assets\Models\Asset;
use App\Domain\Assets\Models\Product;
use App\Domain\Employees\Models\Employee;
use App\Domain\Users\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $assets = Asset::count();
        $employees = Employee::count();
        $products = Product::count();
        $users = User::count();

        return view('dashboard', [
            'assets' => $assets,
            'employees' => $employees,
            'products' => $products,
            'staff' => $users
        ]);
    }
}
