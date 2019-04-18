//requires
var gulp = require('gulp');
var del = require('del'); //delete
var args = require('minimist'); //get arguments from cmdline
var sass = require('gulp-sass'); //deal with sass
var autoprefixer = require('gulp-autoprefixer'); //autoprefixer
var cssnano = require('gulp-cssnano'); //optimize css
var inlinesource = require('gulp-inline-source'); //inline css
var uglify = require('gulp-uglify-es').default; //uglify and minify
var concat = require('gulp-concat'); //concact files
var babel = require('gulp-babel'); // es6 transpiler babel it
var htmlmin = require('gulp-htmlmin'); //html minifier
var {phpMinify} = require('@cedx/gulp-php-minify'); //php min
var imagemin = require('gulp-imagemin'); //imagemin
var postcss = require('gulp-postcss'); //postcss
var mqExtract = require('postcss-mq-extract'); //extract mq queries


//config values 
const paths = {
  "css": "src/css/",
  "js" : "src/js/",
  "media" : "src/media/",
  "html" : "src/",
  "dist" : "../",
  "build" : "../"
}
//default output
let output = paths.dist;
//autoprefixer
var autoprefixerOptions = { browsers: ['last 2 versions', '> 5%'] };
var cssnanoOptions = { zindex: false };
//###################### gulp stuff 

//SASS + CSS
gulp.task('styles', function () {
  //bundle together
  gulp.src(paths.css + 'style.scss')
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(cssnano(cssnanoOptions))
    .pipe(autoprefixer(autoprefixerOptions))
    .pipe(gulp.dest(output + 'assets/css/'));
  //each separated
  return gulp.src(paths.css + 'unique/*.*css')
    .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
    .pipe(cssnano(cssnanoOptions))
    .pipe(autoprefixer(autoprefixerOptions))
    .pipe(gulp.dest(output + 'assets/css/'));
 
});


//inline css and inline javascript
//<link rel="stylesheet" href="/assets/css/style.css" inline>
//<script src="teste.js" inline></script>
gulp.task('inline', function () {
  console.log('injecting inline css and js in if inline> is used' );
    return gulp.src([output + 'index.*', output + 'header.*'])
      .pipe(inlinesource())
      .pipe(gulp.dest(output));
});

//JS
gulp.task("minjs", function () {
   //concat, uglify, babel
   gulp.src(paths.js + '*.js')
    .pipe(concat('app.js'))
    .pipe(babel({ presets: ['@babel/env']}))
    .pipe(uglify( /* options */ ))
    .pipe(gulp.dest(output + 'assets/js/'));

    gulp.src(paths.js + 'vendor/*.js')
    //.pipe(babel({ presets: ['@babel/env']}))
    //.pipe(uglify(/* options */))
    .pipe(gulp.dest(output + 'assets/js/'));

  //direct copy from unique
  return gulp.src(paths.js + 'unique/*.js')
    .pipe(babel({ presets: ['@babel/env']}))
    .pipe(uglify(/* options */))
    .pipe(gulp.dest(output + 'assets/js/'));

});
//direct copy with no uglify/babel
gulp.task("servejs", function () {
   //concat, uglify, babel
   gulp.src(paths.js + '*.js')
    .pipe(concat('app.js'))
    //.pipe(babel({ presets: ['@babel/env']}))
    //.pipe(uglify( /* options */ ))
    .pipe(gulp.dest(output + 'assets/js/'));

  //direct copy from unique
  return gulp.src(paths.js + 'unique/*.js')
    //.pipe(babel({ presets: ['@babel/env']}))
    //.pipe(uglify(/* options */))
    .pipe(gulp.dest(output + 'assets/js/'));
});

//HTML+PHP minify
gulp.task("minhtml", function () {
  //direct copy not .html/php and not from js, media, css
  gulp.src(['!' + paths.html + '/css/**', '!' + paths.html + '/js/**', '!' + paths.html + '/media/**', paths.html + '**/*.*(css|csv|sql|ico|manifest|json)'])
    .pipe(gulp.dest(output));
  //minify html in html/php
  return gulp.src([paths.html + '**/*.{html,php}'])
    .pipe(htmlmin({
      collapseWhitespace: true,
      removeComments: true,
      ignoreCustomFragments: [/<\?[\s\S]*?(?:\?>|$)/]
    }))
    .pipe(gulp.dest(output));
  //minify pure php
  return gulp.src(paths.html + '**/*.php', {read: false})
    .pipe(phpMinify({silent: false}))
    .pipe(gulp.dest(output));
});
//direct copy html/php
gulp.task("servehtml", function () {
  //copy all except from folders css, js, media
  return gulp.src([paths.html + '**/*.*', '!' + paths.html + '/css/**', '!' + paths.html + '/js/**', '!' + paths.html + '/media/**'])
    .pipe(gulp.dest(output));
});


//images
gulp.task("minimages", function () {
  return gulp.src(paths.media + '**/*.*')
    .pipe(imagemin([
            imagemin.gifsicle({ interlaced: true,optimizationLevel: 3, optimize: 3, lossy: 2}),
            imagemin.jpegtran({progressive: true, quality: 80}),
            imagemin.optipng({optimizationLevel: 5}),
            imagemin.svgo({ plugins: [ {removeViewBox: true}, {cleanupIDs: false} ]})
            ], { verbose: true }))
    .pipe(gulp.dest(output + 'assets/media/'));
});
//direct images
gulp.task("directimg", function () {
  return gulp.src(paths.media + '**/*.*').pipe(gulp.dest(output + 'assets/media/'));
});

//Other files in other dirs, direct
gulp.task("restOfFiles", function () {
  return gulp.src(['!' + paths.html + '**/*.{php,html}', '!' + paths.html + '/css/**', '!' + paths.html + '/js/**', paths.html + '**/*.*'])
    .pipe(gulp.dest(output));
});


//extract MQ
gulp.task('mqextract', function () {
  var processors = [
    //sm verify style.scss
    mqExtract({
      dest: output + 'assets/css/mq/',
      match: '(min-width:410px)',
      postfix: '-phone',
    }),
    //md verify style.scss
    mqExtract({
      dest: output + 'assets/css/mq/',
      match: '(min-width:720px)',
      postfix: '-tablet',
    }),
    //lg verify style.scss
    mqExtract({
      dest: output + 'assets/css/mq/',
      match: '(min-width:1240px)',
      postfix: '-large',
    })
  ];
  return gulp.src(output + 'assets/css/style.css')
    .pipe(postcss(processors))
    .pipe(gulp.dest(output + 'assets/css/mq/'));
});


//liveserver
gulp.task('clean', function(){ return del(output);});

//build
gulp.task('build',  function(){ 
  //set build output
  output = paths.build;
  return build();
});

let build = gulp.series(['clean', 'styles', 'mqextract', 'minjs', 'minhtml', 'inline', 'minimages']);
let serve = gulp.series(['styles', 'minjs', 'minimages', 'servehtml','mqextract']);

//live development
gulp.task('serve', function() {
  serve();
  gulp.watch(paths.css + '**/*.*css', gulp.series('styles'));
  gulp.watch(paths.js + '**/*.js', gulp.series('minjs'));
  gulp.watch(paths.media + '**/*.*', gulp.series('directimg'));
  gulp.watch([paths.html + '**/*.php', paths.html + '**/*.html'], gulp.series('servehtml'));
  return console.log("Watching.... ");
});


//store
var options = args(process.argv.slice(2));
//gulp serve
//gulp serve --live=localhost/x
//gulp build
//gulp build --inlinecss=index.html --inlinejs=index.html
//console.log(options);
//gulp serve --teste=html
//options.inlinecss = 'index.html';