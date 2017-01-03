<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Item extends Model
{
	use CrudTrait;

     /*
	|--------------------------------------------------------------------------
	| GLOBAL VARIABLES
	|--------------------------------------------------------------------------
	*/

	protected $table = 'items';
	protected $primaryKey = 'id';
	// public $timestamps = false;
	// protected $guarded = ['id'];
	protected $fillable = ['order_id', 'product_id', 'physical_status', 'status'];
	// protected $hidden = [];
    // protected $dates = [];

	/*
	|--------------------------------------------------------------------------
	| FUNCTIONS
	|--------------------------------------------------------------------------
	*/

	/*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

	public function product()
    {
        return $this->hasOne('App\Models\Product' , 'id');
    }



	/*
	|--------------------------------------------------------------------------
	| SCOPES
	|--------------------------------------------------------------------------
	*/

    public function scopeDelivered($query)
    {
        $matchThese = ['physical_status' => 'Delivered'];
        return $query->where($matchThese);
    }

	/*
	|--------------------------------------------------------------------------
	| ACCESORS
	|--------------------------------------------------------------------------
	*/

	/*
	|--------------------------------------------------------------------------
	| MUTATORS
	|--------------------------------------------------------------------------
	*/


	//If the item is assigned to any order, then change the status to assigned
	public function setOrderIdAttribute($value)
    {
    	//is the order_id set? 
        if (!empty($value))
            $this->attributes['status'] = 'Assigned';//if so, then change the status to assigned
        //otherwise
        else
        	$this->attributes['status'] = 'Available';//otherwise, it's available
        

        $this->attributes['order_id'] = $value;
    }


    //If the value is set to Delivered, then check if it's already assigned
    public function setPhysicalStatusAttribute($value)
    {
        $final_value = '';

    	if ($value == 'Delivered') //check if the item's Physical Status is Delivered
    	{
    		if ($this->attributes['status'] == 'Assigned') //check if the item's status is Assigned
    		{
                $final_value = $value;

    		}
    		elseif (!empty($this->physical_status)) //otherwise if the previous value is available
    		{
                $final_value = $this->physical_status;// set it to the previous value
    		}
    		else
    		{
                $final_value = 'To order'; // otherwise - set it to "To order"
    		}
    		
    	}
    	else //If it's not set to Delivered, then user is manipulating the data fine
    	{
    		$final_value = $value; //assign it
    	}

        $this->attributes['physical_status'] = $final_value; //then set it to the previous value - avoid setting it to Delivered

    }




}
