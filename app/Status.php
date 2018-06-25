<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //
    protected $fillable =[
    	'id','name','created_at','updated_at'
    ];
}
