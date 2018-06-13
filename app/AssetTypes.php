<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetTypes extends Model
{
    //

        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'assettypes';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
}
