const ExtractTextPlugin = require('extract-text-webpack-plugin');
const ManifestPlugin = require('webpack-manifest-plugin');

module.exports = {
    entry: {
        'css/app': './resources/assets/css/app.css',
        'js/app': './resources/assets/js/app.js',
    },
    output: {
        path: __dirname + '/public',
        filename: '[name]-[hash].js',
    },
    module: {
        loaders: [
            {
                test: /\.js$/,
                loader: 'babel-loader',
                exclude: /node_modules/,
            },
            {
                test: /\.css$/,
                loader: ExtractTextPlugin.extract(['css-loader', 'postcss-loader']),
            },
            {
                test: /\.jpe?g$/,
                loader: 'url-loader',
            },
        ],
    },
    resolve: {
        extensions: ['.js', '.css'],
    },
    plugins: [
        new ExtractTextPlugin('[name]-[hash].css'),
        new ManifestPlugin({
            fileName: 'mix-manifest.json',
            basePath: '/',
        }),
    ],
};
