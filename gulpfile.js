const gulp = require('gulp')
const sass = require('gulp-sass')
const sourcemaps = require('gulp-sourcemaps')
const babel = require('gulp-babel')

const cfg = require('./config')

// SASS related tasks
const processSass = () => {
  return gulp
    .src([
      `${cfg.blocks.src}/**/editor.scss`,
      `${cfg.blocks.src}/**/style.scss`
    ])
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(`${cfg.blocks.dest}`))
}

const watchSass = () => {
  gulp.watch([`${cfg.blocks.src}/**/*.scss`], processSass)
}

// JS related tasks

const processJS = () => {
  return gulp
    .src(`${cfg.blocks.src}/**/block.js`)
    .pipe(
      babel({
        presets: ['@babel/preset-react', '@babel/env']
      })
    )
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(`${cfg.blocks.dest}`))
}

const watchJS = () => {
  gulp.watch([`${cfg.blocks.src}/**/*.js`], processJS)
}

// Watch
const watchTask = gulp.parallel(watchSass, watchJS)

// Process
const processTask = gulp.parallel(processSass, processJS)

// default task
const defaultTask = gulp.series(processTask, watchTask)

gulp.task('default', defaultTask)
gulp.task('build', processTask)
gulp.task('watch', watchTask)
