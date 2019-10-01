module.exports = {
    test  : /\.(svg)$/i,
    oneOf : [
        {
            resourceQuery: /inline/,
            loader: 'vue-svg-loader',
        },
        {
            loader: 'file-loader',
            query: {
                name: 'img/[name].[hash:8].[ext]',
            },
        },
    ],
}
