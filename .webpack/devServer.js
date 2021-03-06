// ---------------------
// @Loading Dependencies
// ---------------------

const
    manifest = require('./manifest')

// ------------------
// @DevServer Configs
// ------------------

/**
 * [1] : To enable local network testing
 */

const devServer = {
    contentBase        : manifest.IS_PRODUCTION ? manifest.paths.build : manifest.paths.src,
    historyApiFallback : true,
    port               : 8080,
    compress           : manifest.IS_PRODUCTION,
    inline             : !manifest.IS_PRODUCTION,
    watchContentBase   : true,
    hot                : !manifest.IS_PRODUCTION,
    // host               : '0.0.0.0',
    disableHostCheck   : true, // [1]
    overlay            : true,
    stats              : {
        assets     : true,
        children   : false,
        chunks     : false,
        hash       : false,
        modules    : false,
        publicPath : false,
        timings    : true,
        version    : false,
        warnings   : true,
        colors     : true,
    },
    watchOptions: {
        aggregateTimeout: 300,
        poll: 1000,
        ignored: /node_modules/,
    },
}

// -----------------
// @Exporting Module
// -----------------

module.exports = devServer
