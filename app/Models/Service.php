<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table= "services";
    protected  $fillable = ['name'];
    protected $hidden = [];

    public function doctors(){
        return $this->belongsToMany(Doctor::class,'doctor_service','service_id','doctor_id','id','id');
    }

}
