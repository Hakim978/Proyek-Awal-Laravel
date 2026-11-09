<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $summary = [
            'items' => Item::count(),
            'stock' => Item::sum('stock'),
            'low_stock' => Item::where('stock', '<=', 5)->count(),
            'categories' => Item::query()->distinct()->count('category'),
        ];
        $recentItems = Item::query()->latest()->limit(5)->get();

        return view('dashboard', compact('summary', 'recentItems'));
    }
}
