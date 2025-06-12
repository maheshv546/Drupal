/**
 * Gulp transform stream that ensures a trailing newline is present
 * at the end of CSS files. This is useful because Dart Sass (used in
 * gulp-sass 6+) removes trailing blank lines when using compressed output.
 *
 * This function checks if the file buffer ends with a newline, and if not,
 * it appends one. It only operates on buffer-based files (not streams).
 *
 * @returns {Stream.Transform} A through2 transform stream for Gulp pipelines.
 */
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