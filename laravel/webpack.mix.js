const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .styles([
      'public/assets/styles/css/themes/lite-purple.min.css',
      'public/assets/styles/css/vendor/perfect-scrollbar.css',
      'public/css/vue.css',
      'public/css/modal.css'
   ],'public/css/template.css')
.js([
   'public/assets/js/vendor/jquery-3.3.1.min.js',
   'public/assets/js/vendor/echarts.min.js',
   'public/assets/js/es5/echart.options.min.js',
   'public/assets/js/es5/script.min.js',
   'public/assets/js/es5/sidebar.large.script.js',
],'public/js/template.js');
