// ------------------
// @Table of Contents
// ------------------

/**
 * + @Loading Dependencies
 * + @Environment Holders
 * + @Utils
 * + @App Paths
 * + @Output Files Names
 * + @Entries Files Names
 * + @Exporting Module
 */


// ---------------------
// @Loading Dependencies
// ---------------------

const path = require('path')

// --------------------
// @Environment Holders
// --------------------

const
    NODE_ENV       = process.env.NODE_ENV || 'development',
    PUBLIC_PATH    = process.env.PUBLIC_PATH || '/assets/',
    IS_DEVELOPMENT = NODE_ENV === 'development',
    IS_PRODUCTION  = NODE_ENV === 'production'

// ------
// @Utils
// ------

const
    dir = src => path.join(__dirname, src)

const APP_ROOT = dir('../')

// loads env from file
require('dotenv').config({
    path: path.join(APP_ROOT, 'application', 'config', '.env'),
})

// ----------
// @App Paths
// ----------

const assetsSrc = '../application/src-assets',
      assetsDist = '../www/assets',
      assetsAdminSrc = '../node_modules/clip-one/assets'

const
    paths = {
        root  : APP_ROOT,
        src   : dir(assetsSrc),
        build : dir(assetsDist),
        modules: dir('../modules'),
        vendors: dir('../node_modules'),

        admin: {
            src: dir(assetsAdminSrc),
            css: {
                src: dir(assetsAdminSrc + '/css'),
                dist: dir(assetsDist + '/css/admin')
            },
            js: {
                src: dir(assetsAdminSrc + '/js'),
                dist: dir(assetsDist + '/js/admin')
            },
            font: {
                src: dir(assetsAdminSrc + '/fonts'),
                dist: dir(assetsDist + '/font')
            },
            plugin: {
                src: dir(assetsAdminSrc + '/plugins')
            }
        }
    }

// -------------------
// @Output Files Names
// -------------------

const
    outputFiles = {
        bundle : 'js/site/bundle.js',
        vendor : 'js/site/vendor.js',
        css    : 'css/site/style.css',
    }

// --------------------
// @Entries Files Names
// --------------------

const
    entries = {
        appJs : 'index.js'
    }

// -----------------
// @Exporting Module
// -----------------

module.exports = {
    paths,
    outputFiles,
    entries,
    NODE_ENV,
    IS_DEVELOPMENT,
    IS_PRODUCTION,
    PUBLIC_PATH
}
