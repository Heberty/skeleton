const
    path     = require('path'),
    manifest = require('../manifest'),
    Dotenv   = require('dotenv-webpack')

module.exports = new Dotenv(
    {
        path: path.join(manifest.paths.root, 'application', 'config', '.env'),
    }
)
