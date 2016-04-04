<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Ministry extends Model
{
     //




    
    /**
     * Relations
     * 
     */
    /**
     * This is relaion between the relations table and the model 
     * Didnpt plan to make it, but may be helpful
     */
    public function relations()
    {
    	return $this->hasMany('App\Relation', 'parent_id');
    }
    /**
     * many to many relation between this model and  ..... ministry :P 
     * taking relations table as the pivot table
     */
    public function subMinistries()
    {
        return $this->belongsToMany('App\Ministry', 'relations',  'parent_id', 'ministry_id');
    }
    /** .....
    */
    public function parentMinistries()
    {
    	return $this->belongsToMany('App\Ministry', 'relations', 'ministry_id', 'parent_id');
    }
     /**
     * The table associated with the model.
     */
    protected $table = 'ministries';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'image_link', 'has_child', 'detail', 'phone', 'contact', 'function', 'nagarik_badapatra', 'website', 'facebook', 'twitter'];
}
