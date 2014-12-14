
<?php
	session_start();

	include("funciones.php");

	
	
	if( $_POST['municipio']=="")
	{
		$_SESSION['municipio']='valladolid';
	}
	else{
		$_SESSION['municipio']=$_POST['municipio'];		
	}


	$_SESSION['distancia']=$_POST['distancia'];
	$distancia=$_POST['distancia'];
	if($distancia[0]!=null)
	{
		//echo "distancia 0".$distancia[0];
		$_SESSION['distancia']=$distancia[0];
	}
	else
	{
		if($distancia[1]!=null)
		{
			//echo "distancia 1".$distancia[1];
			$_SESSION['distancia']=$distancia[1];
		}
		else
		{
			if($distancia[2]!=null)
			{
				//echo "distancia 2".$distancia[2];
				$_SESSION['distancia']=$distancia[2];
			}
			else
			{
				$_SESSION['distancia']=0.5;
			}
		}
	}

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
		var distancia="<?php echo $dis;?>";
		
		var datos="<?php  coordenadasRestaurante( $_SESSION['municipio'],$_SESSION['distancia'] );?>";//meto las coordenadas mias o de donde quieren buscar 
		
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
		  
		  var coordenadas="<?php municipios($_SESSION['municipio'] );?>";//para centrar en la posicion donde quieres ir  
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
		<form name=a method=POST action=completo.php>
			<div id="controles">
			    <label><input type="checkbox" name="distancia[0]" value="0.5"  /> 0.5</label><br />
			    <label><input type="checkbox" name="distancia[1]" value="1"   /> 1</label><br />
			     <label><input type="checkbox" name="distancia[2]" value="5"  /> 5</label><br />
			     <input type=text name=municipio>
			     <input type=submit name=boton value=boton>
			</div>
		</form>
		</section>
	<footer></footer>
</body>
</html>