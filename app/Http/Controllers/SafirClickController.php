<?php

namespace App\Http\Controllers;

use App\Jobs\CrowlProduct;
use App\Models\Product;
use GuzzleHttp\Cookie\SetCookie;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class SafirClickController extends Controller
{
    public function show(){
        return view('admin.crowler.show');
    }

    public function crowl(Request $request){
        $products= explode("\r\n",$request->products);
        foreach($products as $product){
            CrowlProduct::dispatch($product);
        }
        session()->flash('success',__("Scheduled"));
        return redirect()->route("admin.products.index");


    }

}
