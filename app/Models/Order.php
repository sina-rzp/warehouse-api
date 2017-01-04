<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Order extends Model
{
	use CrudTrait;

     /*
	|--------------------------------------------------------------------------
	| GLOBAL VARIABLES
	|--------------------------------------------------------------------------
	*/

	protected $table = 'orders';
	protected $primaryKey = 'id';
	// public $timestamps = false;
	// protected $guarded = ['id'];
	protected $fillable = ['customer_name', 'address', 'status', 'order_date'];
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

	// Relation to the Item Model
	public function items()
    {
        return $this->hasMany('App\Models\Item', 'order_id');
    }

    // Relation to the Item Model, with delivered() scope applied
    public function itemsDelivered()
	{
	   return $this->hasMany('App\Models\Item')->delivered();

	}

	// Relation to the Product Model
	public function products()
    {
        return $this->hasManyThrough('App\Models\Item', 'App\Models\Prodcut');
    }

	/*
	|--------------------------------------------------------------------------
	| SCOPES
	|--------------------------------------------------------------------------
	*/

	// Function to create an Order
	public function scopeCreateOrder($query, $customer_name, $address)
    {
        return $this->create([
            'customer_name' => $customer_name, 
            'address' => $address, 
            'status' => 'In Progress', 
            'order_date' => date('Y-m-d')
            ]);
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


}
