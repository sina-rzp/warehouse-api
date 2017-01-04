<?php

namespace App\Listeners;

use App\Events\CheckStatus;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Item;
use App\Models\Order;


class OrderCompleted
{
    protected $item;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CheckStatus  $event
     * @return void
     */
    public function handle(CheckStatus $event)
    {
        //Get the orderID
        $order_id = $event->item;

        // If the orderID does exist
        if (!empty($order_id))
        {

            // Get the number of items and delivered items
            $order = Order::whereId($order_id)->withCount('items', 'itemsDelivered')->get()->first();

            $items = $order->items_count;
            $itemsDelivered = $order->items_delivered_count;

            switch(true)
            {
                // If the number of items and delivered items are equal
                case $items == $itemsDelivered && $items != 0:

                    // Then update the order to Completed
                    $completed = Order::whereId($order_id)->update(['status' => 'Completed']);
                    break;

                // If the number of items is bigger than the number of delivered items
                case $items > $itemsDelivered:

                    // Then update the order to In Progress
                    $in_progress = Order::whereId($order_id)->update(['status' => 'In Progress']);
                    break;

                // If the number of items is 0
                case $items == 0:
                    //Then set it to Cancelled
                    $cancelled = Order::whereId($order_id)->update(['status' => 'Cancelled']);
                    break;

                // Default: set it to In Progress
                default:
                    $in_progress = Order::whereId($order_id)->update(['status' => 'In Progress']);
                    break;
            }
        }
    }
}
