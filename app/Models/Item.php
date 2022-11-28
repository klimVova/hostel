<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $guarded= false;

    public function images(){
        return $this->hasMany(Image::class, 'item_id' , 'id');
    }


    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
