<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    /*protected $fillable =[
    	'id','country_code','name','created_at','updated_at'
    ];*/


    //
       /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'countries';
    
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
}
