<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Item;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    { 
        //register the observer for the Item
        Item::observe(new \App\Observers\StatusObserver);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
            $this->app->register('Backpack\Generators\GeneratorsServiceProvider');

        }
    }
}
