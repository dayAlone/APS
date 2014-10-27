<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("fileman");
$x = RandString(5);
if(strlen($_REQUEST['val'])>0)
	$value = $_REQUEST['val'];
?>
<style>
	  .controls {
	  	margin-top: 16px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
	  }
      #pac-input_<?=$x?> {
        background-color: #fff;
        padding: 0 11px 0 13px;
        width: 400px;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        text-overflow: ellipsis;
        height: auto;
        margin-top: 16px;
        margin-top: 16px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #pac-input_<?=$x?>:focus {
        border-color: #4d90fe;
        margin-left: -1px;
        padding-left: 14px;  /* Regular padding-left + 1. */
        width: 401px;
      }

      .pac-container {

        z-index: 2222222222;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }
}
</style>
<div id="map_<?=$x?>">
	
	<div id="map_<?=$x?>_frame" style="height:450px;width: 100%;margin-bottom: 20px;"></div>
	<input id="pac-input_<?=$x?>" class="controls" type="text" placeholder="Поиск по карте">
	<input type="hidden" name="value" value="<?=$_REQUEST['val']?>">
	<div class="hint" style="float:left;width:70%;text-align:left;margin:-5 0 15px 0;opacity:.5; font-size:11px;">
		<span class="add">Кликните два раза по карте, чтобы добавить маркер или перетащите уже созданный.</span>
	</div>
	<script>
		var marker_<?=$x?>, google;
		function resizeMap() {
     		google.maps.event.trigger(map_<?=$x?>, "resize");
     		map.setCenter(new google.maps.LatLng(<?=(isset($value)?$value:"63.436317234268486, 67.10492205969675")?>))
		}
		function initialize_<?=$x?>() {
			
			var mapOptions = {
			    zoom: 3,
			    maxZoom: 13,
			    streetViewControl: false,
			    disableDoubleClickZoom: true,
			    center: new google.maps.LatLng(<?=(isset($value)?$value:"63.436317234268486, 67.10492205969675")?>)
			};
			
			var map_<?=$x?> = new google.maps.Map(document.getElementById('map_<?=$x?>_frame'), mapOptions);

			var input = (document.getElementById('pac-input_<?=$x?>'));
			map_<?=$x?>.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

			var searchBox_<?=$x?> = new google.maps.places.SearchBox((input));

			google.maps.event.addListener(searchBox_<?=$x?>, 'places_changed', function() {
				var places = searchBox_<?=$x?>.getPlaces();

			    if (places.length == 0) {
			      return;
			    }

			    var bounds = new google.maps.LatLngBounds();
			    for (var i = 0, place; place = places[i]; i++) {
			      bounds.extend(place.geometry.location);
			    }

			    map_<?=$x?>.fitBounds(bounds);
			});

			<?if(isset($value)):?>
				marker_<?=$x?> = new google.maps.Marker({
				    position: new google.maps.LatLng(<?=$value?>),
				    map: map_<?=$x?>,
				    draggable: true
			  	});
			<?endif;?>

			google.maps.event.addListener(map_<?=$x?>, 'dblclick', function(e) {
    			placeMarker_<?=$x?>(e.latLng, map_<?=$x?>);
    			setPosition_<?=$x?>([e.latLng.lat(), e.latLng.lng()])
  			});
		}
		function setPosition_<?=$x?>(position) {
			$('#map_<?=$x?> input[name="value"]').val(position)
		}
		function positionChange_<?=$x?>(event) {
			setPosition_<?=$x?>([event.latLng.lat(), event.latLng.lng()])
		}
		function placeMarker_<?=$x?>(position, map) {
		  if (!marker_<?=$x?>) {
		  	marker_<?=$x?> = new google.maps.Marker({
			    position: position,
			    map: map,
			    draggable: true
		  	});
		  	google.maps.event.addListener(marker_<?=$x?>, 'dragend', positionChange_<?=$x?>)
		  }
		  else {
		  	marker_<?=$x?>.setPosition(position)
		  }
		  map.panTo(position);
		}
		$('#mapPopup').on('shown.bs.modal', function(){
			if(!google)
				$.getScript("http://maps.google.com/maps/api/js?sensor=true&libraries=places&callback=initialize_<?=$x?>")
			else
				initialize_<?=$x?>()
		});
		$('#mapPopup').on('shown.bs.modal', function(){
			$('#mapPopup').off('shown.bs.modal shown.bs.modal');
		});
	</script>
	<?if(!isset($_REQUEST['ajax'])):
	?>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script>
	$(function(){
		$.getScript("http://maps.google.com/maps/api/js?sensor=true&libraries=places&callback=initialize_<?=$x?>")
	})
	</script>
	<?endif;?>
</div>
