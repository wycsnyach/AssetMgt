<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    //
      protected $fillable =[
    	'id','name','created_at','updated_at'
    ];
}
