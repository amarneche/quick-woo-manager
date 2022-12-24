<?php

namespace App\Models;

use App\Traits\Sluggify;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Stancl\VirtualColumn\VirtualColumn;

class Category extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use VirtualColumn;
    use Sluggify;
    protected $guarded= [];

    public function products(){
        return $this->belongsToMany(Product::class,'product_category');
    }

    public static function getCustomColumns(){
        return  ['id' , 'title' ,'description' ,'slug'];
    }

}
