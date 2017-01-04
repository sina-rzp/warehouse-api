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

    // Relation to the Order Model
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

     // Relation to the Product Model
	public function product()
    {
        return $this->belongsTo('App\Models\Product' , 'id');
    }




	/*
	|--------------------------------------------------------------------------
	| SCOPES
	|--------------------------------------------------------------------------
	*/

    // Function to assign the condition - whether the item is delivered
    public function scopeDelivered($query)
    {
        $matchThese = ['physical_status' => 'Delivered'];
        return $query->where($matchThese);
    }

    // Function to assign the condition - whether the item is available
    public function scopeAvailable($query)
    {
        $matchThese = ['status' => 'Available'];
        return $query->where($matchThese);
    }

    // Function to create an Item
    public function scopeCreateItem($query, $product_id, $order_id)
    {
        $matchThese = ['status' => 'Available'];
        return $this->create(['order_id' => $order_id, 'product_id' => $product_id, 'physical_status' => 'To order', 'status' => 'Assigned']);
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

        //check if the item's Physical Status is Delivered
    	if ($value == 'Delivered') 
    	{
            //check if the item's status is Assigned
    		if ($this->attributes['status'] == 'Assigned') 
    		{
                $final_value = $value; // And go ahead and assign it to Delivered

    		}

            // Otherwise if the previous value is available
    		elseif (!empty($this->physical_status)) 
    		{
                $final_value = $this->physical_status;// Then set it to the previous value
    		}

            // otherwise - set it to "To order"
    		else
    		{
                $final_value = 'To order'; 
    		}
    		
    	}
        // If it's not set to Delivered, then the user is manipulating the data fine
    	else 
    	{
    		$final_value = $value; //assign the data
    	}

        //assign the value to the attribute
        $this->attributes['physical_status'] = $final_value; 

    }




}
