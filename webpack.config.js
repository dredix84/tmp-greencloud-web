const path = require('path');
const WebpackNotifierPlugin = require('webpack-notifier');

const ASSET_PATH = process.env.ASSET_PATH || '/js/';

module.exports = {
    entry: './src/index.js',
    output: {
        filename: 'bundle.js',
        path: path.resolve(__dirname, 'webroot/js'),
        publicPath: ASSET_PATH,
    },
    mode: "development",
    resolve: {alias: {vue: 'vue/dist/vue.esm.js'}},
    module: {
        rules: [
            {test: /\.txt$/, use: 'raw-loader'},
            {
                test: /\.s(c|a)ss$/,
                use: [
                    'vue-style-loader',
                    // style-loader
                    // {loader: 'style-loader'},
                    // css-loader
                    {
                        loader: 'css-loader',
                        options: {
                            modules: true
                        }
                    },
                    {
                        loader: 'sass-loader',
                        // Requires sass-loader@^7.0.0
                        options: {
                            implementation: require('sass'),
                            fiber: require('fibers'),
                            indentedSyntax: true // optional
                        },
                        // Requires sass-loader@^8.0.0
                        options: {
                            implementation: require('sass'),
                            sassOptions: {
                                fiber: require('fibers'),
                                indentedSyntax: false // optional
                            },
                        },
                    },
                ]
            },
            {
                test: /\.css$/i,
                use: ['style-loader', 'css-loader'],
            },
            {test: /\.ts$/, use: 'ts-loader'},
            {
                test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: '[name].[ext]',
                            outputPath: 'fonts/'
                        }
                    }
                ]
            }
        ]
    },
    plugins: [
        new WebpackNotifierPlugin(),
    ]
};
