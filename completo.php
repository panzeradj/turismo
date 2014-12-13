
<?php
	include("funciones.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
	
	<title>Empleo</title>
	<link rel="stylesheet" href="estilo.css">

	<div id="capa-mapa" style="width:400px;height:400px"></div>

		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true">
		</script>

	<script type="text/javascript">
		
		var datos="<?php  coordenadasRestaurante( "+valladolid+" );?>";//meto las coordenadas mias o de donde quieren buscar 
		var misPuntos= new Array();
		var a=datos.split("$");
		var count=0;
		
		while (a[count]!=null)
		{
			var b=a[count].split("<asd>");	
			misPuntos[count] = [""+b[0],""+b[2], ""+b[4],""+b[3], ""+b[0] +"<br><a href=#>Como llegar a la posicion</a>"];
			count++;
		}
		function inicializaGoogleMaps() {
		    // Coordenadas del centro de nuestro recuadro principal
		  var coordenadas="<?php municipios("+valladolid+" );?>";//para centrar en la posicion donde quieres ir  
		  var cor=coordenadas.split(",");
		  	var x=cor[0];
		  	var y=cor[1];
		    var mapOptions = {
		        zoom: 12,
		        center: new google.maps.LatLng(x, y),
		        mapTypeId: google.maps.MapTypeId.ROADMAP
		    }

		    var map = new google.maps.Map(document.getElementById("capa-mapa"), mapOptions);
		    setGoogleMarkers(map, misPuntos);
		}

		var markers = Array();
		var infowindowActivo = false;
		function setGoogleMarkers(map, locations) {
		    // Definimos los iconos a utilizar con sus medidas
		    var icon1 = new google.maps.MarkerImage(
		        "office-building.png",
		        new google.maps.Size(30, 30)
		    );
		    

		    for(var i=0; i<locations.length; i++) {
		        var elPunto = locations[i];
		        var myLatLng = new google.maps.LatLng(elPunto[1], elPunto[2]);

		        markers[i]=new google.maps.Marker({
		            position: myLatLng,
		            map: map,
		            icon: eval(elPunto[3]),
		            title: elPunto[0]
		        });
		        markers[i].infoWindow=new google.maps.InfoWindow({
		            content: elPunto[4]
		        });
		        google.maps.event.addListener(markers[i], 'click', function(){      
		            if(infowindowActivo)
		                infowindowActivo.close();
		            infowindowActivo = this.infoWindow;
		            infowindowActivo.open(map, this);
		        });
		    }
		}

		inicializaGoogleMaps();
	</script>
</head>
<body>
	<header>
		<h1></h1>
	</header>
	<section>
		<article id="capa-mapa">
			
		</article>
	</section>
	<footer></footer>
</body>
</html>