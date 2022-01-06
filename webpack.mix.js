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
const mix = require('laravel-mix');
const path = require('path');
const tailwindcss = require('tailwindcss');

require('dotenv').config();

/*
 |--------------------------------------------------------------------------
 | General
 |--------------------------------------------------------------------------
 */
mix.setPublicPath(path.normalize('dist/')) // Set path to store our manifest file
mix.disableSuccessNotifications();

mix.js('assets/js/scripts.js', 'dist/js');

mix.sass('assets/scss/style.scss', 'dist/css')
    .options({
      processCssUrls: false,
      postCss: [ tailwindcss('./tailwind.config.js') ],
    });

/*
 |--------------------------------------------------------------------------
 | Development
 |--------------------------------------------------------------------------
 */
if (!mix.inProduction()) {
  mix.sourceMaps()
    .webpackConfig({devtool: 'inline-source-map'})
    .browserSync({
      proxy: process.env.PROXY_URL || '',
      https: {
        key: process.env.SSL_KEY || '',
        cert: process.env.SSL_CRT || '',
      },
      open: false,
      ui: false,
      files: ['./**/*.php', './dist/**/*'],
    })
}

/*
 |--------------------------------------------------------------------------
 | Production
 |--------------------------------------------------------------------------
 */
if (mix.inProduction()) {
  mix.version()
}