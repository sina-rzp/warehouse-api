var elixir = require('laravel-elixir');

require('laravel-elixir-wiredep');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('main.scss');
    mix.scripts(['main.js', 'events.js', 'plugins.js', 'pace.min.js']);
    mix.wiredep();
});