<?php

namespace App\Models;

use App\Traits\Sluggify;
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
            "data",
            "created_at",
            "updated_at",
                ];
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
              ->width(125)
              ->height(125)
              ->sharpen(10);
        $this->addMediaConversion('product')
            ->width(800)
            ->height(800)
            ->quality(75);
        
        $this->addMediaConversion('preview')
              ->width(300)
              ->height(300)
              ->sharpen(10)              
              ->format(Manipulations::FORMAT_WEBP);
    }
    public static function generateExcel(){
        $path="public/products.xlsx";
        $writer= SimpleExcelWriter::create(Storage::path($path));
        // $writer->addHeader(Schema::getColumnListing('products'));
        $products =Product::all()->each(function(Product $product) use($writer){
        $writer->addRow([
            "id"=>$product->sku,
            "title"=>$product->title,
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
