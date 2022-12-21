<?php

namespace App\Http\Controllers;

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
        $product=Array();

        $productLink = $request->product;
        $client = new \GuzzleHttp\Client();
        $cookieJar = new \GuzzleHttp\Cookie\CookieJar();
        
        //login : 
        $response=  $this->login($client, $cookieJar);
        if($response->getStatusCode()==200){
            //fetch product
            $response = $client->get($productLink,['cookies'=>$cookieJar]);
            $xml = $response->getBody()->getContents();
            $crawler = new Crawler($xml);
            $titleNode =$crawler->filterXPath('//*[@id="et_prod_title"]/bdi/text()');
            $skuNode= $crawler->filter('.et-product-page__sku span');
            $imagesNode=$crawler->filter('a.cm-image-previewer');
            $price=$crawler->filter('span[id^="sec_discounted_price"]');
            $minProfit=$crawler->filter('.cp-default-profit-value bdi spa');
            $short_description=$crawler->filter('.ty-product-block__description');
            $description=$crawler->filter('#content_description');
            
            if($titleNode->count()>0){                               
                $product['title']= $titleNode->text();
            }
            if($skuNode->count()>0) {
                $product['sku']=$skuNode->first()->text();
            }
            if($price->count()>0) {
                $product['price']=$price->first()->text();
            }
            if($minProfit->count()>0) {
                $product['minProfit']=$minProfit->first()->text();
            }
            if($short_description->count()>0) {
                $product['short_description']= $short_description->first()->html();
            }
            if($description->count()>0) {
                $product['description']= $description->first()->html();
            }

            $product["images"]=$imagesNode->extract(['href']);   
            $createdProduct=null; 
            try{
                
            $createdProduct=Product::create($product);
            foreach($product['images'] as $key=>$image){
                
                if($key==0) 
                    $createdProduct->addMediaFromUrl($image)->toMediaCollection('featured');
                $createdProduct->addMediaFromUrl($image)->toMediaCollection('gallery');
            }

            }
            catch(\Exception $e){
                if (!is_null($createdProduct)) $createdProduct->delete();
            }
        session()->flash('success',__("Product Imported"));
        return redirect()->route("admin.products.index");
        }           
        else {
            session()->flash('error',"Can't login");
            return redirect()->back();
        }

    }
    private function login($client , $cookieJar){
       return  $client->post('https://pro.safir.click/index.php', [
            'form_params' => [
                'user_login' => env("SAFIR_USER"),
                'password' => env("SAFIR_PASSWORD"),
                // 'action' => 'login',
                'redirect_url'=>'https://pro.safir.click/index.php?dispatch=auth.login_form',
                'return_url'=>'https://pro.safir.click/index.php?dispatch=auth.login_form',
                'dispatch[auth.login]'=>''
            ],
            'headers'=>[
                'Content-Type'=>"application/x-www-form-urlencoded",
            ],
            'allow_redirects'=>[
                'strict'=>false,
            ],
            'cookies' => $cookieJar
        ]
        );
    }
}
