<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        
        
        // Validate the inpute
        $validation =$this->validate($request, [
            'order' => 'required',
            'order.customer' => 'required',
            'order.address' => 'required',
            'order.items' => 'required',
            'order.items.*.sku' => 'required',
            'order.items.*.quantity' => 'required',
            'order.items.*.colour' => 'required'
        ]);

        // Get all the input
        $input = $request->all();

        // Assign input
        $order = $input['order'];
        $customer_name = $order['customer'];
        $address = $order['address'];

        // Create an Order 
        $orderObject = Order::createOrder($customer_name, $address);
        $order_id = $orderObject->id;

        // Assign the items
        $items = $order['items'];

        $itemIDs = array(); // Get an array to save item IDs 


        // Loop through the items
        for ($i=0; $i < count($items) ; $i++) 
        {

            // Assign items' attributes
            $sku = $items[$i]['sku'];
            $quantity = $items[$i]['quantity'];
            $colour = $items[$i]['colour'];

            // Loop through the quantities
            for ($j = 0; $j < $quantity ; $j++ )
            {
                // Check if the sku exists, and it's available
                $products = Product::with('itemAvailable')->productSku($sku)->get()->first();

                // If the product exists
                if (!empty($products))
                {
                    // If there is any item available
                    if(!empty($products->itemAvailable->first()))
                    {
                        // Then update its order_id to the recently created order
                        $item = $products->itemAvailable->first()->update(['order_id' => $order_id]);

                        // Collect the orderID for the results
                        $itemIDs[] = $item->id;
                    }
                    // If there are no items under this product
                    else if (!empty($products->sku))
                    {
                        // Then create the item
                       $item = Item::createItem($products->id, $order_id);

                        // Collect the orderID for the results
                       $itemIDs[] = $item->id;
                    }
                }
                // If the product doesn't exist
                else
                {
                    // Create the product
                    $product = Product::firstOrCreate(['sku' => $sku, 'colour' => $colour]);

                    // Create the item
                    $item = Item::createItem($product->id, $order_id); 

                    // Collect the orderID for the results
                    $itemIDs[] = $item->id;

                    // Admin's email to receive the e-mail
                    $admin = 'sina.rzp@gmail.com';
                    // Mail::to($admin)->send(new \App\Mail\ProductCreated($product));
                    
                }
            }
        }
        
        $result = ['order' => $order_id, 'items' => $itemIDs]; // Get the orderID and item IDs to return them

        return $result;

    }

}
