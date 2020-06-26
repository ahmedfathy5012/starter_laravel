<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $table= "hospitals";
    protected  $fillable = ['name','title','country_id'];
    protected $hidden = [];

    public function doctors(){
        return $this->hasMany(Doctor::class,'hospital_id','id');
    }

}
