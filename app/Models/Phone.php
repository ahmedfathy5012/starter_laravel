<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table= "phones";
    protected  $fillable = ['code','phone','usser_id'];
    protected $hidden = [];



    ################### Begin Relations ##############################
    public  function user(){
        return $this->belongsTo('App\user');
    }
    ###################  End Relations  ##############################
}
