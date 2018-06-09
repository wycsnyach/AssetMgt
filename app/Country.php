<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $fillable =[
    	'id','country_code','name','created_at','updated_at'
    	/*'id','country_code','name','created_at','updated_at'*/
    ];
}
