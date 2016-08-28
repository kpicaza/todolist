const webpack = require('webpack');
var production = process.env.NODE_ENV === 'production';

module.exports = {
    entry: {
        // login: './Frontend/loginApp.js',
        // registration: './Frontend/registerApp.js',
        base: './app/resources/assets/js/BaseApp/index.js',
    },
    resolve: {
        modulesDirectories: ['node_modules'],
        alias: {},
        extensions: ['', '.jsx', '.js']
    },
    output: {
        path: './web/builds',
        filename: '[name].js',
        publicPath: production ? '/builds/' : 'http://localhost:8080/builds/'
    },
    plugins: [
        new webpack.ProvidePlugin({
            _: "lodash"
            // $: "jquery",
            // "jQuery": "jquery",
            // "window.jQuery": "jquery",
        })
        // new webpack.optimize.UglifyJsPlugin({
        //     compress: { warnings: false }
        // })
    ],
    module: {
        loaders: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                loader: "babel-loader",
                query: {
                    presets: ["es2015", 'react']
                }
            },
            {
                test: /\.css$/,
                loader: "style!css"
            },
            {
                test: /\.(png|gif|jpe?g|svg?(\?v=[0-9]\.[0-9]\.[0-9])?)$/i,
                loader: 'url?limit=10000'
            }
        ]
    },
    devServer: {
        hot: true,
        contentBase: './web/',
        headers: {"Access-Control-Allow-Origin": "*"}
    },
    devtool: production ? false : '#inline-source-map'
};
