<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Categorie extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public function products(){
        return $this->hasMany(Product::class);
    }

}
