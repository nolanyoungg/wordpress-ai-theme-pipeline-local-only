/* eslint-env node */
"use strict";

var gulp = require("gulp");
var plumber = require("gulp-plumber");
var rename = require("gulp-rename");
var sourcemaps = require("gulp-sourcemaps");
var postcss = require("gulp-postcss");
var sass = require("gulp-sass")(require("sass"));
var terser = require("gulp-terser");
var autoprefixer = require("autoprefixer");
var cssnano = require("cssnano");

var paths = {
	scssEntry: "assets/src/scss/theme.scss",
	scssWatch: "assets/src/scss/**/*.scss",
	jsEntry: "assets/src/js/theme.js",
	jsWatch: "assets/src/js/**/*.js",
	distCss: "assets/dist/css",
	distJs: "assets/dist/js"
};

function styles() {
	return gulp
		.src(paths.scssEntry, { allowEmpty: true })
		.pipe(plumber())
		.pipe(sourcemaps.init())
		.pipe(
			sass({
				outputStyle: "expanded",
				includePaths: ["assets/src/scss"]
			}).on("error", sass.logError)
		)
		.pipe(postcss([autoprefixer(), cssnano()]))
		.pipe(rename({ basename: "theme", suffix: ".min" }))
		.pipe(sourcemaps.write("."))
		.pipe(gulp.dest(paths.distCss));
}

function scripts() {
	return gulp
		.src(paths.jsEntry, { allowEmpty: true })
		.pipe(plumber())
		.pipe(sourcemaps.init())
		.pipe(
			terser({
				compress: true,
				mangle: true
			})
		)
		.pipe(rename({ basename: "theme", suffix: ".min" }))
		.pipe(sourcemaps.write("."))
		.pipe(gulp.dest(paths.distJs));
}

var build = gulp.series(gulp.parallel(styles, scripts));

function watch() {
	gulp.watch(paths.scssWatch, styles);
	gulp.watch(paths.jsWatch, scripts);
}

exports.styles = styles;
exports.scripts = scripts;
exports.build = build;
exports.watch = gulp.series(build, watch);
exports.default = build;

