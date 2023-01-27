<?php
namespace App\Services;

use App\Models\Product;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class RadaarScheduler{

    private $webhook="";
    private $data=[];
    private $type="POST";
    private $title="";
    private $caption="";
    private $medias=[];
    private $variables=[];
    private $publishAt="";

    public function __construct(Product $product=null){
        $this->webhook=env('RADAAR_HOOK');
        $this->publishAt= Carbon::now()->addMinutes(5)->format('Y-m-d h:m:s');
        if(!is_null($product)){
            $this->setCaption($product->description);
            $this->setTitle($product->title);
            $this->setVariables([
                "product_sku"=>$product->sku,
                "url"=>route('client.products.show',$product),
                "product_price"=>$product->getChoosenPrice()." DZD",           
    
            ]);
            $this->addMedia($product->getFirstMediaUrl('featured'));
        }
        return $this;
    }

    
    public function prepareData(){
        $this->data = [
            "type"=>$this->type,
            "title"=>$this->title,
            "caption"=>$this->caption,
            "medias"=>$this->medias,
            "variables"=>$this->variables,
            "publish_at"=>$this->publishAt,
            "services"=> [
                "PUBLISHING_SCHEDULER",
                "PUBLISHING_POOL"
              ]
            ];
        return $this;
    }
    public function send(){

        $this->prepareData();
        
        $res=   Http::post($this->webhook,$this->data);
        $response = json_decode($res->getBody()->getContents());
        return  $response->status==true ? true : $response->message;
    }


    /**
     * Set the value of variables
     *
     * @return  self
     */ 
    public function setVariables($variables)
    {
        $this->variables = $variables;

        return $this;
    }

    /**
     * Set the value of medias
     *
     * @return  self
     */ 
    public function setMedias($medias)
    {
        $this->medias = $medias;

        return $this;
    }
    public function addMedia($url ,$type="IMAGE"){
        $this->medias[] = ["url"=>$url, "type"=>$type];
        return $this;
    }

    /**
     * Set the value of caption
     *
     * @return  self
     */ 
    public function setCaption($caption)
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Set the value of webhook
     *
     * @return  self
     */ 
    public function setWebhook($webhook)
    {
        $this->webhook = $webhook;

        return $this;
    }

    /**
     * Set the value of publishAt
     *
     * @return  self
     */ 
    public function setPublishAt($publishAt)
    {
        $this->publishAt = $publishAt;

        return $this;
    }
}