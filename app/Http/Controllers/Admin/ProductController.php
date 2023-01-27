<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wilaya;
use App\Services\RadaarScheduler;
use App\Traits\MediaUploadingTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    use MediaUploadingTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands=Product::select('brand')->groupBy('brand')->get()->pluck('brand');
        $categories=Category::all();
        $products=Product::orderBy('created_at','desc')->paginate(10);
        return view('admin.products.index' ,compact('products','brands','categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories=Category::all();
        return view('admin.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        //
        // dd($request);
        $product =Product::create($request->validated());  
        if(Category::find($request->category))      
            $product->categories()->sync([$request->category]);

        if($request->has('gallery')){
           
            foreach($request->gallery as $imagePath){
               
                // $path =Storage::putFile('public',$image);
                $product->addMedia(Storage::path($imagePath))
                    ->toMediaCollection('gallery');
            }
        }
        if($request->has('featured')){
            $path=$request->featured;
            $product->addMedia(Storage::path($path))->toMediaCollection('featured');
        }
        session()->flash('success', 'Product Created Successfully');
        return redirect()->route('admin.products.index');
      
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
   
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories= Category::all();
        return view('admin.products.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
        if(!is_null($request->featured)){
            $product->clearMediaCollection('featured');
            $product->addMedia(Storage::path($request->featured))->toMediaCollection('featured');
        }
        if($request->has('gallery')){
           
            foreach($request->gallery as $imagePath){
               
                // $path =Storage::putFile('public',$image);
                $product->addMedia(Storage::path($imagePath))
                    ->toMediaCollection('gallery');
            }
        }
        $product->update($request->all());
        session()->flash('success', 'Product updated successfully');
        return redirect()->back();
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
        $product->delete();
        session()->flash('success', 'Product deleted successfully');
        return redirect()->route('admin.products.index');
    }

    public function schedule(Request $request, Product $product){
        
        $scheduler=new RadaarScheduler($product);
        $result =$scheduler->send(); 
        session()->flash('success',__("Posting : ".$result ));
        return redirect()->back();


    }
}
