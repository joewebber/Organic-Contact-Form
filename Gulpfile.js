// Use strict
'use strict';

// Require gulp
var gulp = require('gulp');

// Require gulp-sass
var sass = require('gulp-sass');

// Require minify
var minify = require('gulp-minify');

// Gulp task to minify js
gulp.task('minify-js', function() {

    // Set the source, options and output destination for admin
    gulp.src(['admin/js/*.js', '!admin/js/*-min.js'])
        .pipe(minify({ignoreFiles: ['admin/js/*-min.js']}))
        .pipe(gulp.dest('./admin/js/'));

    // Set the source, options and output destination for public
    gulp.src(['public/js/*.js', '!public/js/*-min.js'])
        .pipe(minify({ignoreFiles: ['*-min.js']}))
        .pipe(gulp.dest('./public/js/'));

    // Run the callback function
    //done();

});

// Gulp task to compile sass
gulp.task('compile-sass', function() {

    // Set the source, options and output destination for admin
    gulp.src('admin/sass/*.scss')
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(gulp.dest('./admin/css/'));

    // Set the source, options and output destination for public
    gulp.src('public/sass/*.scss')
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(gulp.dest('./public/css/'));
        
    // Run the callback function
    //done();

});

// Watch for changes to files
gulp.task('default', function() {

	// Watch sass files for changes
    gulp.watch(['admin/sass/*.scss', 'public/sass/*.scss'], ['compile-sass']);

    // Watch files for js changes (ignore files ending '-min.js')
    gulp.watch(['admin/js/*.js', 'public/js/*.js', '!admin/js/*-min.js', '!public/js/*-min.js'], ['minify-js']);

    // Run the callback function
    //    done();

});