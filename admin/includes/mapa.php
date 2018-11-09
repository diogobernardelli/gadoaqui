<html> 
	<head>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js"></script>
		<script type="text/javascript">
			var map;
			var watchPtos;

			var geocoder;			
			var marker;
			
			var latAtual = -20.462798;
			var lngAtual = -54.610199;
			
			function buscarEndereco(latitude, longitude) {
				$('.loading', top.document).show();
				var point_det = new google.maps.LatLng(latitude, longitude);
				var geocoder = new google.maps.Geocoder();
				var endereco = '';

				if (geocoder) {
					geocoder.geocode({ 'latLng': point_det }, function (results, status) {
						$('.loading', top.document).hide();
						if (status == google.maps.GeocoderStatus.OK) {
							if (results[0]) {
								endereco = results[0].formatted_address;
								$('#enderecoGado', top.document).val(endereco);
							}
						} 
					});
				} else
					$('.loading', top.document).hide();		
			}
			
			function GetLocation(location) {
			    if (location.coords.latitude && location.coords.longitude) {
		    		latAtual = location.coords.latitude;
		    		lngAtual = location.coords.longitude;
			    }
			}
			
			function initialize() {
				navigator.geolocation.getCurrentPosition(GetLocation);

				var latlng = new google.maps.LatLng(latAtual, lngAtual);
				var myOptions = {
					zoom: 13,
					center: latlng,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					navigationControl: false,
					mapTypeControl: true,
					scaleControl: false,
					streetViewControl: true,
					streetViewControlOptions: {
				        position: google.maps.ControlPosition.TOP_RIGHT
				    }
				};
				map = new google.maps.Map(document.getElementById("div_mapa"), myOptions);
				
				//////////////////////////
				//		LISTENERS		//
				//////////////////////////
				watchPtos = google.maps.event.addListener(map, 'click', function(event) {
					if (marker) {
						google.maps.event.clearListeners(marker, 'click');
						marker.setMap(null);
						
						$('#enderecoGado', top.document).val('');
						$('#latitudeGado', top.document).val('');
						$('#longitudeGado', top.document).val('');
					}
					
					marker = new google.maps.Marker({
						map: map,
						position: new google.maps.LatLng(event.latLng.lat(), event.latLng.lng()),
						draggable: true,
						title: 'Arrastar!'
					});
					
					$('#latitudeGado', top.document).val(event.latLng.lat());
					$('#longitudeGado', top.document).val(event.latLng.lng());
					buscarEndereco(event.latLng.lat(), event.latLng.lng());

					google.maps.event.addListener(marker, 'dragend', function(event) {
						marker.setPosition(new google.maps.LatLng(event.latLng.lat(), event.latLng.lng()));
						
						$('#latitudeGado', top.document).val(event.latLng.lat());
						$('#longitudeGado', top.document).val(event.latLng.lng());
						buscarEndereco(event.latLng.lat(), event.latLng.lng());
					});					
				});
			}
			
			function carregaDadosGado() {
				if (marker) {
					google.maps.event.clearListeners(marker, 'click');
					marker.setMap(null);
				}

				if ($('#latitudeGado', top.document).val() && $('#longitudeGado', top.document).val()) {
					var latlng = new google.maps.LatLng($('#latitudeGado', top.document).val(), $('#longitudeGado', top.document).val());
					map.setCenter(latlng);
					
					marker = new google.maps.Marker({
						map: map,
						position: latlng,
						draggable: true,
						title: 'Arrastar!'
					});
					google.maps.event.addListener(marker, 'drag', function(event) {
						marker.setPosition(new google.maps.LatLng(event.latLng.lat(), event.latLng.lng()));
						
						$('#latitudeGado', top.document).val(event.latLng.lat());
						$('#longitudeGado', top.document).val(event.latLng.lng());
						buscarEndereco(event.latLng.lat(), event.latLng.lng());
					});
				}
			}
		</script>
	</head>
	<body onLoad="initialize();">
		<div id="div_mapa" style="width:100%;height:100%;background-color:#333333;">&nbsp;</div>
	</body>
</html>