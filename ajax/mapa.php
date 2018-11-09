<html> 
	<head>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&v=3&libraries=geometry"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js"></script>
		<script type="text/javascript">
			var directionsDisplay;
			var directionsService = new google.maps.DirectionsService();
			var map_rota;
			
			function buscarPosicao(endereco) {
				$('.loading', top.document).show();
				var geocoder = new google.maps.Geocoder();
				var posicao = '';
				
				if (geocoder) {
					geocoder.geocode( { 'address': endereco }, function(results, status) {
						$('.loading', top.document).hide();
						if (status == google.maps.GeocoderStatus.OK) {
							posicao = results[0].geometry.location;

							posicao = new google.maps.LatLng(posicao.lat(), posicao.lng());
							var marker = new google.maps.Marker({
								map: map_rota,
								position: posicao,
								draggable: false,
								title: endereco
							});
							var info = new google.maps.InfoWindow({ content: endereco, maxWidth: 150 });
							google.maps.event.addListener(marker, "click", function() {info.open(map_rota,marker);});
							map_rota.setCenter(posicao);
						}
					});
				} else
					$('.loading', top.document).hide();
			}
			
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
								$('#enderecoNavegador', top.document).html(endereco);
		    					$('#rotaPorPosicaoNavegador', top.document).attr("onclick", "$('#ifrmMapaRota')[0].contentWindow.calcRota('"+endereco+"');");
							}
						} 
					});
				} else
					$('.loading', top.document).hide();
			}
			
			function GetLocation(location) {
			    if (location.coords.latitude && location.coords.longitude) {
		    		buscarEndereco(location.coords.latitude, location.coords.longitude);
		    		
		    		if ($('#latitude', top.document).val() != '' && $('#longitude', top.document).val() != '') {
			    		var latLngA = new google.maps.LatLng(location.coords.latitude, location.coords.longitude);
						var latLngB = new google.maps.LatLng($('#latitude', top.document).val(), $('#longitude', top.document).val());
						
						var dist = google.maps.geometry.spherical.computeDistanceBetween (latLngA, latLngB);
						dist = dist / 1000;
						dist = dist.toFixed(0);
						$('#distanciaKm', top.document).html(dist+' kms');
					}
			    }
			}
			
			function initialize() {
				var latlng = new google.maps.LatLng(-20.462798, -54.610199);
				var myOptions = {
					zoom: 16,
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
				map_rota = new google.maps.Map(document.getElementById("div_mapa_rota"), myOptions);
				
				directionsDisplay = new google.maps.DirectionsRenderer({
					'map': map_rota,
					'preserveViewport': false,
					'draggable': false
				});
				
				//buscarPosicao($('#destinoRota', top.document).val());
				
				var posicao = new google.maps.LatLng($('#latitude', top.document).val(), $('#longitude', top.document).val());
				var marker = new google.maps.Marker({
					map: map_rota,
					position: posicao,
					draggable: false
				});
				map_rota.setCenter(posicao);
				
				navigator.geolocation.getCurrentPosition(GetLocation);
			}
			
			function calcRota(endereco) {
				if (endereco)
					var start = endereco;
				else
					var start = $('#origemRota', top.document).val();
					
				var end = $('#destinoRota', top.document).val();
				
				if (start == '' || start == 'DIGITE SEU ENDEREÇO') {
					//$("#boxAviso", top.document).addClass("error").html("Para criar a rota, preencha o Endereço de Origem <a href='javascript:;' onclick='closeBox();'>[X]</a>").show();
					alert('Para traçar a rota, preencha o endereço');
				}
				else {
					$('.loading', top.document).show();
					
					var request = {
						origin:start, 
						destination:end,
						waypoints: [],
						travelMode: google.maps.DirectionsTravelMode.DRIVING,
						unitSystem: google.maps.DirectionsUnitSystem.METRIC
					};
					directionsService.route(request, function(result, status) {
						$('.loading', top.document).hide();
						if (status == google.maps.DirectionsStatus.OK) {
							directionsDisplay.setDirections(result);
							var dist = result.routes[0].legs[0].distance.value / 1000;
							dist = dist.toFixed(0);
							$('#distanciaKm', top.document).html(dist+' kms');
									
							var rota = directionsDisplay.getDirections();
					
							for (var x in rota){
								if (rota[x].origin) {
									var rt = rota[x];
									break;
								}
							}
						}
						else {
							//$("#boxAviso", top.document).addClass("error").html("Ocorreu algum erro ao criar a rota. Verifique os endereços de origem e destino <a href='javascript:;' onclick='closeBox();'>[X]</a>").show();
							alert('Ocorreu algum erro ao criar a rota.');
						}
					});
				}
			}
		</script>
	</head>
	<body onLoad="initialize();">
		<div id="div_mapa_rota" style="width:100%;height:100%;background-color:#333333;">&nbsp;</div>
	</body>
</html>