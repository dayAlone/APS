<div class="filter">
  <div class="row">
    <div class="col-xs-12 visible-xs">
    	<span class="dropdown dropdown--sort">
    		<a href="#" class="dropdown__trigger"><span class="dropdown__text">Все проекты</span><?=svg('arrow')?></a>
    		<select class="dropdown__select">
    			<option value="#all">Все проекты</a>
    			<option value="#current">Текущие</a>
    			<option value="#finished">Завершенные</a>
    		</select>
    		<span class="dropdown__frame">
    			<a href="#all" style="display:none" class="dropdown__item">Все проекты</a><a href="#current" class="dropdown__item">Текущие</a><a href="#finished" class="dropdown__item">Завершенные</a></span></span></div>
    <div class="col-sm-7 no-mobile">
    	<a href="#all" class="filter__item filter__item--active">все проекты</a>
    	<a href="#current" class="filter__item filter__item--yellow">текущие<span>проекты</span></a><a href="#finished" class="filter__item filter__item--blue">ЗАВЕРШЕННЫЕ<span>проекты</span></a></div>
    <div class="col-sm-5 right no-mobile">
    	<div class="select">
    		<span class="select__title">Показывать: </span>
    		<a href="#bg_map" class="select__item select__item--active">Карту</a>	
    		<a href="#list" class="select__item">Список</a>	
    	</div>
    	
    </div>
  </div>
</div>
<div id="list" class="services">
	<div class="row">
	<?foreach ($arResult['ITEMS'] as $item):?>
	<div class="col-lg-6 elm" data-type="<?=$item['PROPS']['SECTION']?>">
	  <a data-toggle="modal" data-target="#markerDetail" href="#markerDetail" class="services__item" data-url="<?=$item['DETAIL_PAGE_URL']?>">
	    <div class="row">
	      <?if(isset($item['PREVIEW_PICTURE']['SRC'])):?>
	      <div class="col-xs-5 col-sm-4 col-md-3">
	        <div style="background-image: url(<?=$item['PREVIEW_PICTURE']['SRC']?>)" class="services__image"></div>
	      </div>
	      <div class="col-xs-7 col-sm-8 col-md-9">
	      <?else:?>
	      <div class="col-xs-12">
	      <?endif;?>
	        <div class="services__title"><?=$item['NAME']?></div>
	      </div>
	    </div>
	  </a>
	</div>
   	<?endforeach;?>
   	</div>
</div>
<?$this->SetViewTarget('footer');?>
<div id="markerDetail" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content modal-content--white">
    	<a data-dismiss="modal" href="#" class="close"><?=svg('close')?></a>
    	<div class="text">
    		
    	</div>
    </div>
  </div>
</div>
<div id="bg_map"></div>
<script src="http://maps.googleapis.com/maps/api/js?sensor=true" type="text/javascript" charset="utf-8"></script>
<script src="/layout/js/tooltip.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
	$(function(){
		initType = function() {
			$('.select').elem('item').click(function(e) {
				if(!$(this).hasMod('active')) {
				    var alt, elm;
				    elm = $(this).attr('href');

				    if (elm == '#list') 
			    		$('.page').elem('title').mod('no-description', true)
				    else
				    	$('.page').elem('title').mod('no-description', false)
					
					alt = $(this).parents('.select').find("a.select__item--active").attr('href');
					

					$(elm).velocity({
						properties: "transition.slideDownIn",
						options: {
						  duration: 300,
						  complete: function() {
						    return google.maps.event.trigger(map, "resize");
						  }
						}
					});

					$(alt).velocity({
						properties: "transition.slideUpOut",
						options: {
						  duration: 300
						}
					});

					$(this).block().elem('item').mod('active',false)
					$(this).mod('active',true)
				}
				e.preventDefault();
			});

		};
		function show_elements(list) {
			$.each(list['lines'], function () {
				this.setMap(map);
			});
			$.each(list['markers'], function () {
				this.setVisible(true);
			});
		}
		function hide_elements(list) {
			$.each(list['lines'], function () {
				this.setMap(null);
			});
			$.each(list['markers'], function () {
				this.setVisible(false);
			});
		}
		function initialize_map() {
			
			var circle, cords, mapElement, mapOptions, line, path, objects = {'finished': {'lines' : [], 'markers':[]}, 'current': {'lines':[], 'markers':[]}};
		    mapOptions = {
		      zoom: 3,
		      mapTypeId: google.maps.MapTypeId.HYBRID,
		      //draggable: false,
		      //zoomControl: false,
		      scrollwheel: false,
		      disableDoubleClickZoom: true,
		      //disableDefaultUI: true,
		      mapTypeControl: false,
		      streetViewControl: false,
		      panControl: false,
		      zoomControlOptions: {
		        style: google.maps.ZoomControlStyle.LARGE,
		        position: google.maps.ControlPosition.LEFT_CENTER
    		  },
		      center: new google.maps.LatLng(66.69261210265907, 95.40570330969672),
		      styles: [{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000"},{"lightness":170},{"weight":0.1}]}]
		    };
		    mapElement = document.getElementById('bg_map');
		    map = new google.maps.Map(mapElement, mapOptions);
		    circle = {
		      path: google.maps.SymbolPath.CIRCLE,
		      strokeColor: 'transparent',
		      fillColor: '#FFF',
		      scale: 3,
		      fillOpacity: 1,
		      zIndex: 3
		    };
		    $.each(["/include/regions.json"], function(key,url){
		    	console.log(url)
			    $.getJSON( url, function( data ) {
			    	map.data.addGeoJson(data)
			    });
			});
		    var featureStyle = {
			    fillColor: 'transparent',
			    strokeWeight: .8,
			    zIndex: 1,
			    strokeOpacity: .5,
			    cursor: 'normal'
			}
		    map.data.setStyle(featureStyle);
		    
		    initType()
		    /*
		    google.maps.event.addListener(map, 'dragend', function(e) { 
		    	console.log(map.getCenter())
		    });
		    */
		    function sort(elem, objects) {
		    	var href;
			      href = elem.attr('href').split('#')[1];
			      if(objects[href])
			      {
			      	$('.filter').elem('item').mod('active', false);
			      	elem.mod('active', true);
			      	$.each(objects, function(elm, key){
			      		if(elm==href) {
			      			show_elements(key)
			      			$('#list .elm[data-type="'+elm+'"]').show()
			      		}
			      		else {
			      			hide_elements(key)
			      			$('#list .elm[data-type="'+elm+'"]').hide()
			      		}
			      	})
			      }
			      else
			      {
			      	$('.filter').elem('item').mod('active', false);
			      	elem.mod('active', true);
			      	$('#list .elm').show()
			      	$.each(objects, function(elm, key){
						show_elements(key)
			      	})
			      }
		    }
		    $('.dropdown--sort').elem('item').click(function(e) {
		    	sort($(this), objects)
		    });
		    $('.filter').elem('item').click(function(e) {
		      if(!$(this).mod('active')) {
			      sort($(this), objects)
		      }
		      return e.preventDefault();
		    });
		    <?foreach ($arResult['ITEMS'] as $item):?>
		    	cords = [
			    	<? foreach($item['PROPS']['GEO'] as $geo):
			    		if(strlen($geo['cords'])>0):?>
						{ cords : new google.maps.LatLng(<?=$geo['cords']?>), name: "<?=$geo['name']?>" },
					<? 
						endif;
					endforeach; ?>
				]
				line = []
			    $.each(cords, function() {
		          var marker;
		          line.push(this.cords)
		          marker = new google.maps.Marker({
		            position: this.cords,
		            icon: circle,
		            map: map,
		            title: "<?=$geo['name']?>"
		          });
			      var tooltipOptions = {
		              marker: marker,
		              map : map,
		              content: this.name,
		              cssClass: 'tooltip' // name of a css class to apply to tooltip
		          };
		          var tooltip = new Tooltip(tooltipOptions);
		          objects['<?=$item['PROPS']['SECTION']?>']['markers'].push(marker);
		          google.maps.event.addListener(marker, 'mouseover', function() {
      				linetip.hide();
    			  });
		        });
		        path = new google.maps.Polyline({
		          path: line,
		          geodesic: true,
		          strokeColor: <?=($item['PROPS']['SECTION']=='finished'?'"#002a5c"':'"#c51230"')?>,
		          strokeOpacity: 1.0,
		          strokeWeight: 5,
		          geodesic: false,
		          zIndex: 3
		        });
		        
		        objects['<?=$item['PROPS']['SECTION']?>']['lines'].push(path);
		        google.maps.event.addListener(path, 'click', function() {
		            $.openModal('/projects/<?=$item['CODE']?>/', '#markerDetail', true);
		        });
		        google.maps.event.addListener(path, 'mousemove', function() {
		        	var show = false
		        	$('.tooltip').each(function(){
		        		if($(this).css('visibility')!='hidden')
		        			show = true
		        	})
		        	if(!show)
      					linetip.show("<?=$item['NAME']?>");
    			});
    			google.maps.event.addListener(path, 'mouseout', function() {
      				linetip.hide();
    			});
		        path.setMap(map);
	        <?endforeach;?>

	        //hide_elements(objects['finished'])

		    google.maps.event.addDomListener(window, "resize", function() {
		      google.maps.event.trigger(map, "resize");
		      return map.setCenter(mapOptions['center']);
		    });
		}
		initialize_map()
	});
	var linetip=function(){
		var id = 'tt';
		var top = 3;
		var left = 3;
		var maxw = 250;
		var speed = 10;
		var timer = 20;
		var endalpha = 95;
		var alpha = 0;
		var tt,t,c,b,h;
		var ie = document.all ? true : false;
		return{
		    show:function(v,w){         
		        if(tt == null){             
		            tt = document.createElement('div');
		            tt.setAttribute('id',id);
		            t = document.createElement('div');
		            t.setAttribute('id',id + 'top');
		            c = document.createElement('div');
		            c.setAttribute('id',id + 'cont');
		            b = document.createElement('div');
		            b.setAttribute('id',id + 'bot');
		            tt.appendChild(t);
		            tt.appendChild(c);
		            tt.appendChild(b);
		            document.body.appendChild(tt);              
		            tt.style.opacity = 0;
		            tt.style.filter = 'alpha(opacity=0)';
		            document.onmousemove = this.pos;                
		        }
		        tt.style.visibility = 'visible';
		        tt.style.display = 'block';
		        c.innerHTML = v;
		        tt.style.width = w ? w + 'px' : 'auto';
		        if(!w && ie){
		            t.style.display = 'none';
		            b.style.display = 'none';
		            tt.style.width = tt.offsetWidth;
		            t.style.display = 'block';
		            b.style.display = 'block';
		        }
		        if(tt.offsetWidth > maxw){tt.style.width = maxw + 'px'}
		        h = parseInt(tt.offsetHeight) + top;
		        clearInterval(tt.timer);
		        tt.timer = setInterval(function(){linetip.fade(1)},timer);
		    },
		    pos:function(e){
		        var u = ie ? event.clientY + document.documentElement.scrollTop : e.pageY;
		        var l = ie ? event.clientX + document.documentElement.scrollLeft : e.pageX;
		        tt.style.top = (u - h) + 'px';
		        tt.style.left = (l + left) + 'px';
		    },
		    fade:function(d){
		        var a = alpha;
		        if((a != endalpha && d == 1) || (a != 0 && d == -1)){
		            var i = speed;
		            if(endalpha - a < speed && d == 1){
		                i = endalpha - a;
		            }else if(alpha < speed && d == -1){
		                i = a;
		            }
		            alpha = a + (i * d);
		            tt.style.opacity = alpha * .01;
		            tt.style.filter = 'alpha(opacity=' + alpha + ')';
		        }else{
		            clearInterval(tt.timer);
		            if(d == -1){tt.style.display = 'none'}
		        }
		    },
		    hide:function(){
		        clearInterval(tt.timer);
		        tt.timer = setInterval(function(){linetip.fade(-1)},timer);
		    }
		};
	}();
</script>
<?$this->EndViewTarget();?> 