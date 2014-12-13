<html>
<head>
</head>
<body>
<h1>Leyendo un fichero remoto</h1>

<?php
function gecodificar_en_google_maps($address,$intento=0) {
	//direccion a buscar
	
//echo $address;
$direccion= urlencode($address);
$address=urlencode($address." castilla y leon");
 $url='http://maps.google.com/maps/api/geocode/json?address='.$address.'&sensor=false';
//Buscamos la direccion en el servicio de google
 echo $url;
 //$geocode=file_get_contents($url);
 
 //decodificamos lo que devuelve google, que esta en formato json
 $output= json_decode($geocode);
 
//Extraemos la informacion que nos interesa
 $lat = $output->results[0]->geometry->location->lat;
 $long = $output->results[0]->geometry->location->lng;
//echo $lat."/";
//echo $long."<br>";
 $cooredenadas="";
 $cooredenadas=$lat."#".$long;
return $cooredenadas;

}

	$conexion = new mysqli("127.0.0.1", "root", "root", "turismo");		
		$fichero="http://www.datosabiertos.jcyl.es/web/jcyl/risp/es/directorio/restaurantes/1284211839594.csv";
		$f = fopen($fichero, "r") or exit("No puedorrrr abrir el fichero");
	$cuando=fgets($f);
	
$contador=0;
	while (( $registro = fgetcsv ( $f , 1000 , ";" )) !== FALSE ){ 	
			//sleep(0.1);

			$address=$registro[3].'. '.$registro[6];
		$tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
		$replac = "AAAAAAaaaaaaOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn";
		$cadena = strtr($address,$tofind,$replac);*/
		
			//$aux=gecodificar_en_google_maps($cadena);
			echo $aux;
			$datos=split("#", $aux );
			//echo $datos[0]."/".$datos[1];
			if($datos[0]>37 && $datos[0] <50 && $datos[1]>-10 && $datos[1] <-3)
			{
				//echo $cadena;
				//echo $datos[0]."/".$datos[1]."<br>";
				$ordensql="insert into resta(nombre,direccion,c_postal,provincia,municipio,localidad,telefono, coordenadas) values('$registro[2]','$registro[3]','$registro[4]','$registro[5]','$registro[6]','$registro[7]','$registro[9]','$aux');";
			//	echo $ordensql;
				
				echo $ordensql;
				//$conexion->query($ordensql);
			}
			$ordensql="insert into resta(nombre,direccion,c_postal,provincia,municipio,localidad,telefono) values('$registro[2]','$registro[3]','$registro[4]','$registro[5]','$registro[6]','$registro[7]','$registro[9]');";
				echo $ordensql;
				$conexion->query($ordensql);
			echo $cadena."$contador<br>";
			$contador++;
		}
		echo $cadena;
		echo $contador."fin";
		fclose($f);
	$conexion->close($conexion);

?>
</body>
</html>
