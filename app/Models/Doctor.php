<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table= "doctors";
    protected  $fillable = ['name','title','hospital_id','medical_id','gender'];
    protected $hidden = [];


    public  function hospital(){
        return $this->belongsTo(Hospital::class,'hospital_id','id');
    }
    public function services(){
        return $this->belongsToMany(Service::class,'doctor_service','doctor_id','service_id','id','id');
    }

    public function patient(){
        return $this->hasOneThrough(Patient::class,Medical::class,'patient_id','medical_id');
    }

    // Accessors
    public function getGenderAttribute($val){
        return $val == 1 ? 'male' : 'female';
    }



}
