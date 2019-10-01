module.exports = {
    test    : /\.(vue)$/,
    exclude : /(build|dist\/)/,
    use     : [
        {
            loader  : 'vue-loader',
            options : {
                transformAssetUrls : {
                    'img'              : 'src',
                    'object'           : 'data',
                    'image'            : 'xlink:href',
                    'b-img'            : 'src',
                    'b-img-lazy'       : ['src', 'blank-src'],
                    'b-card'           : 'img-src',
                    'b-card-img'       : 'img-src',
                    'b-carousel-slide' : 'img-src',
                    'b-embed'          : 'src',
                },
            },
        },
    ],
}
