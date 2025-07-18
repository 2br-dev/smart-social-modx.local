//= ::::::::::::: DECLARATIONS::::::::::::::::::: =//

const gulp = require("gulp");

//= STYLES ==========================================
const nodeSass = require("sass");
const gulpSass = require("gulp-sass");
const sass = gulpSass(nodeSass);
const autoprefixer = require("autoprefixer");
const postcss = require("gulp-postcss");

//= JAVASCRIPT ======================================
const webpack = require("webpack-stream");

//= HTML ============================================
const include = require("gulp-file-include");
const beautify = require("gulp-html-beautify");
const browserSync = require("browser-sync");

const sync = browserSync.init({
	proxy: "http://smart-social.modx.local"
});

//= ::::::::::::::::::: TASKS :::::::::::::::::::: =//
//= Styles ===========================================
gulp.task("scss", () => {
	return gulp
		.src("./src/scss/**/*.scss")
		.pipe(
			sass({
				includePaths: ["node_modules"],
				errLogToConsole: true,
			})
		)
		.pipe(postcss([autoprefixer()]))
		.pipe(gulp.dest("./release/assets/css"))
		.pipe(sync.stream());
});

//= HTML =============================================
gulp.task("html", () => {
	return gulp
		.src("./src/html/*.html")
		.pipe(include())
		.pipe(
			beautify({
				indentSize: 4,
				indentChar: "\t",
			})
		)
		.pipe(gulp.dest("./release/"))
		.pipe(sync.stream());
});

//= JAVASCRIPT =======================================
gulp.task("java", () => {
	return gulp
		.src("./src/ts/master.ts")
		.pipe(webpack(require("./webpack.config.js")))
		.pipe(gulp.dest("release/assets/js/"))
		.pipe(sync.stream());
});

//= WATCH ============================================
gulp.task("watch", () => {
	gulp.watch("./src/scss/**/*.scss", gulp.series("scss"));
	gulp.watch("./src/html/**/*.html", gulp.series("html"));
	gulp.watch("./src/ts/**/*.*", gulp.series("java"));
});
