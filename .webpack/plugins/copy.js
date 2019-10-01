const
    path     = require('path'),
    CopyWebpackPlugin = require('copy-webpack-plugin'),
    manifest = require('../manifest'),
    paths = []

paths.push(
    {
        from : path.join(manifest.paths.src, 'img'),
        to   : path.join(manifest.paths.build, 'img'),
    }
)

module.exports = new CopyWebpackPlugin(
    paths,
    {
        ignore: [ '*.db' ]
    }
)
