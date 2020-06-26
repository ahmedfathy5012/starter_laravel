<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table= "offers";
    protected  $fillable = ['name_en','name_ar','price','photo'];
    protected $hidden = [];

    // Mutators

    public function setNameEnAttribute($val){
        $this->attributes['name_en'] = strtoupper($val);
    }
}
