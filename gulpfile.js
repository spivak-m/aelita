var	gulp 		= require('gulp'),
	browserSync = require('browser-sync').create(),
	sass 		= require('gulp-sass'),
	csscomb 	= require('gulp-csscomb'),
	notify		= require('gulp-notify'),
	plumber		= require('gulp-plumber'),
	pug			= require('gulp-pug');

gulp.task('server', ['sass', 'pug'], function() {
	browserSync.init({
		server: { baseDir: './dist/' }
	});
	gulp.watch('app/sass/**/*.sass', ['sass']);
	gulp.watch('app/pug/**/*.pug', ['pug']);
});

gulp.task('sass', function() {
	return gulp.src('./app/sass/styles.sass')
		.pipe(plumber({
			errorHandler: notify.onError(function(err) {
				return {
					title: 'Styles',
					message: err.message
				}
			})
		}))
		.pipe(sass())
		.pipe(gulp.dest('./dist/css'))
		.pipe(browserSync.stream());
});

gulp.task('pug', function() {
	return gulp.src('./app/pug/2_pages/*.pug')
		.pipe(plumber({
			errorHandler: notify.onError(function(err) {
				return {
					title: 'HTML',
					message: err.message
				}
			})
		}))
		.pipe(pug({
			pretty: true
		}))
		.pipe(gulp.dest('./dist/'))
		.pipe(browserSync.stream());
});

gulp.task('default', ['server']);