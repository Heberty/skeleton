// ------------------
// @Table of Contents
// ------------------

/**
 * + @Loading Dependencies
 * + @Common Loaders
 * + @Exporting Module
 */


// ---------------------
// @Loading Dependencies
// ---------------------

const
    manifest = require('../manifest'),
    path     = require('path'),
    postcssPresetEnv = require('postcss-preset-env'),
    MiniCssExtractPlugin = require('mini-css-extract-plugin')

// ---------------
// @Common Loaders
// ---------------

let loaders = [
    {
        loader  : 'css-loader',
        options : {
            sourceMap : manifest.IS_DEVELOPMENT,
            minimize  : manifest.IS_PRODUCTION
        },
    },
    {
        loader  : 'postcss-loader',
        options : {
            ident: 'postcss',
            sourceMap : manifest.IS_DEVELOPMENT,
            plugins   : () => [
                postcssPresetEnv(),
            ],
        },
    },
    {
        loader: "resolve-url-loader", //resolve-url-loader needs to come *BEFORE* sass-loader
        options: {
            sourceMap: manifest.IS_DEVELOPMENT,
        },
    },
    {
        loader  : 'sass-loader',
        options : {
            workerParallelJobs : 2,
            sourceMap          : manifest.IS_DEVELOPMENT,
            includePaths       : [
                path.join('../../', 'node_modules'),
                path.join(manifest.paths.src, 'assets', 'styles'),
                path.join(manifest.paths.src, ''),
            ],
        },
    },
]

if (manifest.IS_DEVELOPMENT) {
    loaders = ['vue-style-loader'].concat(loaders)
} else {
    loaders = [MiniCssExtractPlugin.loader].concat(loaders)
}

const rule = {
    test: /\.(sa|sc|c)ss$/,
    use  : [].concat(loaders),
}

// -----------------
// @Exporting Module
// -----------------

module.exports = rule
