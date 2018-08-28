// Require gulp
var gulp = require('gulp');

// Require gulp-sass
var sass = require('gulp-sass');

// Require minify
var minify = require('gulp-minify');

// Gulp task to minify admin js
gulp.task('minify-admin-js', function() {
  gulp.src(['admin/js/*.js'])
    .pipe(minify({ignoreFiles: ['*-min.js']}))
    .pipe(gulp.dest('./admin/js/'))
});

// Gulp task to minify public js
gulp.task('minify-public-js', function() {
  gulp.src(['public/js/*.js'])
    .pipe(minify({ignoreFiles: ['*-min.js']}))
    .pipe(gulp.dest('./public/js/'))
});

// Gulp task for admin styles
gulp.task('admin-sass', function() {
    gulp.src('admin/sass/*.scss')
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(gulp.dest('./admin/css/'));
});

// Gulp task for public styles
gulp.task('public', function() {
    gulp.src('public/sass/*.scss')
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(gulp.dest('./public/css/'));
});

// Watch for changes to files
gulp.task('default',function() {

	// Watch admin files for sass changes
    gulp.watch('admin/sass/*.scss', ['admin-sass']);

    // Watch public files for sass changes
    gulp.watch('public/sass/*.scss', ['public-sass']);

    // Watch admin files for js changes
    gulp.watch('admin/js/*.js', ['minify-admin-js']);

    // Watch public files for js changes
    gulp.watch('public/js/*.js', ['minify-public-js']);

});