const
    manifest = require('../manifest')

const plugins = []

plugins.push(
    require('./dotenv'),
    require('./vue'),
    ...(require('./internal')),
    require('./html'),
    require('./lodash'),
    require('./caseSensitive'),
    require('./copy')
)

if (manifest.IS_PRODUCTION) {
    plugins.push(
        require('./imagemin'),
        require('./favicon'),
        require('./extract')
    )
}

if (process.env.BUNDLE_ANALYZER) {
    plugins.push(require('./bundleAnalyzer'))
}

module.exports = plugins
