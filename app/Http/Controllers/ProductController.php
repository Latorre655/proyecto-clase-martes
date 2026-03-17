<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){

        $productlist = Product::paginate(9);





        return view("product.index", [
            "milista" => $productlist]);
    }

    public function create(){

        $categories = Category::all();

        return view("Product.create", ["myCategories" => $categories]);
    }

    public function store(Request $request){
        //Validaciones
        $request -> validate([
            'nombre' => 'required|min:5|max:255',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'categoria' => 'nullable',
            'imagen' => 'nullable|image|max:2048'
        ]);

        $newproduct = new Product();
        $newproduct -> name = $request -> get("nombre");
        $newproduct -> descripcion = $request -> get("descripcion");
        $newproduct -> price = $request -> get("precio");
        $newproduct -> category_id = $request -> get("Categoria");

        if ($request -> hasFile("imagen")){
            $ruta = $request -> file("imagen")->store("imagenes", "public");
            $newproduct -> image = $ruta;
        }else{
            $newproduct->image = "No hay ruta";
        }


        $newproduct -> save();

        return redirect()->route("product.index");
    }

    public function show($id){
        $product = Product::findOrFail($id);
        return view('product.show', compact('product'));
    }

    public function destroy(Product $product){
        $product->delete();
        return redirect()->route('product.index');
    }
}
