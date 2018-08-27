// Require gulp
var gulp = require('gulp');

// Require gulp-sass
var sass = require('gulp-sass');

// Gulp task for admin styles
gulp.task('organic-contact-form-admin', function() {
    gulp.src('admin/sass/*.scss')
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(gulp.dest('./admin/css/'));
});

// Gulp task for public styles
gulp.task('organic-contact-form-public', function() {
    gulp.src('public/sass/*.scss')
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(gulp.dest('./public/css/'));
});

// Watch for changes to files
gulp.task('default',function() {

	// Watch admin files
    gulp.watch('admin/sass/*.scss', ['organic-contact-form-admin']);

    // Watch public files
    gulp.watch('public/sass/*.scss', ['organic-contact-form-public']);

});