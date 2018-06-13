<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetSubTypes extends Model
{
    //
        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'assetsubtypes';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
}
