const gulp = require('gulp');
const concat = require('gulp-concat');
const sass = require('gulp-dart-sass');
const rename = require('gulp-rename');
const uglify = require('gulp-uglify');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');

const PATH = {
	css: 'css/',
	scss: 'scss/'
};

gulp.task('taskCSS', function () {
	return gulp.src(PATH.scss + 'style.scss')
		.pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
		.pipe(postcss([
			autoprefixer({ overrideBrowserslist: ['last 2 versions'], cascade: false })
		]))
		.pipe(rename('style.css'))
		.pipe(gulp.dest(PATH.css));
});

gulp.task('watch', function () {
	gulp.watch(PATH.scss + '*.scss', gulp.series('taskCSS'));
});

gulp.task('default', gulp.series('taskCSS', 'watch'));
