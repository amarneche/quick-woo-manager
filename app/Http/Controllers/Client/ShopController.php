<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreOrderRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    //
    public function home(){

        $products=Product::inRandomOrder()->with('categories')->paginate(15);
        $categories=Category::withCount('products')->limit(6)->get();
        $bestProducts=Product::orderBy('data->views')->limit(9)->get();
        //will change it later.
        return view('client.home',compact('products','categories'));
    }
    public function shop(){

    }
    public function category(Category $category){
        $category->load('products');
        return view('client.categories.show',compact('category'));
    }

    public function quickOrder(StoreOrderRequest $request  ,Product $product ){
       
        $order= Order::create($request->validated());
        $order->items()->create([
            'product_id'=>$product->id,
            'qte'=>$request->product_qty,
            'price'=>$product->getChoosenPrice(),
            'product_title'=>$product->title,
            'sku'=>$product->sku,
        ]);
        return redirect()->route('client.thank-you',$order);
    }

    public function thankYou(Order $order){
        $order->load('items');
        return view('client.thank-you', compact('order'));
    }


}
