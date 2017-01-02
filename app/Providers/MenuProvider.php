<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Backpack\MenuCRUD\app\Models\MenuItem;
use DB;
use View;

class MenuProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // $menu = DB::select('SELECT * FROM menu_items');
        $menu = MenuItem::getTree();
        View::share(['menu' => $menu]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
