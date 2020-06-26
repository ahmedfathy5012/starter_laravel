<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table= "countries";
    protected  $fillable = ['name'];
    protected $hidden = [];

    public function doctors(){
        return $this->hasManyThrough(Doctor::class,Hospital::class,'country_id','hospital_id');
    }

    public function hospitals(){
      return$this->hasMany(Hospital::class,'country_id','id');
    }
}
