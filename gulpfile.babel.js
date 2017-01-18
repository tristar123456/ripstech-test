import gulp from 'gulp';
import del from 'del';
import * as tasks from 'gulp-modern-tasks';

const isProduction = process.env.NODE_ENV === 'production'; // eslint-disable-line no-process-env
const assetPath = './assets';
const distPath = './web/dist';

const jsOpts = {
  files: [`${assetPath}/js/index.js`],
  outPath: `${distPath}/js`,
  isProduction,
};

const sassOpts = {
  source: `${assetPath}/scss/main.scss`,
  outPath: `${distPath}/css`,
  watch: `${assetPath}/scss/**/*.scss`,
  isProduction,
};

gulp.task('compile:js', ['clean:js'], () => tasks.compileJS(jsOpts));
gulp.task('compile:sass', ['clean:sass'], () => tasks.compileSASS(sassOpts));

gulp.task('clean:js', () => del(`${distPath}/js/**/*`));
gulp.task('clean:sass', () => del(`${distPath}/css/**/*`));

gulp.task('watch', () => {
  global.watch = true;

  gulp.watch(sassOpts.watch, ['compile:sass']);
  tasks.compileJS(jsOpts);
});

gulp.task('default', ['compile:sass', 'compile:js']);
