const mix = require('laravel-mix');

const path = require('path');

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

mix.ts('resources/js/app.ts', 'public/web/js')
    .react()
    .extract(["react"])
    .alias({
        "@root": 'resources/js/Webapp',
        "@components": 'resources/js/Webapp/components',
        "@hooks": 'resources/js/Webapp/hooks',
        "@pages": 'resources/js/Webapp/pages',
        "@store": 'resources/js/Webapp/store',
        "@utils": 'resources/js/Webapp/utils',
    }); // -- tsconfig.json - paths
