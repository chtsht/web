var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
    rename = require('gulp-rename');
	
gulp.task('css', function() {
  return sass('dev/sass/',{ style: 'expanded' })
    //.pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1'))
    .pipe(gulp.dest('css'))
    .pipe(rename({suffix: '.min'}))
    .pipe(minifycss())
    .pipe(gulp.dest('css'));
});

gulp.task( "watch", function() {
	var css = [ "css" ];
	//var js = [ "js" ];

	gulp.watch( "dev/sass/**/*.scss", css );
	//gulp.watch( "./dev/js/**/*", js );
});