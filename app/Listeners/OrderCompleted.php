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
        $order_id = $event->item;

        $order = Order::whereId($order_id)->with('items', 'itemsDelivered')->get()->first();

        $items = count($order->items);
        $itemsDelivered = count($order->itemsDelivered);

        switch(true)
        {
            case $items == $itemsDelivered && $items != 0:
                $completed = Order::whereId($order_id)->update(['status' => 'Completed']);
                break;

            case $items > $itemsDelivered:
                $in_progress = Order::whereId($order_id)->update(['status' => 'In Progress']);
                break;

            case $items == 0:
                $cancelled = Order::whereId($order_id)->update(['status' => 'Cancelled']);
                break;

            default:
                $in_progress = Order::whereId($order_id)->update(['status' => 'In Progress']);
                break;
        }

        //
    }
}
