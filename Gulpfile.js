'use strict';

// Require gulp
var gulp = require('gulp');

// Require gulp-sass
var sass = require('gulp-sass');

// Require minify
var minify = require('gulp-minify');

// Gulp task to minify admin js
gulp.task('minify-admin-js', function(done) {
  gulp.src(['admin/js/*.js'])
    .pipe(minify({ignoreFiles: ['*-min.js']}))
    .pipe(gulp.dest('./admin/js/'));

    // Run the callback function
    done();

});

// Gulp task to minify public js
gulp.task('minify-public-js', function(done) {
  gulp.src(['public/js/*.js'])
    .pipe(minify({ignoreFiles: ['*-min.js']}))
    .pipe(gulp.dest('./public/js/'));

    // Run the callback function
    done();

});

// Gulp task for admin styles
gulp.task('admin-sass', function(done) {
    gulp.src('admin/sass/*.scss')
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(gulp.dest('./admin/css/'));
        
    // Run the callback function
    done();

});

// Gulp task for public styles
gulp.task('public-sass', function(done) {
    gulp.src('public/sass/*.scss')
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(gulp.dest('./public/css/'));

    // Run the callback function
    done();

});

// Watch for changes to files
gulp.task('default',function(done) {

	// Watch admin files for sass changes
    gulp.watch('admin/sass/*.scss', gulp.series('admin-sass'));

    // Watch public files for sass changes
    gulp.watch('public/sass/*.scss', gulp.series('public-sass'));

    // Watch admin files for js changes
    gulp.watch('admin/js/*.js', gulp.series('minify-admin-js'));

    // Watch public files for js changes
    gulp.watch('public/js/*.js', gulp.series('minify-public-js'));

    // Run the callback function
    done();

});