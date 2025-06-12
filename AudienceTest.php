function sass(src = options.files.sass, dest = options.paths.build + 'css/', ship = false) {
  options.sass.style = (ship ? 'compressed' : 'expanded');
  return gulp.src(src)
    .pipe($.sassGlob())
    .pipe($.if(!ship, $.sourcemaps.init()))
    .pipe(gulpSass(options.sass)
      .on('error', function(e) {
        process.stderr.write(new PluginError('sass', e.messageFormatted).toString() + '\n');
        // if we're not shipping, hide the error by emiting success
        if (!ship) { this.emit('end'); }
      })
    )
    .pipe(postcss([autoprefixer(AUTOPREFIXER_BROWSERS)]))
    .pipe($.if(!ship, $.sourcemaps.write()))
    //.pipe($.if(ship, $.uglify)) // @TODO
    .pipe(gulp.dest(dest));
}
