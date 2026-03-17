<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class AdminController extends Controller
{
    public function __invoke()
    {
        return view('admin.index', [
            'totalProducts' => Product::count(),
            'totalCategories' => Category::count(),
        ]);
    }
}