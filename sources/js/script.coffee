delay = (ms, func) -> setTimeout func, ms

newsInit = false

map = undefined

size = ->
	autoHeight($('.page .tech'), '.tech__item', '.tech__title', false, true)
	if !newsInit
		newsInit = true
		$('article:not(.index-page) .news').isotope
			itemSelector: '.news__item'

urlInitial = undefined

$.openModal = (url, id, open)->
	if url
		if(open)
			$(id).modal()
		$(id).find('.text').load "/ajax#{url}", (data)->
			$('.modal .fotorama').fotorama()
			if History.enabled
				info = History.getState()
				console.log info
				urlInitial =
					url : info.cleanUrl
					title : document.title
				History.pushState {'url':url}, $(id).find('.text h1').text(), url
				window.title = $(id).find('.text h1').text()

autoHeight = (el, selector='', height_selector = false, use_padding=false, debug=false)->
	if el.length > 0
		
		item = el.find(selector)

		if height_selector
			el.find(height_selector).removeAttr 'style'
		else
			el.find(selector).removeAttr 'style'
		
		item_padding = item.css('padding-left').split('px')[0]*2
		padding      = el.css('padding-left').split('px')[0]*2
		if debug
			step = Math.round((el.width()-padding)/(item.width()+item_padding))
		else
			step = Math.round(el.width()/item.width())
		
		count = item.length-1
		loops = Math.ceil(count/step)
		i     = 0
		
		if debug
			console.log count, step, item_padding, padding, el.width(), item.width()

		while i < count
			items = {}
			for x in [0..step-1]
				items[x] = item[i+x] if item[i+x]
			
			heights = []
			$.each items, ()->
				if height_selector
					heights.push($(this).find(height_selector).height())
				else
					heights.push($(this).height())
			
			if debug
				console.log heights

			$.each items, ()->
				if height_selector
					$(this).find(height_selector).height Math.max.apply(Math,heights)
				else
					$(this).height Math.max.apply(Math,heights)

			i += step


getCaptcha = ()->
	$.get '/include/captcha.php', (data)->
		setCaptcha data

setCaptcha = (code)->
	$('input[name=captcha_code]').val(code)
	$('.captcha').css 'background-image', "url(/include/captcha.php?captcha_sid=#{code})"

addTrigger = ()->
	$('.grain-tables-table-edit-admin tbody tr:not(.triggered) td:last-of-type').each ()->
		$(this).closest('tr').addClass 'triggered'
		$(this).after "<td><a href='#' class='openMap'>Открыть карту</a></td>"

	$('#mapPopup .adm-btn-save')
		.click (e)->
			val = $('#mapPopup input[name="value"]').val()
			$("input[name='#{$(this).data('id')}']").val "#{val}"
			$('#mapPopup').modal 'hide'
			e.preventDefault()

	$('a.openMap').off('click').on 'click', (e)->
		val = $(this).closest('tr').find('input[name*=cords]').val()
		id = $(this).closest('tr').find('input[name*=cords]').attr 'name'
		
		console.log id

		$('#mapPopup .adm-btn-save').data 'id':id
		
		$('#mapPopup .modal-content .map').load "/include/map.php?ajax=1&val=#{val}", ()->
			$('#mapPopup').modal()
		
		e.preventDefault()

blur = ()->
	$('header.toolbar, article.index-page, .news__frame, .tech__item').blurjs
		source: '.wrap'
		radius: 15
		overlay: 'rgba(0,0,0,0.1)'

$(document).ready ->

	$('.search-trigger').click (e)->
		if $('.toolbar .container').width() <= 750
			$('#Search').modal()
		else
			if $('.toolbar .search-form').is ':hidden'
				$('.toolbar .search-form').velocity
					properties: "transition.slideDownIn"
					options:
						duration: 300
						complete: ()->
							$('.toolbar .search-form  .search-form__button').css 'opacity', 1
							$('.toolbar').one 'mouseleave', ()->
								$('.toolbar .search-form  .search-form__button').css 'opacity', 0
								$('.toolbar .search-form').velocity
									properties: "transition.slideUpOut"
									options:
										duration: 300
						
		e.preventDefault()

	addTrigger()

	$('a[onclick*=grain_TableAddRow]').click ()->
		addTrigger()

	$('a.captcha_refresh').click (e)->
		getCaptcha()
		e.preventDefault()

	$('.form').submit (e)->
		data = $(this).serialize()
		$.post '/include/send.php', data,
	        (data) ->
	        	data = $.parseJSON(data)
	        	if data.status == "ok"
	        		$('.form').hide()
	        		$('.form').parents('.modal').find('.success').show()
	        	else if data.status == "error"
	        		$('input[name=captcha_word]').addClass('parsley-error')
	        		getCaptcha()
		e.preventDefault()

	$('.modal').on 'show.bs.modal', (a,b)->
		url = $(a.relatedTarget).data 'url'
		id  = $(a.relatedTarget).attr 'href'
		$.openModal(url, id)
	
	$('.modal').on 'hide.bs.modal', (a,b)->
		
		$(this).find('input[type="email"], input[type="text"], textarea').removeClass('parsley-error').removeAttr("value").val("")
		$(this).find('form').trigger('reset').show()
		$(this).find('.success').hide()

		if urlInitial
			History.pushState {'url':urlInitial.url}, urlInitial.title, urlInitial.url
			window.title = urlInitial.title
		if $(this).find('iframe').length > 0
			$(this).find('iframe').remove()

	$('.lang-trigger__carriage').click (e)->
		window.location.href = 'http://argusweld.com'
		el = $(this).parents('.lang-trigger')
		variants = el.data('variant').split(',')
		$.each variants, (index, value)->
			value = value.toString()
			if el.mod('lang') != value
				el.mod('lang', value)
				return false
		e.preventDefault()

	$('.form-trigger').click (e)->
		form = $(this).parents('.modal').find('form')
		if form.is ':visible'
			form.velocity
				properties: "transition.slideUpOut"
				options:
					duration: 300
		else
			form.velocity
				properties: "transition.slideDownIn"
				options:
					duration: 300
	

	$('.dropdown').elem('item').click (e)->
		if $(this).attr('href')[0] == "#"
			$('.dropdown').elem('text').html($(this).text())
			$('.dropdown').elem('frame').velocity
					properties: "transition.slideUpOut"
					options:
						duration: 300
			e.preventDefault()
		else
			window.location.href = $(this).attr('href')


	closeDropdown = (x)->
		x.mod('open', false)
		x.elem('frame').velocity
			properties: "transition.slideUpOut"
			options:
				duration: 300

	openDropdown = (x)->
		clearTimeout timer
		text = x.elem('text').text()
		x.elem('item').show()
		x.elem('frame').find("a:contains(#{text})").hide()
		x.elem('frame').velocity
			properties: "transition.slideDownIn"
			options:
				duration: 300
				complete: ()->
					x.mod('open', true)
					timer = delay 3000, ()->
						$('.dropdown').elem('frame')
							.velocity
								properties: "transition.slideUpOut"
								options:
									duration: 300

	timer = false

	$('.modal .text').spin
		lines: 13
		length: 21
		width: 2
		radius: 24
		corners: 0
		rotate: 0
		direction: 1
		color: '#0c4ed0'
		speed: 1
		trail: 68
		shadow: false
		hwaccel: false
		className: 'spinner'
		zIndex: 2e9
		top: '50%'
		left: '50%'

	###
	initType = ()->
		$('.dropdown.type').elem('item').click (e)->
			elm = $(this).attr 'href'
			alt = $(this).parents('.dropdown').elem('frame').find("a:not([href=#{elm}])").attr('href')
			if !$(elm).is ':visible'
				$(elm).velocity
					properties: "transition.slideDownIn"
					options:
						duration: 300
						complete: ()->
							google.maps.event.trigger(map, "resize");
				$(alt).velocity
					properties: "transition.slideUpOut"
					options:
						duration: 300
	###
	$('.dropdown').elem('select').on 'change', ()->
		val = $(this).val()
		$(this).block().find("a[href='#{val}']").trigger 'click'
		$(this).mod('open', true)
	
	$('.dropdown').hoverIntent
			over : ()->
				if($(window).width()>970)
					openDropdown($(this))
				else
					$(this).elem('select').focus()
					$(this).mod('open', true)
			out : ()->
				
				if($(window).width()>970)
					closeDropdown($(this))

	$('.toolbar a.phone').click (e)->
		if $(window).width() <= 768
			$('#Contacts').modal()
			e.preventDefault()

	$('.site-select .site-select__trigger').click ()->
		p = $(this).parents('.site-select')
		if !p.mod('open')
			$('#Sites').modal()

	$('.site-select .site-select__trigger').hoverIntent
		over : ()->
			if($(window).width()>768)
				clearTimeout timer
				p = $(this).parents('.site-select')
				p.mod('open', true)
				p.elem('dropdown').velocity
					properties: "transition.slideDownIn"
					options:
						duration: 300
						complete: ()->
							timer = delay 3000, ()->
								$('.site-select')
									.mod('open', false)
									.elem('dropdown').velocity
										properties: "transition.slideUpOut"
										options:
											duration: 300
		out : ()->
			return

	$('.site-select').hoverIntent
		over : ()->
			return
		out : ()->
			p = $(this)
			p.mod('open', false)
			p.elem('dropdown').velocity
				properties: "transition.slideUpOut"
				options:
					duration: 300
	$('a.site-select__trigger').click (e)->
		if($(window).width()<768)
			$('#Sites').modal()
		e.preventDefault()

	delay 300, ()->
		size()


	mapInit = false
	$('#contactsMap').on 'shown.bs.modal', ()->
		if !mapInit
			mapInit = true
			ymaps.ready ()->
				myMap = new ymaps.Map 'map', {
					center: [55.723171,37.559856]
					zoom: 15
				}
				myPlacemark = new ymaps.Placemark myMap.getCenter(), {
					hintContent: 'Аргус СварСервис'
				},
				{
					preset: "twirl#nightDotIcon",
				}

				myMap.geoObjects.add(myPlacemark);
	
	x = undefined
	$(window).resize ->
		clearTimeout(x)
		x = delay 200, ()->
			size()
   
###
	if $('#bg_map').length > 0
		bgMapInit = ()->
			mapOptions =
				zoom: 3
				draggable: false
				zoomControl: false
				scrollwheel: false
				disableDoubleClickZoom: true
				disableDefaultUI: true
				center: new google.maps.LatLng(63.436317234268486, 67.10492205969675)
				styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":0}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]}]

			mapElement = document.getElementById('bg_map')
			map = new google.maps.Map(mapElement, mapOptions)

			cords = [
				new google.maps.LatLng(67.074532, 71.069804),
				new google.maps.LatLng(65.880861, 73.003398),
				new google.maps.LatLng(65.372506, 77.222148),
				new google.maps.LatLng(63.157574, 104.819804),
				new google.maps.LatLng(59.88725, 110.972148),
				new google.maps.LatLng(55.865354, 125.561991),
				new google.maps.LatLng(56.93747, 148.237773),
				new google.maps.LatLng(58.258556, 151.401835)
			]

			circle =
				path: google.maps.SymbolPath.CIRCLE
				strokeColor: 'transparent'
				fillColor: '#FFF'
				scale: 4.5
				fillOpacity: 1

			$.each cords, ()->
				marker = new google.maps.Marker
					position: this
					icon: circle
					map: map
				google.maps.event.addListener marker, 'click', ()->
					$('#markerDetail').modal()

			path = new google.maps.Polyline
				path: cords
				geodesic: true
				strokeColor: '#0089c0'
				strokeOpacity: 1.0
				strokeWeight: 4

			initType()

			path.setMap(map)
			google.maps.event.addDomListener window, "resize", ()->
	     		google.maps.event.trigger(map, "resize")
	     		map.setCenter mapOptions['center']
		
		google.maps.event.addDomListener(window, 'load', bgMapInit)
###