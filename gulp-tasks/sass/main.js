var sass = require("gulp-sass");
var autoprefixer = require("gulp-autoprefixer");

module.exports = function(gulp, callback) {
   return gulp
      .src(
         [
            "bootstrap.scss",
            "bootstrap-extended.scss",
            "material.scss",
            "material-extended.scss",
            "colors.scss",
            "material-colors.scss",
            "components.scss"
         ],
         {
            cwd: config.source.sass
         }
      )
      .pipe(sass().on("error", sass.logError))
      .pipe(
         autoprefixer({
            browsers: config.autoprefixerBrowsers,
            cascade: false
         })
      )
      .pipe(gulp.dest(config.destination.css));
};
