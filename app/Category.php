<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    /*protected $fillable =[
    	'id','name','created_at','updated_at'
    ];*/

    //
       /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';
    
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
}
