const mix = require('laravel-mix');
const path = require('path');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */


mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/dice.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css')
    .setPublicPath('public')
    // .ignore('resources/js/dice.js')
    .sourceMaps()
    .browserSync('http://localhost:8000')
    .webpackConfig({
    resolve: {
        fallback: {
            fs: false,
            path: require.resolve('path-browserify'),
            os: false,
            crypto: false,
        },
        alias: {
            '@': path.resolve(__dirname, 'resources/js')
        }
    }
});
