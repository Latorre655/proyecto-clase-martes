<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class AdminController extends Controller
{
    public function __invoke()
    {
        return view('layouts.index', [
            'totalProducts' => Product::count(),
            'totalCategories' => Category::count(),
        ]);
    }
}