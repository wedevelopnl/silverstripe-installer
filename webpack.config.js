const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const FixStyleOnlyEntriesPlugin = require('webpack-fix-style-only-entries');
const ESLintPlugin = require('eslint-webpack-plugin');
const StylelintPlugin = require('stylelint-webpack-plugin');

module.exports = {
  mode: 'development',
  watchOptions: {
    ignored: /node_modules/,
  },
  entry: {
    app: './themes/default/javascript/app.js',
    main: './themes/default/sass/main.scss',
    editor: './themes/default/sass/editor.scss',
  },
  optimization: {
    splitChunks: {
      cacheGroups: {
        app: {
          name: 'app',
          test: /\.js$/,
          chunks: 'all',
          enforce: true,
        },
        main: {
          name: 'main',
          test: /main\.(sa|sc|c)ss$/,
          chunks: 'all',
          enforce: true,
        },
        editor: {
          name: 'editor',
          test: /editor\.(sa|sc|c)ss$/,
          chunks: 'all',
          enforce: true,
        },
      },
    },
  },
  output: {
    path: path.resolve(__dirname, './themes/default/bundles'),
  },
  module: {
    rules: [
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
            options: {
              publicPath: '',
            },
          },
          {
            loader: 'css-loader',
          },
          {
            loader: 'postcss-loader',
          },
          {
            loader: 'sass-loader',
          },
        ],
      },
      {
        test: /\.(woff|woff2|ttf|eot|svg)$/,
        use: [
          {
            loader: 'file-loader',
          },
        ],
      },
      {
        test: /\.m?js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env'],
            plugins: [
              '@babel/plugin-transform-runtime',
            ],
          },
        },
      },
    ],
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: ({ chunk }) => `${chunk.name.replace('/js/', '/css/')}.css`,
    }),
    new FixStyleOnlyEntriesPlugin(),
    new ESLintPlugin(),
    new StylelintPlugin(),
  ],
};
