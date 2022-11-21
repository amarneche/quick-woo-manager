<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable=['url', 'name','consumer_key','consumer_secret'];


    public function orders(){
        return $this->hasMany(Order::class);
    }
}
