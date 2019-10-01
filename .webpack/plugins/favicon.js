const
    path                  = require('path'),
    manifest              = require('../manifest'),
    FaviconsWebpackPlugin = require('favicons-webpack-plugin'),
    packageJson           = require('../../package.json')

module.exports = new FaviconsWebpackPlugin({
    title: process.env.APP_NAME || packageJson.name,
    logo: path.join(manifest.paths.src, 'img', 'logo-mix-dark.svg'),
    background: '#fff',
    prefix: 'img/icons-[hash]/',
})
