// ------------------
// @Table of Contents
// ------------------

/**
 * + @Loading Dependencies
 * + @Common Plugins
 * + @Merging Production Plugins
 * + @Merging Development Plugins
 * + @Exporting Module
 */


// ---------------------
// @Loading Dependencies
// ---------------------

const
    manifest = require('../manifest'),
    webpack  = require('webpack')

// ---------------
// @Common Plugins
// ---------------

const
    plugins = []

plugins.push(
    new webpack.DefinePlugin({
        'process.env'  : {
            NODE_ENV : JSON.stringify(manifest.NODE_ENV),
        },
        IS_DEVELOPMENT : manifest.IS_DEVELOPMENT,
        IS_PRODUCTION : manifest.IS_PRODUCTION,
        PUBLIC_PATH : manifest.PUBLIC_PATH,
    })
)

plugins.push(
    new webpack.ProvidePlugin({
        $               : 'jquery',
        jQuery          : 'jquery',
        'window.jQuery' : 'jquery',
        Popper          : ['popper.js', 'default'],
    })
)

// -----------------
// @Exporting Module
// -----------------

module.exports = plugins
