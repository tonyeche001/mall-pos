<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;

use Illuminate\Http\Request;

class SaleController extends Controller
{
    // Show POS page
    public function index()
    {
        $products = Product::all();
        return view('pos.sales', compact('products'));
    }
    // Process sale
    public function store(Request $request)
    {
        
        $cart = json_decode($request->cart, true);
        if (!$cart || count($cart) == 0) {
            return redirect()->back()->with('error', 'Cart is empty!');
        }
        $total= 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        $sale = Sale::create(['total_amount' => $total]);
        foreach ($cart as $item) {
            SaleItem::create([
                'sale_id'  => $sale->id,
                'product_id' => $item['id'],
                 'quantity' => $item['quantity'],
                  'price' => $item['price'],
            ]);
           
            // Reduce stock
            $product = Product::find($item['id']);
            $product->stock -= $item['quantity'];
            $product->save();
        }
        
        return redirect('/sales')->with('success', 'Sale completed successfully!');
    }
    
    public function history(Request $request) {
        $query = Sale::with('saleItems.product')->orderBy('created_at', 'desc');
        if ($request->month) {
            $query->whereMonth('created_at', $request->month);
        }
        if ($request->year) {
            $query->whereYear('created_at', $request->year);

        }
        $sales = $query->get();
        return view('pos.sales_history', compact('sales'));
    }
    public function receipt($id) {
        $sale= Sale::with('saleItems.product')->findOrFail($id);
        return view('pos.receipt', compact('sale'));
    }
}
