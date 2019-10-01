// ------------------
// @Table of Contents
// ------------------

/**
 * + @Loading Dependencies
 * + @Entry Point Setup
 * + @Path Resolving
 * + @Exporting Module
 */


// ---------------------
// @Loading Dependencies
// ---------------------

const
    path      = require('path'),
    manifest  = require('./manifest'),
    devServer = require('./devServer'),
    rules     = require('./rules'),
    plugins   = require('./plugins'),
    optimization   = require('./optimizations')

// ------------------
// @Entry Point Setup
// ------------------

const
    entry = [
        path.join(manifest.paths.src, 'scripts', manifest.entries.appJs)
    ]

// ---------------
// @Path Resolving
// ---------------

const resolve = {
    extensions : ['.webpack-loader.js', '.web-loader.js', '.loader.js', '.js', '.vue'],
    alias      : {
        // vendors
        'vue$': manifest.IS_PRODUCTION ? 'vue/dist/vue.common' : 'vue/dist/vue',
        'jquery': "jquery/src/jquery",

        // app paths
        '@'       : path.join(manifest.paths.src, 'scripts'),
        '@styles' : path.join(manifest.paths.src, 'styles'),
        '@img'    : path.join(manifest.paths.src, 'img'),
        '@modules' : path.join(manifest.paths.modules)
    },
    modules    : [
        path.join(__dirname, '../node_modules'),
        path.join(manifest.paths.src, '')
    ],
}

// -----------------
// @Exporting Module
// -----------------

module.exports = {
    mode    : manifest.IS_PRODUCTION ? 'production' : 'development',
    devtool : manifest.IS_PRODUCTION ? false : 'eval',
    context : path.join(manifest.paths.src, manifest.entries.appJs),
    watch   : !manifest.IS_PRODUCTION,
    entry,
    output  : {
        path       : manifest.paths.build,
        publicPath : manifest.PUBLIC_PATH,
        filename   : manifest.outputFiles.bundle,
    },
    module  : {
        rules,
    },
    resolve,
    plugins,
    devServer,
    optimization,
}
