<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CycleEvents extends Model
{
    //

      //
       /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lifecycleevents';
    
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
}
