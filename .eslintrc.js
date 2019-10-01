module.exports = {
    root: true,
    extends: ["plugin:vue/recommended", "airbnb-base"],
    parserOptions: {
        parser: "babel-eslint",
        sourceType: "module",
        ecmaFeatures: {
            modules: true,
            destructuring: true,
            experimentalObjectRestSpread: true,
            classes: true,
            forOf: true,
            blockBindings: true,
            arrowFunctions: true
        }
    },
    env: {
        browser: true,
        es6: true
    },
    settings: {
        ecmascript: 6
    },

    // required to lint *.vue files
    plugins: ["vue"],
    globals: {
        ga: true, // Google Analytics
        cordova: true,
        __statics: true,
    },
    // add your custom rules here
    rules: {
        // -------------
        // General Rules
        // -------------
        "arrow-body-style": 0,
        "prefer-arrow-callback": 0,
        "arrow-parens": 0,
        "no-param-reassign": 0,
        "no-new": 0,
        "consistent-return": 0,
        "key-spacing": 0,
        "no-console": 0,
        "no-multi-spaces": 0,
        "no-underscore-dangle": 0,
        "one-var": 0,
        "global-require": 0,
        "class-methods-use-this": 0,

        "comma-dangle": [
            "error",
            {
                "arrays": "always-multiline",
                "objects": "always-multiline",
                "imports": "always-multiline",
                "exports": "always-multiline",
                "functions": "never"
            }
        ],
        "func-names": 0,
        "function-paren-newline": 0,
        "indent": ["error", 4],
        "new-cap": 0,
        "no-plusplus": 0,
        "no-return-assign": 0,
        "quote-props": 0,
        "template-curly-spacing": 0,
        "no-unused-expressions": 0,
        "semi": [2, "never"],

        // ------------
        // Import Rules
        // ------------

        "import/first": 0,
        "import/named": 2,
        "import/namespace": 2,
        "import/default": 2,
        "import/export": 2,
        "import/extensions": 0,
        "import/no-extraneous-dependencies": 0,
        "import/no-unresolved": 0,
        "import/prefer-default-export": 0,

        // ------------
        // Override Vue Rules
        // ------------

        "vue/html-indent": ["error", 4],
        "vue/script-indent": [
            "error",
            4,
            {
                baseIndent: 0,
                switchCase: 1
            }
        ],

        // allow debugger during development
        "no-debugger": process.env.NODE_ENV === "production" ? 2 : 0
    }
};
