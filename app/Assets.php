<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    //

    //
        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'assets';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
}
