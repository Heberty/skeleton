module.exports = {
    test    : /\.(js)$/,
    exclude : /(node_modules|build|dist\/)/,
    use     : [
        {
            loader  : 'babel-loader',
        },
    ],
}
