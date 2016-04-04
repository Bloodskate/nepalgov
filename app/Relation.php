<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    //
	 /**
     * The table associated with the model.
     */
    protected $table = 'relations';

    public function ministry()
    {
    	return $this->belongsTo('App\Ministry');
    }
}
