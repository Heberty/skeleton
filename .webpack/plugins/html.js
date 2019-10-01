const
    path              = require('path'),
    manifest          = require('../manifest'),
    HtmlWebpackPlugin = require('html-webpack-plugin');

module.exports = new HtmlWebpackPlugin({
    template : path.join(manifest.paths.src, '..', 'views', 'layouts', 'default.webpack.php'),
    path     : manifest.paths.build,
    filename : 'default.php',
    inject   : true,
    minify   : false,
});
