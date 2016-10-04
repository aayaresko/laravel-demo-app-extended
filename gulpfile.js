const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

elixir.config.sourcemaps = false;

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

elixir(mix => {
    mix.sass('app.scss')
        .webpack('app.js')
        .styles([
            'main.css'
        ])
        .copy('./resources/assets/vendor', 'public/vendor')
        .copy('./angular/dist/*.js', 'public/js/angular')
        .copy('./angular/dist/*.map', 'public/js/angular');
});
