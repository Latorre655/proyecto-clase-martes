<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->paginate(10);
        return view('categories.index', ['categories' => $categories]);
    }

    public function create(){
        return view('categories.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:3|max:255',
            'descripcion' => 'nullable|max:500',
        ]);
        Category::create([
            'name' => $request->name,
            'descripcion' => $request->descripcion,
        ]);
        return redirect()->route('categories.index')->with('success', 'Categoría creada correctamente');
    }

    public function edit(Category $category){
        return view('categories.edit', ['category' => $category]);
    }

    public function update(Request $request, Category $category){
        $request->validate([
            'name' => 'required|min:3|max:255',
            'descripcion' => 'nullable|max:500',
        ]);
        $category->update([
            'name' => $request->name,
            'descripcion' => $request->descripcion,
        ]);
        return redirect()->route('categories.index')->with('success', 'Categoría actualizada');
    }

    public function destroy(Category $category){
        $category->products()->delete();
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Categoría eliminada');
    }
}