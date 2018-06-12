<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cyclephases extends Model
{
    //
       /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cyclephases';
    
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
}
