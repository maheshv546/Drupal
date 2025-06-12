const through = require('through2');

function addTrailingNewline() {
  return through.obj(function (file, _, cb) {
    if (file.isBuffer()) {
      const content = file.contents.toString();
      if (!content.endsWith('\n')) {
        file.contents = Buffer.from(content + '\n');
      }
    }
    cb(null, file);
  });
}

function sass(src = options.files.sass, dest = options.paths.build + 'css/', ship = false) {
  options.sass.style = (ship ? 'compressed' : 'expanded');
  return gulp.src(src)
    .pipe($.sassGlob())
    .pipe($.if(!ship, $.sourcemaps.init()))
    .pipe(gulpSass(options.sass)
      .on('error', function (e) {
        process.stderr.write(new PluginError('sass', e.messageFormatted).toString() + '\n');
        if (!ship) { this.emit('end'); }
      })
    )
    .pipe(postcss([autoprefixer(AUTOPREFIXER_BROWSERS)]))
    .pipe(addTrailingNewline()) // 👈 Add this line
    .pipe($.if(!ship, $.sourcemaps.write()))
    .pipe(gulp.dest(dest));
}