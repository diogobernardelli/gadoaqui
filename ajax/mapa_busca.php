<html> 
	<head>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&v=3&libraries=geometry"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js"></script>
		<script type="text/javascript">
			var directionsDisplay;
			var directionsService = new google.maps.DirectionsService();
			var map_rota;
			
			var latCenter;
			var lonCenter;
			
			function buscarPosicao(endereco) {
				$('.loading', top.document).show();
				var geocoder = new google.maps.Geocoder();
				var posicao = '';
				
				if (geocoder) {
					geocoder.geocode( { 'address': endereco }, function(results, status) {
						$('.loading', top.document).hide();
						if (status == google.maps.GeocoderStatus.OK) {
							posicao = results[0].geometry.location;

							latCenter = posicao.lat();
							lonCenter = posicao.lng();
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
								$('#enderecoNavegador', top.document).val(endereco);
							}
						} 
					});
				} else
					$('.loading', top.document).hide();
			}
			
			function GetLocation(location) {
			    if (location.coords.latitude && location.coords.longitude) {
		    		buscarEndereco(location.coords.latitude, location.coords.longitude);
		    		latCenter = location.coords.latitude;
					lonCenter =  location.coords.longitude;
			    }
			}

			function getPosicaoNavegador() {
				navigator.geolocation.getCurrentPosition(GetLocation);
			}

			function pointInCircle(radius) {
				$('.loading', top.document).show();
				
				var res = parent.resBusca;
				var ids = '';
				
				radius = radius * 1000;
				
				for(var i in res) {
					var tmp = res[i].split("|");
					
					if (tmp[1] != '' && tmp[2] != '') {
						var point = new google.maps.LatLng(tmp[1], tmp[2]);
						var center = new google.maps.LatLng(latCenter, lonCenter);
	
					    if (google.maps.geometry.spherical.computeDistanceBetween(point, center) <= radius) {
					    	$('#item'+tmp[0], top.document).hide();
					    	ids += tmp[0]+',';
					    }
					}
					
					if (i == res.length-1) {
						if (ids.length > 0)
							ids = ids.substring(0, ids.length - 1);
						$.get("filtraBuscaDetalhada.php", { ids:ids }, 
							function(data){
								$('.loading', top.document).hide();
								$('#formBuscaDet', top.document).submit();
						});
					}
				}
				if (res.length == 0) {
					$.get("filtraBuscaDetalhada.php", { ids:'n' }, 
						function(data){
							$('.loading', top.document).hide();
							$('#formBuscaDet', top.document).submit();
					});
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
		
				navigator.geolocation.getCurrentPosition(GetLocation);
			}
		</script>
	</head>
	<body onLoad="initialize();">
		<div id="div_mapa_rota" style="width:100%;height:100%;background-color:#333333;">&nbsp;</div>
	</body>
</html>