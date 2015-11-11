// Include gulp
var gulp = require('gulp');

// Include Our Plugins
var sass = require('gulp-sass');
// var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var filesize = require('gulp-filesize');
var sourcemaps = require('gulp-sourcemaps');
var base64 = require('gulp-base64');
var plumber = require('gulp-plumber');
// var autoprefixer = require('gulp-autoprefixer');
var minifycss = require('gulp-minify-css');
var gutil = require('gulp-util');

// error function for plumber
var onError = function (err) {
  gutil.beep();
  console.log(err);
  this.emit('end');
};

// Browser definitions for autoprefixer
var AUTOPREFIXER_BROWSERS = [
  'last 3 versions',
  'ie >= 8',
  'ios >= 7',
  'android >= 4.4',
  'bb >= 10'
];

// Compile Our Sass
gulp.task('sass', function() {
  return gulp.src('css/scss/*.scss')
    .pipe(plumber({ errorHandler: onError }))
    .pipe(sourcemaps.init())
    .pipe(sass({ style: 'expanded'}))
    // .pipe(autoprefixer(AUTOPREFIXER_BROWSERS))
    .pipe(base64({baseDir: './',maxImageSize: 32*1024, extensions: ['svg', 'png'], exclude: ['fontello.svg'], debug:true}))
    .pipe(minifycss({keepSpecialComments: 0}))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('css'));
});

// Minify JS
gulp.task('js', function() {
  return gulp.src('js/*.js')
    // .pipe(concat('all.js'))
    // .pipe(filesize())
    .pipe(rename({extname: '.min.js'}))
    .pipe(uglify())
    .pipe(gulp.dest('js/min'));
    // .pipe(filesize());
});

// Watch Files For Changes
gulp.task('watch', function() {
  gulp.watch('js/*.js', ['js']);
  gulp.watch('css/scss/*.scss', ['sass']);
});

// Default Task
gulp.task('default', ['sass', 'js', 'watch']);
