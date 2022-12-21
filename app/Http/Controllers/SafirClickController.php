<?php

namespace App\Http\Controllers;

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
            
            if($titleNode->count()>0){ 
                // array_push($product,['title'=> $titleNode->text()]);
              
                $product['title']= $titleNode->text();
            }
            if($skuNode->count()>0) {
                $product['sku']=$skuNode->first()->text();
            }
            $product["images"]=$imagesNode->extract(['href']);            

            
            dd($product);
        return ;
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
