var Encore = require('@symfony/webpack-encore');

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if you JavaScript imports CSS.
     */
    .addEntry('app', './assets/js/app.js')
    .addEntry('identificacion', './assets/js/identificacion.js')
    .addEntry('causas', './assets/js/causas.js')
    .addEntry('condiciones', './assets/js/condiciones.js')
    .addEntry('organizacion', './assets/js/organizacion.js')
    .addEntry('ubicacion', './assets/js/ubicacion.js')
    .addEntry('vehiculos', './assets/js/vehiculos.js')
    .addEntry('peatones', './assets/js/peatones.js')
    .addEntry('mensaje', './assets/js/mensaje.js')
    .addEntry('test', './assets/js/test.js')
    .addEntry('busqueda', './assets/js/busqueda.js')
    .addEntry('analisis', './assets/js/analisis.js')
    .addEntry('inspeccion', './assets/js/inspeccion.js')
    .addEntry('adjunto', './assets/js/adjunto.js')
    .addEntry('accidente', './assets/js/accidente.js')
    .addEntry('maestro', './assets/js/maestro.js')
    //.addEntry('page1', './assets/js/page1.js')
    //.addEntry('page2', './assets/js/page2.js')
    .addEntry('filtroAccidenteUnidad', './assets/js/filtroAccidenteUnidad.js')
    .addEntry('filtroAccidenteVehiculo', './assets/js/filtroAccidenteVehiculo.js')
    .addEntry('filtroAccidentePersona', './assets/js/filtroAccidentePersona.js')

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // enables @babel/preset-env polyfills
    .configureBabel(() => {}, {
        useBuiltIns: 'usage',
        corejs: 3
    })

    // enables Sass/SCSS support
    .enableSassLoader()

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment to get integrity="..." attributes on your script & link tags
    // requires WebpackEncoreBundle 1.4 or higher
    //.enableIntegrityHashes()

    // uncomment if you're having problems with a jQuery plugin
    .autoProvidejQuery()

    // uncomment if you use API Platform Admin (composer req api-admin)
    //.enableReactPreset()
    //.addEntry('admin', './assets/js/admin.js')
;

module.exports = Encore.getWebpackConfig();
