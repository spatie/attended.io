const mix = require('laravel-mix');
const chokidar = require('chokidar');

require('laravel-mix-purgecss');

mix.react('resources/js/app.js', 'public/js');
mix.postCss('resources/css/app.css', 'public/css/app.css');

mix.options({
    postCss: [
        require('postcss-easy-import')(),
        require('tailwindcss')('./tailwind.js'),
        require('postcss-nested'),
    ],

    // Since we don't do any image preprocessing and write url's that are
    // relative to the site root, we don't want the css loader to try to
    // follow paths in `url()` functions.
    processCssUrls: false,
});

mix.babelConfig({
    plugins: ['@babel/plugin-syntax-dynamic-import'],
});

mix.webpackConfig({
    devServer: {
        disableHostCheck: true,
    },
});

mix.purgeCss({
    whitelistPatterns: [/active/],
});

if (mix.inProduction()) {
    mix.version();
}
