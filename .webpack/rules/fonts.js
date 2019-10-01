module.exports = {
    test    : /\.(eot|ttf|woff|woff2)$/,
    //exclude : /(node_modules)/,
    use     : [
    	{
            loader  : 'file-loader',
            options : {
                outputPath : 'font',
            },
        }
    ],
}
