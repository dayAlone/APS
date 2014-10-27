(function() {
  var addTrigger, autoHeight, blur, delay, getCaptcha, map, newsInit, setCaptcha, size, urlInitial;

  delay = function(ms, func) {
    return setTimeout(func, ms);
  };

  newsInit = false;

  map = void 0;

  size = function() {
    autoHeight($('.page .tech'), '.tech__item', '.tech__title', false, true);
    if (!newsInit) {
      newsInit = true;
      return $('article:not(.index-page) .news').isotope({
        itemSelector: '.news__item'
      });
    }
  };

  urlInitial = void 0;

  $.openModal = function(url, id, open) {
    if (url) {
      if (open) {
        $(id).modal();
      }
      return $(id).find('.text').load("/ajax" + url, function(data) {
        var info;
        $('.modal .fotorama').fotorama();
        if (History.enabled) {
          info = History.getState();
          console.log(info);
          urlInitial = {
            url: info.cleanUrl,
            title: document.title
          };
          History.pushState({
            'url': url
          }, $(id).find('.text h1').text(), url);
          return window.title = $(id).find('.text h1').text();
        }
      });
    }
  };

  autoHeight = function(el, selector, height_selector, use_padding, debug) {
    var count, heights, i, item, item_padding, items, loops, padding, step, x, _i, _ref, _results;
    if (selector == null) {
      selector = '';
    }
    if (height_selector == null) {
      height_selector = false;
    }
    if (use_padding == null) {
      use_padding = false;
    }
    if (debug == null) {
      debug = false;
    }
    if (el.length > 0) {
      item = el.find(selector);
      if (height_selector) {
        el.find(height_selector).removeAttr('style');
      } else {
        el.find(selector).removeAttr('style');
      }
      item_padding = item.css('padding-left').split('px')[0] * 2;
      padding = el.css('padding-left').split('px')[0] * 2;
      if (debug) {
        step = Math.round((el.width() - padding) / (item.width() + item_padding));
      } else {
        step = Math.round(el.width() / item.width());
      }
      count = item.length - 1;
      loops = Math.ceil(count / step);
      i = 0;
      if (debug) {
        console.log(count, step, item_padding, padding, el.width(), item.width());
      }
      _results = [];
      while (i < count) {
        items = {};
        for (x = _i = 0, _ref = step - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; x = 0 <= _ref ? ++_i : --_i) {
          if (item[i + x]) {
            items[x] = item[i + x];
          }
        }
        heights = [];
        $.each(items, function() {
          if (height_selector) {
            return heights.push($(this).find(height_selector).height());
          } else {
            return heights.push($(this).height());
          }
        });
        if (debug) {
          console.log(heights);
        }
        $.each(items, function() {
          if (height_selector) {
            return $(this).find(height_selector).height(Math.max.apply(Math, heights));
          } else {
            return $(this).height(Math.max.apply(Math, heights));
          }
        });
        _results.push(i += step);
      }
      return _results;
    }
  };

  getCaptcha = function() {
    return $.get('/include/captcha.php', function(data) {
      return setCaptcha(data);
    });
  };

  setCaptcha = function(code) {
    $('input[name=captcha_code]').val(code);
    return $('.captcha').css('background-image', "url(/include/captcha.php?captcha_sid=" + code + ")");
  };

  addTrigger = function() {
    $('.grain-tables-table-edit-admin tbody tr:not(.triggered) td:last-of-type').each(function() {
      $(this).closest('tr').addClass('triggered');
      return $(this).after("<td><a href='#' class='openMap'>Открыть карту</a></td>");
    });
    $('#mapPopup .adm-btn-save').click(function(e) {
      var val;
      val = $('#mapPopup input[name="value"]').val();
      $("input[name='" + ($(this).data('id')) + "']").val("" + val);
      $('#mapPopup').modal('hide');
      return e.preventDefault();
    });
    return $('a.openMap').off('click').on('click', function(e) {
      var id, val;
      val = $(this).closest('tr').find('input[name*=cords]').val();
      id = $(this).closest('tr').find('input[name*=cords]').attr('name');
      console.log(id);
      $('#mapPopup .adm-btn-save').data({
        'id': id
      });
      $('#mapPopup .modal-content .map').load("/include/map.php?ajax=1&val=" + val, function() {
        return $('#mapPopup').modal();
      });
      return e.preventDefault();
    });
  };

  blur = function() {
    return $('header.toolbar, article.index-page, .news__frame, .tech__item').blurjs({
      source: '.wrap',
      radius: 15,
      overlay: 'rgba(0,0,0,0.1)'
    });
  };

  $(document).ready(function() {
    var closeDropdown, mapInit, openDropdown, timer, x;
    $('.search-trigger').click(function(e) {
      if ($('.toolbar .container').width() <= 750) {
        $('#Search').modal();
      } else {
        if ($('.toolbar .search-form').is(':hidden')) {
          $('.toolbar .search-form').velocity({
            properties: "transition.slideDownIn",
            options: {
              duration: 300,
              complete: function() {
                $('.toolbar .search-form  .search-form__button').css('opacity', 1);
                return $('.toolbar').one('mouseleave', function() {
                  $('.toolbar .search-form  .search-form__button').css('opacity', 0);
                  return $('.toolbar .search-form').velocity({
                    properties: "transition.slideUpOut",
                    options: {
                      duration: 300
                    }
                  });
                });
              }
            }
          });
        }
      }
      return e.preventDefault();
    });
    addTrigger();
    $('a[onclick*=grain_TableAddRow]').click(function() {
      return addTrigger();
    });
    $('a.captcha_refresh').click(function(e) {
      getCaptcha();
      return e.preventDefault();
    });
    $('.form').submit(function(e) {
      var data;
      data = $(this).serialize();
      $.post('/include/send.php', data, function(data) {
        data = $.parseJSON(data);
        if (data.status === "ok") {
          $('.form').hide();
          return $('.form').parents('.modal').find('.success').show();
        } else if (data.status === "error") {
          $('input[name=captcha_word]').addClass('parsley-error');
          return getCaptcha();
        }
      });
      return e.preventDefault();
    });
    $('.modal').on('show.bs.modal', function(a, b) {
      var id, url;
      url = $(a.relatedTarget).data('url');
      id = $(a.relatedTarget).attr('href');
      return $.openModal(url, id);
    });
    $('.modal').on('hide.bs.modal', function(a, b) {
      $(this).find('input[type="email"], input[type="text"], textarea').removeClass('parsley-error').removeAttr("value").val("");
      $(this).find('form').trigger('reset').show();
      $(this).find('.success').hide();
      if (urlInitial) {
        History.pushState({
          'url': urlInitial.url
        }, urlInitial.title, urlInitial.url);
        window.title = urlInitial.title;
      }
      if ($(this).find('iframe').length > 0) {
        return $(this).find('iframe').remove();
      }
    });
    $('.lang-trigger__carriage').click(function(e) {
      var el, variants;
      window.location.href = 'http://argusweld.com';
      el = $(this).parents('.lang-trigger');
      variants = el.data('variant').split(',');
      $.each(variants, function(index, value) {
        value = value.toString();
        if (el.mod('lang') !== value) {
          el.mod('lang', value);
          return false;
        }
      });
      return e.preventDefault();
    });
    $('.form-trigger').click(function(e) {
      var form;
      form = $(this).parents('.modal').find('form');
      if (form.is(':visible')) {
        return form.velocity({
          properties: "transition.slideUpOut",
          options: {
            duration: 300
          }
        });
      } else {
        return form.velocity({
          properties: "transition.slideDownIn",
          options: {
            duration: 300
          }
        });
      }
    });
    $('.dropdown').elem('item').click(function(e) {
      if ($(this).attr('href')[0] === "#") {
        $('.dropdown').elem('text').html($(this).text());
        $('.dropdown').elem('frame').velocity({
          properties: "transition.slideUpOut",
          options: {
            duration: 300
          }
        });
        return e.preventDefault();
      } else {
        return window.location.href = $(this).attr('href');
      }
    });
    closeDropdown = function(x) {
      x.mod('open', false);
      return x.elem('frame').velocity({
        properties: "transition.slideUpOut",
        options: {
          duration: 300
        }
      });
    };
    openDropdown = function(x) {
      var text;
      clearTimeout(timer);
      text = x.elem('text').text();
      x.elem('item').show();
      x.elem('frame').find("a:contains(" + text + ")").hide();
      return x.elem('frame').velocity({
        properties: "transition.slideDownIn",
        options: {
          duration: 300,
          complete: function() {
            var timer;
            x.mod('open', true);
            return timer = delay(3000, function() {
              return $('.dropdown').elem('frame').velocity({
                properties: "transition.slideUpOut",
                options: {
                  duration: 300
                }
              });
            });
          }
        }
      });
    };
    timer = false;
    $('.modal .text').spin({
      lines: 13,
      length: 21,
      width: 2,
      radius: 24,
      corners: 0,
      rotate: 0,
      direction: 1,
      color: '#0c4ed0',
      speed: 1,
      trail: 68,
      shadow: false,
      hwaccel: false,
      className: 'spinner',
      zIndex: 2e9,
      top: '50%',
      left: '50%'
    });

    /*
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
     */
    $('.dropdown').elem('select').on('change', function() {
      var val;
      val = $(this).val();
      $(this).block().find("a[href='" + val + "']").trigger('click');
      return $(this).mod('open', true);
    });
    $('.dropdown').hoverIntent({
      over: function() {
        if ($(window).width() > 970) {
          return openDropdown($(this));
        } else {
          $(this).elem('select').focus();
          return $(this).mod('open', true);
        }
      },
      out: function() {
        if ($(window).width() > 970) {
          return closeDropdown($(this));
        }
      }
    });
    $('.toolbar a.phone').click(function(e) {
      if ($(window).width() <= 768) {
        $('#Contacts').modal();
        return e.preventDefault();
      }
    });
    $('.site-select .site-select__trigger').click(function() {
      var p;
      p = $(this).parents('.site-select');
      if (!p.mod('open')) {
        return $('#Sites').modal();
      }
    });
    $('.site-select .site-select__trigger').hoverIntent({
      over: function() {
        var p;
        if ($(window).width() > 768) {
          clearTimeout(timer);
          p = $(this).parents('.site-select');
          p.mod('open', true);
          return p.elem('dropdown').velocity({
            properties: "transition.slideDownIn",
            options: {
              duration: 300,
              complete: function() {
                return timer = delay(3000, function() {
                  return $('.site-select').mod('open', false).elem('dropdown').velocity({
                    properties: "transition.slideUpOut",
                    options: {
                      duration: 300
                    }
                  });
                });
              }
            }
          });
        }
      },
      out: function() {}
    });
    $('.site-select').hoverIntent({
      over: function() {},
      out: function() {
        var p;
        p = $(this);
        p.mod('open', false);
        return p.elem('dropdown').velocity({
          properties: "transition.slideUpOut",
          options: {
            duration: 300
          }
        });
      }
    });
    $('a.site-select__trigger').click(function(e) {
      if ($(window).width() < 768) {
        $('#Sites').modal();
      }
      return e.preventDefault();
    });
    delay(300, function() {
      return size();
    });
    mapInit = false;
    $('#contactsMap').on('shown.bs.modal', function() {
      if (!mapInit) {
        mapInit = true;
        return ymaps.ready(function() {
          var myMap, myPlacemark;
          myMap = new ymaps.Map('map', {
            center: [55.723171, 37.559856],
            zoom: 15
          });
          myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
            hintContent: 'Аргус СварСервис'
          }, {
            preset: "twirl#nightDotIcon"
          });
          return myMap.geoObjects.add(myPlacemark);
        });
      }
    });
    x = void 0;
    return $(window).resize(function() {
      clearTimeout(x);
      return x = delay(200, function() {
        return size();
      });
    });
  });


  /*
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
   */

}).call(this);
