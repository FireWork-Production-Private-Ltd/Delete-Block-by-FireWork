const path = require('path');
const DependencyExtractionWebpackPlugin = require('@wordpress/dependency-extraction-webpack-plugin');

module.exports = {
  mode: 'production',
  entry: './assets/src/js/delete-control.js',
  output: {
    filename: 'delete-control.js',
    path: path.resolve(__dirname, 'assets/build/js'),
  },
  plugins: [
    new DependencyExtractionWebpackPlugin(),
  ],
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
        },
      },
    ],
  },
  resolve: {
    alias: {
      '@wordpress/element': path.resolve(__dirname, 'node_modules/@wordpress/element'),
      '@wordpress/data': path.resolve(__dirname, 'node_modules/@wordpress/data'),
      '@wordpress/block-editor': path.resolve(__dirname, 'node_modules/@wordpress/block-editor'),
      '@wordpress/components': path.resolve(__dirname, 'node_modules/@wordpress/components'),
      '@wordpress/compose': path.resolve(__dirname, 'node_modules/@wordpress/compose'),
      '@wordpress/hooks': path.resolve(__dirname, 'node_modules/@wordpress/hooks'),
    },
  },
};
