module.exports = function (api) {
    api.cache(true)

    const presets = [
        [
            '@babel/preset-env',
            {
                'modules': false,
                'loose': false,
                'useBuiltIns': 'usage',
                'corejs': 2,
            },
        ],
    ]

    const plugins = [
        'dynamic-import-webpack',
        '@babel/plugin-syntax-dynamic-import',
        '@babel/plugin-proposal-class-properties',
        '@babel/plugin-proposal-object-rest-spread',
        [
            '@babel/plugin-transform-runtime',
            {
                'regenerator': false,
            },
        ],
    ]

    return {
        presets,
        plugins,
    }
}
