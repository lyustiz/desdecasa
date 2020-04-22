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

mix.webpackConfig({
   resolve: {
     extensions: ['.js', '.vue', '.json'],
     alias: {
       'vue$': 'vue/dist/vue.esm.js',
       '~'   : path.resolve(__dirname, './resources/js'),
       '@components': path.resolve(__dirname, './resources/js/components'),
       '@store'    : path.resolve(__dirname, './resources/js/store'),
       '@mixins'    : path.resolve(__dirname, './resources/js/mixins'),
       '@pages'     : path.resolve(__dirname, './resources/js/pages'),
       '@images'    : path.resolve(__dirname, './resources/js/assets/img'),
     },
   },
 })

let productionSourceMaps = !mix.inProduction(); productionSourceMaps, 'source-map'

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps(productionSourceMaps, 'source-map')
    //.version()

    
  if (mix.inProduction()) {
      mix.version()
  } 

//mix.copyDirectory('resources/img', 'public/images');


