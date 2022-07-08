let mix = require('laravel-mix')
let tailwindcss = require('tailwindcss')
let path = require('path')
let postcssImport = require('postcss-import')

mix
    .js('resources/js/app.js', 'public')
    .vue({ version: 3})
    .extract()
    .setPublicPath('public')
    .postCss('resources/css/app.css', 'public', [
        postcssImport(),
        tailwindcss('tailwind.config.js')
    ])
    .copy('resources/fonts', 'public/fonts')
    .alias({ '@': path.join(__dirname, 'resources/js') })
    .options({
        vue: {
            exposeFilename: true,
        },
        processCssUrls: false,
    })
    .version()

if (! mix.inProduction()) {
    mix.sourceMaps()
}

