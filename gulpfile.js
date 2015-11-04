var elixir = require('laravel-elixir');

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
    mix.sass('cms.scss')
		.scripts(['jquery.inputmask.bundle.js'], 'public/js/cms.js')
    	.version(['public/css/cms.css', 'public/js/cms.js'])
    	.copy('resources/assets/font', 'public/font')
		.copy('resources/assets/images', 'public/images');
});
