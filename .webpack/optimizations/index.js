const
    UglifyJsPlugin = require('uglifyjs-webpack-plugin'),
    OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin")

const optimizations = {
    namedModules       : true,
    splitChunks        : {
        chunks : 'all',
    },
    noEmitOnErrors     : true,
    concatenateModules : true,

    minimizer : [
        new UglifyJsPlugin({
            cache         : true,
            parallel      : true,
            sourceMap     : false,
            uglifyOptions : {
                ecma   : 5,
                output : {
                    beautify : false,
                    comments : false,
                },
            },
        }),
        new OptimizeCSSAssetsPlugin({}),
    ],
}

module.exports = optimizations
