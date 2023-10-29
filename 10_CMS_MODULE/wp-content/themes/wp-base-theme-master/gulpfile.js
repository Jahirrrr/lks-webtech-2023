const gulp = require('gulp');
const sass = require('gulp-dart-sass');
const notify = require('gulp-notify');
const plumber = require('gulp-plumber');
const autoprefixer = require('gulp-autoprefixer');
const imagemin = require('gulp-imagemin');
const cleanCSS = require('gulp-clean-css');
const purgecss = require('gulp-purgecss')

// Compile scss to minified CSS file
gulp.task('scss', () => {
    return gulp.src('scss/**/*.scss')
        .pipe(sass({ outputStyle: 'compressed' }))
        .pipe(sass().on('error', sass.logError))
        .pipe(plumber({
            errorHandler: notify.onError(function (err) {
                return {
                    title: "Error",
                    message: err.message
                }
            })
        }))
        .pipe(autoprefixer({
            cascade: false
        }))
        .pipe(cleanCSS({debug: true}, (details) => {
            console.log(`${details.name}: ${Math.floor(details.stats.minifiedSize / 1024)} Kb`);
        }))
        .pipe(gulp.dest('css'));
});

// Crush any images
gulp.task('crush', () => {
    return gulp.src('img/*')
        .pipe(imagemin())
        .pipe(gulp.dest('img'))
});

// Watch scss files and compile on change
gulp.task('watch', gulp.series('scss', (done) => {
    gulp.watch('scss/**/*.scss', gulp.series('scss'));
    done();
}));

gulp.task('purgecss', () => {
    return gulp.src('src/**/*.css')
        .pipe(purgecss({
            content: ['src/**/*.html']
        }))
        .pipe(gulp.dest('build/css'))
})