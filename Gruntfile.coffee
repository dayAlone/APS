module.exports = (grunt)->

	isArray = Array.isArray || ( value ) -> return {}.toString.call( value ) is '[object Array]'

	loadPlugins = (x)->
		str = './bower_components'
		data =
			css : []
			js  : []
		
		plugins =
			jquery :
				js : '/jquery/dist/jquery.js'
			bootstrap :
				js  : ['/bootstrap/js/transition.js', '/bootstrap/js/modal.js', '/bootstrap/js/tab.js']
				css : '/../sources/css/bootstrap.css'
			slick :
				js  : '/slick/slick/slick.js'
				css : '/slick/slick/slick.css'
			blurjs:
				js : '/blurjs/blur.js'
			html2canvas:
				js: '/html2canvas/build/html2canvas.js'
			spin :
				js : ['/spin.js/spin.js', '/spin.js/jquery.spin.js']
			prettyPhoto :
				js  : '/prettyPhoto/js/jquery.prettyPhoto.js'
				css : '/prettyPhoto/css/prettyPhoto.css'
			parsley :
				js  : '/parsleyjs/dist/parsley.js'
			fotorama :
				js : '/fotorama/fotorama.js'
				css : '/fotorama/fotorama.css'
			tooltip:
				js : '/tooltip/js/tooltip.js'
			mask :
				js  : '/jQuery-Mask-Plugin/jquery.mask.js'
			history :
				js  : '/history.js/scripts/bundled/html4+html5/jquery.history.js'
			hypher:
				js  : [
					  '/hypher/dist/jquery.hypher.js'
					  '/hypher_lib/dist/browser/ru.js'
				]
			cookie :
				js  : '/jquery.cookie/jquery.cookie.js'
			velocity :
				js  : [
						'/velocity/velocity.js'
						'/velocity/velocity.ui.js'
					]
			isotope :
				js : '/isotope/dist/isotope.pkgd.js' 
			bem :
				js : '/jquery.bem/jquery.bem.js'
			chosen :
				js : '/chosen/chosen.jquery.js'
			browser :
				js : '/jquery.browser/dist/jquery.browser.js'
			hoverIntent :
				js : '/hoverIntent/jquery.hoverIntent.js'
			imagesLoaded :
				js : '/imagesloaded/imagesloaded.pkgd.js'

		for i in x
			elm = plugins[i]
			for key of elm
				if isArray elm[key]
					for z in elm[key]
						data[key].push str+z
				else
					data[key].push str+elm[key]
		return data

	grunt.initConfig
		pkg: grunt.file.readJSON 'package.json'

		# Переменные папок
		path:
			sources : 'sources'
			layout  : 'public_html/layout'

		use : loadPlugins [ 'jquery', 'bootstrap', 'browser', 'fotorama', 'imagesLoaded', 'bem', 'hoverIntent', 'spin', 'velocity', 'parsley' ]

		files:
			css:
				frontend : '<%= path.layout %>/css/frontend.css'
				tmp      : '<%= path.sources %>/css/plugins.css'
				develop  : '<%= path.sources %>/css/style.styl'
				plugins  : '<%= use.css %>'
				sources : [
							'<%= path.sources %>/css/plugins.css'
							'<%= path.sources %>/css/style.css'
					]
			js:
				frontend : '<%= path.layout %>/js/frontend.js'
				tmp      : '<%= path.sources %>/js/plugins.js'
				develop  : '<%= path.sources %>/js/script.coffee'
				plugins  : '<%= use.js %>'
				sources  : [
							'<%= path.sources %>/js/plugins.js'
							'<%= path.sources %>/js/script.js'
						]


		# Настройка уведомлений
		notify_hooks: 
			options:
				enabled: true
				max_jshint_notifications: 5
		notify:
			css:
				options:
					title: 'CSS Compile Complete'
					message: 'Stylus, CSS Comb, CSS Min, Autoprefixee & Concat finished running'
			js:
				options:
					title: 'JavaScript Compile Complete'
					message: 'CoffeScript, Concat & Uglify finished running'
			image:
				options:
					title: 'Images Compile Complete'
					message: 'ImageMin finished running'
			svg:
				options:
					title: 'SVG Files Compile Complete'
					message: 'SVGMin finished running'
			html:
				options:
					title: 'HTMLs Compile Complete'
					message: 'Jade finished running'

		# Оптимизируем SVG
		svgmin:
			options: 
				plugins: [{ moveGroupAttrsToElems: false },
						{ removeViewBox: false },
						{ removeUselessStrokeAndFill: false },
						{ cleanupIDs: false }, 
						{ removeComments: true }, 
						{ moveGroupAttrsToElems: false },
						{ convertPathData: { straightCurves: false}}
						]
			dist:
				files: [{
					expand: true
					cwd: '<%= path.sources %>/images/svg/'
					src: ['**/*.svg']
					dest: '<%= path.layout %>/images/svg/'
				}]

		'string-replace':
			inline: 
				files: [{
					expand: true
					cwd: '<%= path.layout %>/images/svg/'
					src: ['**/*.svg']
					dest: '<%= path.layout %>/images/svg/'
				}]
				options:
					replacements: [{
						pattern: '<desc>Created with Sketch.</desc>'
						replacement: ''
					},{
						pattern: /<title>(.*)<\/title>/ig
						replacement: ''
					}]

		# Копирование картинок из плагинов
		copy:
			main:
				files: [
					{ expand: true, flatten: true, src: ['./bower_components/bootstrap/dist/css/bootstrap.css.map'], dest: '<%= path.layout %>/css/', filter: 'isFile' }
					{ expand: true, flatten: true, src: ['./bower_components/prettyPhoto/images/prettyPhoto/default/*.png'], dest: '<%= path.sources %>/images/plugins/', filter: 'isFile' }
					{ expand: true, flatten: true, src: ['./bower_components/fotorama/*.png'], dest: '<%= path.sources %>/images/plugins/', filter: 'isFile' }
				]

		# Уменьшение размера изображений
		imagemin:
			png:
				options: 
					optimizationLevel: 7
				files: [{
					expand: true
					cwd: '<%= path.sources %>/images/'
					src: ['**/*.png']
					dest: '<%= path.layout %>/images/'
					}]
			jpg:
				options: 
					progressive: true
				files: [{
					expand: true
					cwd: '<%= path.sources %>/images/'
					src: ['**/*.jpg']
					dest: '<%= path.layout %>/images/'
					}]


		# Собираем JS и CSS в один файл
		concat:
			js_plugins:
				src  : ['<%= files.js.plugins %>']
				dest : '<%= files.js.tmp %>'
				options:
					separator: ';'
			js_frontend:
				src  : ['<%= files.js.sources %>']
				dest : '<%= files.js.frontend %>'
				options:
					separator: ';'
			css_plugins:
				src  : ['<%= files.css.plugins %>']
				dest : '<%= files.css.tmp %>'
				options:
					separator: ';'
			css_stylus:
				src : ['<%= path.sources %>/css/import/**/*.styl', '<%= path.sources %>/css/import/*.styl']
				dest : '<%= path.sources %>/css/style.styl'
			css_frontend:
				src  : ['<%= files.css.sources %>']
				dest : '<%= files.css.frontend %>'

		# Конвертируем Stylus -> CSS
		stylus:
			options:
				compress: false
			compile:
				files:
					'<%= path.sources %>/css/style.css' : '<%= path.sources %>/css/style.styl'

		# Конвертируем CoffeeScript -> JavaScript
		coffee:
			options:
				bare: false
			compile:
				files: 
					'<%= path.sources %>/js/script.js' : ['<%= files.js.develop %>']

		less:
		  bootstrap:
		    options:
		      paths: ['<%= path.sources %>/css/bootstrap/']
		    files:
		      "<%= path.sources %>/css/bootstrap.css": "<%= path.sources %>/css/bootstrap/bootstrap.less"
		  modal:
		    options:
		      paths: ['<%= path.layout %>/css/']
		    files:
		      "<%= path.layout %>/css/modals.css": "<%= path.sources %>/css/bootstrap/modals.less"
		    

		# Причесываем CSS
		csscomb:
			css_frontend:
				files:
					'<%= files.css.frontend %>' : [ '<%= files.css.frontend %>' ]

		# Сжимаем CSS
		cssmin:
			options:
				keepSpecialComments: 0
				report: 'gzip'
			css_frontend:
				files:
					'<%= files.css.frontend %>' : [ '<%= files.css.frontend %>' ]

		# Сжимаем JS
		uglify:
			options:
				mangle: true
				compress: true
				report: 'gzip'
			frontend:
				files:
					'<%= files.js.frontend %>' : [ '<%= files.js.frontend %>' ]


		# Генерируем HTML страницы
		jade:
			compile:
				options:
					pretty: true
					#data: 
						#products : grunt.file.readJSON('./sources/html/includes/products.json')
				files:	[{
					expand : true
					cwd    : '<%= path.sources %>/html/'
					src    : ['**/*.jade', '!**/includes/**']
					dest   : '<%= path.layout %>/../'
					ext    : '.html'
				}]
		
		# Конвертируем шрифты
		ziti:
			convert_only:
				options:
					deleteCharsFile: true
				files: [{
					expand : true
					cwd    : '<%= path.sources %>/fonts/'
					src    : ['**/*.ttf']
					dest   : '<%= path.layout %>/fonts/'
				}]

		# Удаляем лишние файлы
		clean: ['<%= files.css.develop %>', '<%= path.sources %>/css/style.css', '<%= files.js.sources %>']

		# Бдим за изменениями и все пересобираем при необходимости
		watch:
			js_frontend:
				files   : ['<%= files.js.sources %>', '<%= files.js.develop %>']
				tasks   : ['coffee', 'concat:js_frontend', 'notify:js' ]
				options :
						livereload: true
			css_frontend:
				files   : ['<%= files.css.sources %>', '<%= files.css.develop %>', '<%= path.sources %>/css/import/*.styl', '<%= path.sources %>/css/import/**/*.styl']
				tasks   : ['concat:css_stylus', 'stylus', 'concat:css_frontend', 'notify:css' ]
				options :
						livereload: true
			images:
				files: ['<%= path.sources %>/images/**/*.jpg', '<%= path.sources %>/images/**/*.png']
				tasks   : ['newer:copy', 'newer:imagemin', 'notify:image' ]
				options :
						livereload: true
			
			svg:
				files   : ['<%= path.sources %>/images/svg/*.svg']
				tasks   : ['newer:svgmin', 'jade', 'string-replace', 'notify:svg' ]
				options :
						livereload: true
			
			html:
				files   : ['<%= path.sources %>/html/*.jade', '<%= path.sources %>/html/**/*.jade']
				tasks   : ['jade', 'notify:html']
				options :
						livereload: true

	
	
	require('load-grunt-tasks')(grunt);
	
	grunt.registerTask 'default', ['watch']

	grunt.registerTask 'svg', ['svgmin', 'string-replace', 'jade']
	
	grunt.registerTask 'compile', ['copy', 'imagemin', 'svgmin', 'string-replace', 'less', 'concat:css_stylus', 'stylus', 'coffee', 'concat:js_plugins', 'concat:js_frontend','concat:css_plugins', 'concat:css_frontend', 'csscomb', 'cssmin', 'uglify']#, 'jade']

	grunt.registerTask 'front', ['copy', 'less', 'concat:css_stylus', 'stylus', 'coffee', 'concat:js_plugins', 'concat:js_frontend', 'concat:css_plugins', 'concat:css_frontend', 'csscomb', 'cssmin', 'uglify', 'jade']

	grunt.task.run 'notify_hooks'
