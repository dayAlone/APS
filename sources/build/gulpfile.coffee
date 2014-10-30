gulp       = require 'gulp'
nib        = require 'nib'
data       = require 'gulp-data'
csscomb    = require 'gulp-csscomb'
cssmin     = require 'gulp-cssmin'
stylus     = require 'gulp-stylus'
coffee     = require 'gulp-coffee'
concat     = require 'gulp-concat'
gutil      = require 'gulp-util'
uglify     = require 'gulp-uglify'
watch      = require 'gulp-watch'
less       = require 'gulp-less'
sequence   = require 'run-sequence'
livereload = require 'gulp-livereload'

plugins  = [ 'jquery', 'bootstrap', 'browser', 'fotorama', 'imagesLoaded', 'bem', 'hoverIntent', 'spin', 'velocity', 'parsley' ]

layout   = './public_html/layout'
sources  = './sources/'

path     =
	css:
		frontend : "#{layout}/css/"
		sources  : "#{sources}/css/"
	js:
		frontend : "#{layout}/js/"
		sources  : "#{sources}/js/"

isArray = Array.isArray || ( value ) -> return {}.toString.call( value ) is '[object Array]'

loadPlugins = (x, y)->
	data =
		css : []
		js  : []
	
	bower   = './bower_components'
	plugins = require('./plugins.json')
	for i in x
		elm = plugins[i]
		for key of elm
			if isArray elm[key]
				for z in elm[key]
					data[key].push bower+z
			else
				data[key].push bower+elm[key]
	return data[y]

# JavaScript functions

gulp.task 'js_plugins', ->
	gulp.src loadPlugins plugins, 'js'
	.pipe concat 'plugins.js'
	.pipe gulp.dest path.js.sources

gulp.task 'js_coffee', ->
	gulp.src [ "#{path.js.sources}/script.coffee" ]
	.pipe coffee()
	.pipe gulp.dest path.js.sources

gulp.task 'js_front', ['js_coffee'], ->
	gulp.src [ "#{path.js.sources}/plugins.js", "#{path.js.sources}/script.js" ]
	.pipe concat 'frontend.js'
	.pipe gulp.dest path.js.frontend

gulp.task 'js_mini', ->
	gulp.src [ "#{path.js.frontend}/frontend.js"]
	.pipe uglify()
	.pipe gulp.dest path.js.frontend

# CSS functions

gulp.task 'css_bootstrap', ->
	gulp.src [ "#{path.css.sources}/bootstrap/bootstrap.less" ]
	.pipe less()
	.pipe gulp.dest path.css.sources

gulp.task 'css_plugins', ->
	gulp.src loadPlugins plugins, 'css'
	.pipe concat 'plugins.css'
	.pipe gulp.dest path.css.sources

gulp.task 'css_stylus', ->
	gulp.src [ "#{path.css.sources}/style.styl" ]
	.pipe stylus 
		use: nib()
	.pipe gulp.dest path.css.sources

gulp.task 'css_front', ['css_stylus'], ->
	gulp.src [ "#{path.css.sources}/plugins.css", "#{path.css.sources}/style.css" ]
	.pipe concat 'frontend.css'
	.pipe gulp.dest path.css.frontend

gulp.task 'css_mini', ->
	gulp.src [ "#{path.css.frontend}/frontend.css"]
	.pipe csscomb()
	.pipe cssmin()
	.pipe gulp.dest path.css.frontend

gulp.task 'reload', ->
	livereload.changed()

gulp.task 'ready', ->
	sequence 'js_plugins', 'js_front', 'js_mini', 'css_bootstrap', 'css_plugins', 'css_front', 'css_mini'

gulp.task 'default', ->
	
	livereload.listen();

	gulp.watch "#{path.js.sources}/script.coffee", ->
		sequence 'js_front', 'reload'
	
	gulp.watch "#{path.css.sources}/**/*.styl", ->
		sequence 'css_front', 'reload'
	
	gulp.watch "#{path.css.sources}/bootstrap/bootstrap.less", ->
		sequence 'css_bootstrap', 'css_plugins', 'css_front', 'reload'
	
	gulp.watch ["./bower_components/**/*.js", "#{sources}/build/gulpfile.coffee"], ->
		sequence 'js_plugins', 'js_front', 'reload'













