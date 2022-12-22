<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\DomCrawler\Crawler;

class CrowlProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $url;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Get and create the given product url 
        $product=Array();

        $productLink = $this->url;
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
