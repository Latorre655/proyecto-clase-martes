<?php
namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private function sessionId()
    {
        return session()->getId();
    }

    public function index()
    {
        $items = CartItem::with('product')
            ->where('session_id', $this->sessionId())
            ->get();
        $total = $items->sum(fn($i) => $i->product->price * $i->quantity);
        return view('cart.index', compact('items', 'total'));
    }

    public function add(Request $request)
    {
        $item = CartItem::where('session_id', $this->sessionId())
            ->where('product_id', $request->product_id)
            ->first();

        if ($item) {
            $item->increment('quantity');
        } else {
            CartItem::create([
                'session_id' => $this->sessionId(),
                'product_id' => $request->product_id,
                'quantity'   => 1,
            ]);
        }
        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    public function remove($id)
    {
        CartItem::where('id', $id)
            ->where('session_id', $this->sessionId())
            ->delete();
        return redirect()->route('cart.index')->with('success', 'Producto eliminado');
    }

    public function clear()
    {
        CartItem::where('session_id', $this->sessionId())->delete();
        return redirect()->route('cart.index')->with('success', 'Carrito vaciado');
    }
}