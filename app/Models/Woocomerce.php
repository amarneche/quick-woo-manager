<?php

namespace App\Models;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Js;

use function PHPSTORM_META\map;

class Woocomerce extends Model
{
    use HasFactory;
    private $c_key="ck_1b311833746bf16277be6b0e43e463259b4d506b";
    private $c_secret="cs_eba64243f4925414e01d3ef4d52ef1909555c1ac";
    private $url ="https://binastyle.com/wp-json/wc/v3/";

    public static function getAuth(){
       return Http::withBasicAuth("ck_1b311833746bf16277be6b0e43e463259b4d506b","cs_eba64243f4925414e01d3ef4d52ef1909555c1ac" )->baseUrl("https://binastyle.com/wp-json/wc/v3/");
    }
    public static function getOrders(){
        return static::getAuth()->get("/orders");
    }
    public static function getShippingZones(){
        return static::getAuth()->get("/shipping/zones");

    }
    public static function getShippingZoneLocations($zone){
        return static::getAuth()->get("/shipping/zones/{$zone}/locations");

    }
    public static function putShippingZoneLocations($zone ,$locations){
        $data = array();

        foreach($locations as $location){ //

            $location= $location >= 10 ? $location : "0".$location;

            array_push($data, array('code'=>"DZ:DZ-{$location}","type"=>"state"));
        }

        return static::getAuth()->put("/shipping/zones/{$zone}/locations",$data);

    }
    

    public static function createShippingZone($name){
        return static::getAuth()->post("/shipping/zones/",['name' => $name]);
    }

    public static function getShippingMethods(){
        return static::getAuth()->get("shipping_methods");
    }

    public static function dumpZones(){
        //Get JSON object . 
        echo("Starting !!! \n");
        echo("Getting File from remote channel... !!! \n");
        // $zones = Http::get("https://binastyle.com/wp-content/uploads/2022/12/csvjson.json")->collect();
        $jsonFile= file_get_contents(base_path('public/delivery.json'));
        $data = json_decode($jsonFile, true);
        $zones = collect($data);
        
        echo("Got it... !!! \n");
        
        foreach($zones as $key=> $zone){
            
            //create Zone . 
            
            $createdZone = Woocomerce::createShippingZone("Wilaya :{$key}")->collect();
            
            $zoneId = $createdZone['id'];
           
            // Assign Locations . 
            $locations = Woocomerce::putShippingZoneLocations($zoneId,[$key])->collect();
            
            // Assign Shipping methods ( Home or Stop desk )

            //Activate shipping method :Flat Rate.
            try {
                $flatRate= static::getAuth()->post("shipping/zones/{$zoneId}/methods" ,["method_id"=>"flat_rate"])->collect();
                
                $methodId= $flatRate['id'];
                
                if($flatRate["enabled"])
                  $flatRate=  static::getAuth()->put("shipping/zones/{$zoneId}/methods/{$methodId}" ,[ "settings"=>["title"=>"توصيل الى المنزل", "cost"=>$zone["home"] ]])->collect();
                
                // update cost  : 
    
                //Activate shipping method :Local Pickup.
                if($zone["stopDesk"]!=="/"){
                    $localPickup =static::getAuth()->post("shipping/zones/{$zoneId}/methods" ,["method_id"=>"local_pickup"])->collect();
                    $methodId= $localPickup['id'];
                    // dd($localPickup);
                    if($localPickup["enabled"])
                        static::getAuth()->put("shipping/zones/{$zoneId}/methods/{$methodId}" ,["settings"=>["title"=>"توصيل الى مكتب الشركة" , "cost"=>$zone["stopDesk"] ]])->collect() ;
    
                }
                
            }
            catch(\Exception $e) {

            }
            echo("# Created Wilaya number {$key} ... !!! \n");


        }
    }

    public static function addProduct(Product $product) {
        $images =array();
        foreach($product->getMedia('featured') as $media){
            array_push($images,['src'=>$media->getUrl()]);
        }
        foreach($product->getMedia('gallery') as $media){
            array_push($images,['src'=>$media->getUrl()]);
        }
        $productData= [
            'name'=>$product->title,
            'type'=>'simple',
            'status'=>'publish',
            "catalog_visibility"=> "visible",
            'regular_price'=>strval($product->price), 
            'sale_price'=>strval($product->sale_price),
            'description'=>$product->product_description,
            'short_description'=>$product->short_description,
            'sku'=>$product->sku,
            'images'=>$images,
        ];
        $response=    Woocomerce::getAuth()->post('products',$productData);
        return $response->getBody()->getContents();
        
       
    }
    public static function addRandomProduct(){
       return  Woocomerce::addProduct(Product::inRandomOrder()->first());
    }
}
