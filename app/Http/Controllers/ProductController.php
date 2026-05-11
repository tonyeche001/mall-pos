<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show all products
    public function index()
    {
        $products=Product::all();
        return view('pos.products', compact('products'));
    }
    // Store new product
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required',
             'category' =>'required',
              'price' =>'required|numeric',
               'stock' =>'required|integer',
        ]);
        Product::create($request->all());
        return redirect('/products')->with('success', 'Product added successfully!');
    }
    // update product
    public function update(Request $request, $id)
    {
     $request->validate([
            'name' =>'required',
             'category' =>'required',
              'price' =>'required|numeric',
               'stock' =>'required|integer',
        ]);
         $product = Product::findOrFail($id);
       $product->update($request->all());
        return redirect('/products')->with('success', 'product updated successfully!');
    }
    // Delete product
    public function destroy($id)
{
     $product = Product::findOrFail($id);
       $product->delete();
        return redirect('/products')->with('success', 'product deleted successfully!');   
    }
}
