<?php

namespace App\Models;

use App\Traits\Sluggify;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Stancl\VirtualColumn\VirtualColumn;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;
use Spatie\Image\Manipulations;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Spatie\QueryBuilder\QueryBuilder;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use VirtualColumn;
    use Sluggify;
    use InteractsWithMedia;
    protected $guarded=[];
    public static $availability=['in stock','out of stock',];
    public static $condition=['new','used' , 'refurbished',];
    public static $age_groups=['adult','all ages','infant','kids','newborn','teen','toddler'];
    public static $gender=['male','female','unisex'];
    protected $casts =[
        'data->views'=>'integer',
    ];
    protected $appends= ['views'];

    public static function getCustomColumns(){
        return[
            "id",
            "sku",
            "title",
            "slug",
            "description",
            "availability",
            "condition",
            "brand",
            "price",
            "short_description",
            "product_description",
            "sale_price",
            "sale_price_effective_starts",
            "sale_price_effective_ends",
            "gender",
            "age_group",
            "shipping_weight",
            "material",
            "color",
            "size",
            // "data",
            "created_at",
            "updated_at",
                ];
    }

    public static function filter(){
        return QueryBuilder::for(Product::class)
                ->allowedFilters(['title','brand','sku'])   
                ->allowedIncludes(['categories'])             
                ->defaultSort('-created_at')
                ->allowedSorts(["data->views","created_at","price"])
                ->paginate(10);
            }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
             ->crop('crop-center', 150, 150);

        $this->addMediaConversion('product')
            ->crop('crop-center', 800, 800)
            ->quality(80);
        
        $this->addMediaConversion('preview')
            ->crop('crop-center', 300, 300)
            ->format('webp')
            ->quality(75);
    }

    public function incrementViews(){
        $this->update(['views'=>intval($this->views)+1]);
    }
    public static function generateSocialPostCSV(){
        $path="public/posts.csv";
        $writer= SimpleExcelWriter::create(Storage::path($path));
        $products = Product::inRandomOrder()->get()->each(function(Product $product)  use($writer)  {
            $writer->addRow([
                'date'=>Carbon::now()->addMinutes(rand(60,60*24*7))->format('Y-m-d h:m:s'),
                'type'=> "IMAGE",
                'title'=>$product->title,
                'caption'=>$product->description,
                'is_ready'=>"TRUE",
                'will_published_notify'=>"TRUE",
                'media_urls'=>$product->getFirstMediaUrl('featured')
            ]);
        });
        return $path;
    }
    public static function generateExcel(){
        $path="public/products.csv";
        $writer= SimpleExcelWriter::create(Storage::path($path));
        // $writer->addHeader(Schema::getColumnListing('products'));
        
        $products =Product::whereIn("data->exclude_catalog",["false",false,null])->get()->each(function(Product $product) use($writer){
        $writer->addRow([
            "id"=>$product->sku,
            "title"=>$product->title,
            "Name"=>Str::limit($product->title,64),
            "description"=>$product->description,
            "availability"=>$product->availability,
            "condition"=>$product->condition,
            "price"=>$product->price_formatted,
            "link"=>route('client.products.show', $product),
            "image_link"=>$product->getFirstMediaUrl('featured'),
            "brand"=>$product->brand,
            "sale_price"=>$product->sale_price_formatted,
            "gender"=>$product->gender,
            "age_group"=>$product->age_group,
            "material"=>$product->material,
            "google_product_category"=>$product->main_category_title,
        ]);
        });
        return $path;

    }
    public function getPriceFormattedAttribute(){
        return static::moneyFormat($this->price)." DZD";
    }
    public function getSalePriceFormattedAttribute(){
        return static::moneyFormat($this->sale_price)." DZD";
    }

    public static function moneyFormat( $money ){
        return number_format( $money,2,".","");
    }

    public function setDirection(){
       $direction =  preg_match("^[\p{Arabic}\s\p{N}]+$^",$this->title) 
        || preg_match("^[\p{Arabic}\s\p{N}]+$^",$this->description) 
        || preg_match("^[\p{Arabic}\s\p{N}]+$^",$this->short_description) ;
        
        $this->update(['direction'=>$direction]);

    }

    public function getExcerptAttribute(){ //
        return Str::words($this->short_description,20);
    }
    public function getTitleExcerptAttribute(){
        return Str::limit($this->title,50);
    }

    public function getChoosenPrice(){ 
        return min(array_filter([$this->price,$this->sale_price],fn ($item) => !is_null($item)));

    }
    public function categories(){ 
        return $this->belongsToMany(Category::class,"product_category");
    }
    public function relatedProducts(){

    }

    public function getFilteredShortDescriptionAttribute(){
         return filter_var($this->short_description,FILTER_SANITIZE_STRING);
    }

    public function getMainCategoryTitleAttribute(){
        if($this->categories->count() > 0){ 
            return $this->categories->first()->title;
        }
    }
    // public static function boot() {
    //     parent::boot();
    //     static::created(function($item){            
    //         $item->setDirection();
    //     });
    //     static::updated(function($item){
    //         $item->setDirection();
    //     });
    // }
}
