<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::where('is_active', true)->with('images', 'variants');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('coleccion')) {
            $query->where('collection', $request->input('coleccion'));
        }

        if ($request->filled('tipo')) {
            $query->where('type', $request->input('tipo'));
        }

        $products = $query->latest()->get();

        return view('shop.index', compact('products'));
    }

    public function show(Product $product): View
    {
        $product->load('images', 'variants');
        
        return view('shop.show', compact('product'));
    }
}
