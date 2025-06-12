const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass')); // Using Dart Sass

gulp.task('styles', function () {
  return gulp.src('src/scss/**/*.scss')
    .pipe(sass({ outputStyle: 'expanded' }).on('error', sass.logError))
    .pipe(gulp.dest('dist/css'));
});