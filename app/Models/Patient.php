<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table= "patients";
    protected  $fillable = ['name','age'];
    protected $hidden = [];

    public function doctor(){
        return $this->hasOneThrough(Doctor::class,Medical::class,'patient_id','medical_id','id','id');
    }
}
