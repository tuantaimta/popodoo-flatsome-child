const { src, dest, series, parallel, watch } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const sourcemaps = require('gulp-sourcemaps');
const concat = require('gulp-concat');
const terser = require('gulp-terser');
const fs = require('fs');

// Rollup + Babel for JS modules
const rollup = require('gulp-rollup');
const babel = require('gulp-babel');

// -----------------------------
// PATHS
// -----------------------------
const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js'
};

// -----------------------------
// CREATE ASSET FOLDERS IF MISSING
// -----------------------------
function prepareAssets(cb) {
    if (!fs.existsSync('assets')) fs.mkdirSync('assets');
    if (!fs.existsSync('assets/css')) fs.mkdirSync('assets/css');
    if (!fs.existsSync('assets/js')) fs.mkdirSync('assets/js');
    cb();
}

// -----------------------------
// SCSS → CSS
// -----------------------------
function styles() {
    return src('src/scss/main.scss')
        .pipe(sourcemaps.init())
        .pipe(
            sass({
                outputStyle: 'expanded',
                includePaths: ['src/scss'],
                quietDeps: true,
                logger: { warn: () => {} }
            }).on('error', sass.logError)
        )
        .pipe(postcss([autoprefixer(), cssnano()]))
        .pipe(concat('main.min.css'))
        .pipe(sourcemaps.write('.'))
        .pipe(dest('assets/css'));
}

// -----------------------------
// JS MODULE BUNDLE (Rollup + Babel)
// -----------------------------
function scripts() {
    return src(paths.js)
        .pipe(
            rollup({
                input: 'src/js/scripts.js', // file chính chứa import
                output: { format: 'iife' } // browser-friendly (Immediate Function)
            })
        )
        .pipe(
            babel({
                presets: ['@babel/preset-env']
            })
        )
        .pipe(concat('scripts.min.js'))
        .pipe(terser())
        .pipe(dest('assets/js'));
}

// -----------------------------
// WATCH
// -----------------------------
function watcher() {
    watch(paths.scss, styles);
    watch(paths.js, scripts);
}

// -----------------------------
// EXPORT TASKS
// -----------------------------
exports.build = series(prepareAssets, parallel(styles, scripts));
exports.watch = series(prepareAssets, parallel(styles, scripts), watcher);
exports.default = exports.watch;
