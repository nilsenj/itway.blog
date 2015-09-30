/*
 |--------------------------------------------------------------------------
 | ITWAY.IO Asset Management
 |--------------------------------------------------------------------------
 |
 */

// Grab node packages
var gulp = require('gulp'),
    connectPhp = require('gulp-connect-php'),
    browserSync = require('browser-sync');
$ = require('gulp-load-plugins')();
var merge2 = require('merge2');
var bowerMain = require('bower-main');

//Connect
gulp.task('connect', function () {
 $.connect.server({
  root: 'public',
  livereload: true,
  port: 8001
 });

});
gulp.task('connect-assets', function () {
 $.connect.server({
  root: 'resources/assets',
  livereload: true,
  port: 8002
 });

});

gulp.task('fonts', function () {
 return gulp.src('resources/assets/fonts/*')
     .pipe($.plumber())
     .pipe(gulp.dest('public/dist/fonts/'))
     .pipe($.connect.reload());
});
gulp.task('fonts-source-pro', function () {
 return gulp.src('resources/assets/fonts/Source-Sans-Pro/*')
     .pipe($.plumber())
     .pipe(gulp.dest('public/dist/fonts/Source-Sans-Pro/'))
     .pipe($.connect.reload());
});
// Compile Coffeescript
gulp.task('coffee', function () {
 return gulp.src('resources/assets/coffee/*.coffee')
     .pipe($.plumber())
     .pipe($.coffee())
     .pipe(gulp.dest('resources/assets/js/modules/'))
     .pipe($.connect.reload());
});
// Concatenate & Minify JS
gulp.task('script-modules', function () {
 return gulp.src(['resources/assets/js/modules/*.js'])
     .pipe($.plumber())
     .pipe($.concat('modules.js'))
     .pipe(gulp.dest('public/dist/js/modules'))
     .pipe($.rename('modules.min.js'))
     .pipe($.uglify())
     .pipe(gulp.dest('public/dist/js/modules'))
     .pipe($.connect.reload());
});

// Concatenate & Minify JS
gulp.task('add-scripts', function () {
 return gulp.src(['resources/assets/js/*.js'])
     .pipe($.plumber())
     .pipe($.uglify())
     .pipe(gulp.dest('public/dist/js'))
     .pipe($.connect.reload());
});

gulp.task('add-vendor-scripts', function() {
 return gulp.src('vendor/bower_components/**')
     .pipe($.plumber())
     .pipe(gulp.dest('public/dist/vendor/'))
});

gulp.task('sass', function() {
 return gulp.src(['resources/assets/sass/*.scss'])
     .pipe($.plumber())
     .pipe($.rubySass())
     .pipe(gulp.dest('public/dist/css/'))
     .pipe($.connect.reload());
});

gulp.task('autoprefix', function () {
 return gulp.src('public/dist/css/*.css')
     .pipe($.plumber())
     .pipe($.autoprefixer({
      browsers: ['> 1%', 'last 2 versions', 'Firefox ESR', 'Opera 12.1'],
      cascade: true
     }))
     .pipe(gulp.dest('public/dist/css/'));
});
gulp.task('minify-css', function () {
 return gulp.src('public/dist/css/*.css')
     .pipe($.plumber())
     .pipe($.minifyCss({
      keepBreaks: true
     }))
     .pipe($.autoprefixer({
      browsers: ['> 1%', 'last 2 versions', 'Firefox ESR', 'Opera 12.1'],
      cascade: true
     }))
     .pipe(gulp.dest('public/dist/stylesheets/'))
     .pipe($.connect.reload());
});

//gulp.task('connect-php', function() {
//    connectPhp.server({
//        hostname: "www.itway.io",
//        base: "./public"
//    }, function (){
//        browserSync({
//            proxy: 'www.itway.io'
//        });
//    });
//
//    gulp.watch('**/*.php').on('change', function () {
//        $.browser.reload();
//    });
//});



// Watch Files For Changes
gulp.task('watch', function () {
 gulp.watch('resources/assets/js/modules/*.js', ['script-modules']);
 gulp.watch('resources/assets/coffee/*.coffee', ['coffee']);
 gulp.watch('resources/assets/js/*.js', ['add-scripts']);
 gulp.watch(['resources/assets/sass/*.scss'], ['sass']);
 gulp.watch(['resources/assets/sass/**/*.scss'], ['sass']);
 gulp.watch('public/dist/css/**/*.css', ['minify-css']);
 gulp.watch('resources/assets/fonts', ['fonts', 'fonts-Source-Sans-Pro']);

});

// Default Task
gulp.task('all', [ 'connect','connect-assets', 'fonts-source-pro', 'fonts', 'sass' ,'minify-css','coffee','add-scripts','add-vendor-scripts' , 'script-modules', 'watch']);
gulp.task('default', [ 'connect','connect-assets', 'fonts-source-pro', 'sass' ,'minify-css','add-scripts', 'script-modules', 'watch']);
