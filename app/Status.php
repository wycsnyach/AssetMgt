<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //
    protected $fillable =[
    	'id','description','created_at','updated_at'
    ];
}
