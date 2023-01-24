<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wilaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::inRandomOrder()->paginate(15);
        return view('client.products.index',compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        session()->flash('failure','This Page cannot be found');
        return redirect()->route('client.products.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        session()->flash('failure','This Page cannot be found');
        return redirect()->route('client.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        $product->incrementViews();
        $wilayas=Wilaya::all();
        return view('client.products.show', compact('product',"wilayas"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
        session()->flash('failure','This Page cannot be found');
        return redirect()->route('client.products.index');
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
        //
        session()->flash('failure','This Page cannot be found');
        return redirect()->route('client.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        session()->flash('failure','This Page cannot be found');
        return redirect()->route('client.products.index');
    }

    public function downloadCatalog(){
        return Storage::download(Product::generateExcel());
    }
    public function downloadPosts(){
        return Storage::download(Product::generateSocialPostCSV());
    }
}
