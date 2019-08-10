const gulp = require('gulp')
const autoprefixer = require('gulp-autoprefixer')
const babelify = require('babelify')
const bro = require('gulp-bro')
const connect = require('gulp-connect')
const fileinclude = require('gulp-file-include')
const gap = require('gulp-append-prepend')
const htmlextend = require('gulp-html-extend')
const htmlmin = require('gulp-htmlmin')
const rename = require("gulp-rename")
const sass = require('gulp-sass')

const header = `
/*!
 * Admin 4B v2.0.0 (https://getadmin4b.com)
 * Copyright 2018 LogiQ System (https://logiqsystem.com)
 * Licensed under MIT (https://github.com/logiqsystem/admin4b/blob/master/LICENSE)
 */`

gulp.task('build-sass', () => {
  return gulp.src('src/scss/compile.scss')
    .pipe(sass({ outputStyle: 'compressed' }).on('error', (e) => console.log(e)))
    .pipe(autoprefixer({ browsers: ['last 2 versions'], cascade: false }))
    .pipe(rename({ basename: 'admin4b', extname: '.min.css' }))
    .pipe(gap.prependText(header))
    .pipe(gulp.dest('dist'))
})

gulp.task('build-js', () => {
  return gulp.src('src/js/index.js')
    .pipe(bro({
      transform: [
        babelify.configure({ presets: ['@babel/preset-env'] }),
        ['uglifyify', { global: true }]
      ]
    }))
    .pipe(rename({ basename: 'admin4b', extname: '.min.js' }))
    .pipe(gap.prependText(header))
    .pipe(gulp.dest('dist'))
})

gulp.task('build-html', () => {
  return gulp.src(['src/html/**/*.html', '!src/html/includes/**/*.html'])
    .pipe(htmlextend({
      annotations: false,
      verbose: false,
      root: './src/html'
    }).on('error', (e) => console.log(e)))
    .pipe(fileinclude({
      prefix: '@@',
      basepath: './src/html/'
    }).on('error', (e) => console.log(e)))
    .pipe(htmlmin({ collapseWhitespace: true }).on('error', (e) => console.log(e)))
    .pipe(gulp.dest('docs'))
})

gulp.task('build', gulp.parallel('build-html', 'build-sass', 'build-js'))

gulp.task('build-watching', done => {
  gulp.watch('src/html/**/*.html', gulp.series('build-html'))
  gulp.watch('src/scss/**/*.scss', gulp.series('build-sass'))
  gulp.watch('src/js/**/*.js', gulp.series('build-js'))

  done()
})

gulp.task('serve', done => {
  connect.server({ root: '.', port: 8888 })
  connect.serverClose()

  done()
})

gulp.task('start', gulp.series('serve', 'build-watching', 'build'))
