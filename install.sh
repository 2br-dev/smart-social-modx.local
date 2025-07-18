clear
#Initialize yarn project
echo "Установка Yarn ==============================================="
yarn init

#Create file system
echo "Формирование файловой системы================================="
mkdir -p ./src/html/data
mkdir -p ./src/html/parts
mkdir -p ./src/scss/frameworks
mkdir -p ./src/scss/parts
mkdir -p ./src/scss/pages
mkdir -p ./src/ts/lib
mkdir -p ./release/css
mkdir -p ./release/js
mkdir -p ./release/img
mkdir -p ./release/fonts

#Install Gulp
echo "Основные компоненты=========================================="
yarn add --dev gulp browser-sync

echo "Компоненты для работы со стилями============================="
yarn add --dev gulp-sass sass postcss

echo "Компоненты для работы с JavaScript==========================="
yarn add --dev @babel/core @babel/preset-env @babel/preset-typescript babel-loader webpack webpack-stream gulp-sourcemaps jquery swiper vanilla-lazyload

echo "Компоненты для работы с HTML================================="
yarn add --dev gulp-file-include gulp-html-beautify

echo "Запись webpack.config.js====================================="
tee -a webpack.config.js > /dev/null <<EOT
const { webpack, ProvidePlugin } = require("webpack");
const path = require('path');

module.exports = {
	devtool: 'inline-source-map',
	output: {
		path: path.resolve(__dirname, 'src'),
		filename: 'master.js'
	},
	mode: "development",
	resolve: {
		extensions: ['.ts', '.tsx', '.js']
	},
	module: {
		rules:[{
			test: /\.ts?$/,
			loader: 'babel-loader',
		}]
	},
	plugins: [
		new ProvidePlugin({
			$: "jquery",
			jQuery: "jquery",
			'window.$': 'jquery',
			'window.jQuery': 'jquery'
		})
	],
}
EOT

echo "Запись gulpfile.js========================================"
tee -a gulpfile.js > /dev/null <<EOT
//= ::::::::::::: DECLARATIONS::::::::::::::::::: =//

const gulp = require('gulp');

//= STYLES ==========================================
const nodeSass = require('sass');
const gulpSass = require('gulp-sass');
const sass = gulpSass(nodeSass);
const autoPrefixer = require('gulp-autoprefixer');


//= JAVASCRIPT ======================================
const webpack = require('webpack-stream');


//= HTML ============================================
const include = require('gulp-file-include');
const beautify = require('gulp-html-beautify');
const sync = require('browser-sync').init({
	server: {
		baseDir: './release/'
	}
});

//= ::::::::::::::::::: TASKS :::::::::::::::::::: =//
//= Styles ===========================================
gulp.task('scss', () => {
	return gulp.src('./src/scss/**/*.scss')
		.pipe(sass({
			includePaths: ['node_modules']
		}))
		.pipe(autoprefixer())
		.pipe(gulp.dest('./release/css'))
		.pipe(sync.stream());
})

//= HTML =============================================
gulp.task('html', () => {
	return gulp.src('./src/html/*.html')
		.pipe(include())
		.pipe(beautify({
			indentSize: 4,
			indentChar: '\t'
		}))
		.pipe(gulp.dest('./release/'))
		.pipe(sync.stream())
})

//= JAVASCRIPT =======================================
gulp.task('java', () => {
	return gulp.src('./src/ts/master.ts')
		.pipe(webpack(require('./webpack.config.js')))
		.pipe(gulp.dest('release/js/'))
		.pipe(sync.stream())
});

//= WATCH ============================================
gulp.task('watch', () => {
	gulp.watch('./src/scss/**/*.scss', gulp.series('scss'));
	gulp.watch('./src/html/**/*.html', gulp.series('html'));
	gulp.watch('./src/ts/**/*.*', gulp.series('java'));
})
EOT

echo "Запись .babelrc=========================================="
tee .babelrc > /dev/null <<EOT
{
	"presets": [
		"@babel/preset-env",
		"@babel/preset-typescript"
	]
}
EOT

echo "Установка успешно завершена!"