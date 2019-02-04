const javascriptEntry = 'themes/default/src/javascript/app.js';
const javascriptSrc = 'themes/default/src/javascript/**/*.js';
const javascriptDest = 'themes/default/javascript';

const eslint = require('gulp-eslint');

const sass = require('gulp-sass');

const sassSrc = 'themes/default/src/sass/**/*.scss';
const sassDest = 'themes/default/css';

const gulp = require('gulp');

const webpack = require('webpack');
const webpackStream = require('webpack-stream');
const webpackConfig = require('./webpack.config.js');

function buildJs() {
  return gulp.src(javascriptEntry)
    .pipe(eslint())
    .pipe(eslint.format())
    .pipe(eslint.failAfterError())
    .pipe(webpackStream(webpackConfig), webpack)
    .pipe(gulp.dest(javascriptDest));
}

function watchJs() {
  gulp.watch(javascriptSrc, buildJs);
}

function buildSass() {
  return gulp.src(sassSrc)
    .pipe(sass({
      outputStyle: 'compressed',
    }))
    .on('error', sass.logError)
    .pipe(gulp.dest(sassDest));
}

function watchSass() {
  gulp.watch(sassSrc, buildSass);
}

exports.js = buildJs;
exports.watchjs = watchJs;

exports.sass = buildSass;
exports.watchSass = watchSass;

exports.default = gulp.parallel(buildJs, buildSass, watchJs, watchSass);
