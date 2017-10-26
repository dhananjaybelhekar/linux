var gulp = require('gulp');
var pug = require('gulp-pug');
var watch = require('gulp-watch');
var htmlbeautify = require('gulp-html-beautify');

var concat = require('gulp-concat');
var gulpCopy = require('gulp-copy');
var cssnano = require('gulp-cssnano');

//livereload = require('gulp-livereload');
var uglify = require('gulp-uglify');
var pump = require('pump');


gulp.task('style', function() {
  return gulp.src([
      'bower_components/bootstrap/dist/css/bootstrap.css',
//   'bower_components/bootstrap/dist/css/bootstrap-grid.css'
])
      .pipe(cssnano())
      .pipe(gulp.dest('./app/src/'));
});
gulp.task('stylevendor', function() {
  return gulp.src('./app/src/*.css')
    .pipe(concat('vendor.css'))
    .pipe(gulp.dest('./public/style/'));
 });
gulp.task('vendor', function() {
    return gulp.src([
        'bower_components/angular/angular.js',
        'bower_components/angular-resource/angular-resource.js',
        'bower_components/angular-animate/angular-animate.js',
        'bower_components/angular-touch/angular-touch.js',
        'bower_components/angular-sanitize/angular-sanitize.js',
        'bower_components/angular-bootstrap/ui-bootstrap-tpls.js'

        // 'bower_components/angular-ui-router/release/angular-ui-router.js',
        // 'bower_components/angular-resource/angular-resource.js',
        // 'bower_components/lodash/lodash.js'
        ])
      .pipe(concat('vendor.js'))
      .pipe(gulp.dest('./app/src/'));
  });


  gulp.task('uglify', function (cb) {
    pump([
          gulp.src('app/src/*.js'),
          uglify(),
          gulp.dest('./public/js/')
      ],
      cb
    );
  });

// gulp.task('module', function() {
//     return gulp.src(['app/**/*.module.js'])
//       .pipe(concat('module.js'))
//       .pipe(gulp.dest('./public/js/'));
//   });

//   gulp.task('controller', function() {
//     return gulp.src(['app/**/*.controller.js'])
//       .pipe(concat('controller.js'))
//       .pipe(gulp.dest('./public/js/'));
//   });


// gulp.task('html', function(){
//    var op ={"indent_size": 4, "html": {"end_with_newline": true, "js": {"indent_size": 2 }, "css": {"indent_size": 2 } }, "css": {"indent_size": 1 }, "js": {"preserve-newlines": true } }; 
   
//    return gulp.src('app/**/*.pug')    
//     .pipe(pug())
//   //  .pipe(htmlbeautify(op))
//     .pipe(gulp.dest('./application/views/templates/'));
// });


// gulp.task('default', ['style','stylevendor','vendor','uglify','html','module','controller'],function(){
//     gulp.watch('app/**/*.pug', function() {
//       gulp.run('html');
//    });

//    gulp.watch('app/**/*.module.js', function() {
//     gulp.run('module');
//  });
//  gulp.watch('app/**/*.controller.js', function() {
//     gulp.run('controller');
//  });

// });

gulp.task('default', [ 'style','stylevendor','vendor','uglify']);
