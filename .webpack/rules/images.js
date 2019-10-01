module.exports = {
    test    : /\.(png|gif|jpg)$/i,
    //exclude : /(node_modules)/,
    use     : [
        {
            loader  : 'file-loader',
            options : {
                outputPath : 'img',
            },
        },
    ],
}
