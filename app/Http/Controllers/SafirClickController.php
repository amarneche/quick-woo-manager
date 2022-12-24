<?php

namespace App\Http\Controllers;

use App\Jobs\CrowlProduct;
use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Cookie\SetCookie;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class SafirClickController extends Controller
{
    public function show(){
        $categories = Category::all();
        return view('admin.crowler.show',compact('categories'));
    }

    public function crowl(Request $request){
        $products= explode("\r\n",$request->products);
        $margin=$request->margin;
        $category=$request->category;
        foreach($products as $product){
            CrowlProduct::dispatch($product,$margin,$category);
        }
        session()->flash('success',__("Scheduled"));
        return redirect()->route("admin.products.index");


    }

}
