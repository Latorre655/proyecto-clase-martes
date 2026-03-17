<?php
namespace App\Http\Controllers;
use App\Models\Product;

class HomeController extends Controller
{
    public function __invoke()
    {
        $products = Product::latest()->take(6)->get();
        return view('welcome', ['products' => $products]);
    }
}