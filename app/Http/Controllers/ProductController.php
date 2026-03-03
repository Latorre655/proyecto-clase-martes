<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){

        $productlist = Product::all();



        return view("product.index", [
            "milista" => $productlist]);
    }

    public function create(){
        return view("Product.create");
    }

    public function show($id){
        return view('product.show');
    }
}
