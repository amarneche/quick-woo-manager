<?php

namespace App\Models;

use App\Traits\Sluggify;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Stancl\VirtualColumn\VirtualColumn;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;
use Spatie\Image\Manipulations;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use VirtualColumn;
    use Sluggify;
    use InteractsWithMedia;
    protected $guarded=[];


    public static function getCustomColumns(){
        return[
            'id','title','sku','slug','description','price','sale_price','short_description',
        ];
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
              ->width(125)
              ->height(125)
              ->sharpen(10);
        $this->addMediaConversion('preview')
              ->width(300)
              ->height(300)
              ->sharpen(10)
              
              ->format(Manipulations::FORMAT_WEBP);
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
