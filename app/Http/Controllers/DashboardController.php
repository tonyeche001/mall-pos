<?php

namespace App\Http\Controllers;

use App\Models\Product;

use App\Models\Sale;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalSalesToday = Sale::whereDate('created_at', today())
        ->sum('total_amount');
        $totalTransaction = Sale::whereDate('created_at', today())
        ->count();

        return view('pos.dashboard', compact('totalProducts', 'totalSalesToday', 'totalTransaction'));
    }
}
