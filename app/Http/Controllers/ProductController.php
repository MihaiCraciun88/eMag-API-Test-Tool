<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(30);
    
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required',
            'ext_part_number'   => 'required',
            'part_number_key'   => 'required',
            'part_number'       => 'required',
            'currency'          => 'required',
            'sale_price'        => 'required',
            'original_price'    => 'required',
            'vat'               => 'required',
            'status'            => 'required',
            'mkt_id'            => 'required',
        ]);
    
        Product::create([
            'name'              => $request->name,
            'ext_part_number'   => $request->ext_part_number,
            'part_number_key'   => $request->part_number_key,
            'part_number'       => $request->part_number,
            'currency'          => $request->currency,
            'sale_price'        => $request->sale_price,
            'original_price'    => $request->original_price,
            'vat'               => $request->vat,
            'status'            => $request->status,
            'mkt_id'            => $request->mkt_id,
        ]);
     
        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        
        $request->validate([
            'name'              => 'required',
            'ext_part_number'   => 'required',
            'part_number_key'   => 'required',
            'part_number'       => 'required',
            'currency'          => 'required',
            'sale_price'        => 'required',
            'original_price'    => 'required',
            'vat'               => 'required',
            'status'            => 'required',
            'mkt_id'            => 'required',
        ]);

        $product->update([
            'name'              => $request->name,
            'ext_part_number'   => $request->ext_part_number,
            'part_number_key'   => $request->part_number_key,
            'part_number'       => $request->part_number,
            'currency'          => $request->currency,
            'sale_price'        => $request->sale_price,
            'original_price'    => $request->original_price,
            'vat'               => $request->vat,
            'status'            => $request->status,
            'mkt_id'            => $request->mkt_id,
        ]);
    
        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    
        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
