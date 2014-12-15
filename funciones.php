<?php

							////////////////////////////////////////////////////////////////
							/////////////////////////     BBDD      ////////////////////////
							////////////////////////////////////////////////////////////////
	function abrirBBDD()
	{
		$conexion = new mysqli("127.0.0.1", "root", "root", "turismo");
			if (mysqli_connect_errno()) 
			{
		    	die("Error grave: " . mysqli_connect_error());
			}

			return $conexion;
	}

	function cerrarBBDD($conexion)
	{
		$conexion->close($conexion);
	}

	function ordensql($ordensql)
	{

		$conexion=abrirBBDD();
		
		if($chorizo=$conexion->query($ordensql))
		{

			cerrarBBDD($conexion);
		
			return $chorizo;

		}
		else
		{

			cerrarBBDD($conexion);
			return false;
		}
				
	}

							////////////////////////////////////////////////////////////////////////
							////////////////////////     Sacar coordenadas  ////////////////////////
							////////////////////////////////////////////////////////////////////////
	function coordenadasRestaurante( $muni  , $distanciamapa)
	{		
		
		
		$distanciamapa=str_replace("+", "", $distanciamapa);
		echo $distanciamapa;
		$datos=municipios($muni);
		$coord=split("@" ,$datos);
		$chorizo=ordensql("select nombre,direccion, LAT, lng from restaurantes");
		$misPuntos= array();
		if($chorizo!=false)
		{
			$contador=0;
			while ($registro = $chorizo->fetch_array()) {
				
				$distancia=distanciaGeodesica($coord[0] , $coord[1] ,  $registro[2] ,$registro[3]);
				
				if($distancia<$distanciamapa)
				{
					echo $registro[0]."<asd>".$registro[1]."<asd>".$registro[2]."<asd>icon1<asd>".$registro[3]."$";
					$contador++;
				}				
			}		
		}
	}
	function municipios($municipios)
	{
		$municipios=str_replace("+", "", $municipios);

		$municipios=str_replace("@", "", $municipios);
		$contador=0;
		$chorizo=ordensql("select latitud , longitud  from municipios where municipio='".$municipios."'");
		if($chorizo!=false)
		{
			
			while ($registro = $chorizo->fetch_array()) {

				$coordenadas=$registro[0]."@".$registro[1];//para las funciones de restaurantes hoteles...S
				$coordenadasPosicion=$registro[0].",".$registro[1];//para que salga en JS
				echo $coordenadasPosicion;

				return $coordenadas;
				$contador++;	
			}
		}
	

	}

							////////////////////////////////////////////////////////////////
							////////////////////////    Distancia   ////////////////////////
							////////////////////////////////////////////////////////////////

	function distanciaGeodesica($lat1, $long1, $lat2, $long2){

		$degtorad = 0.01745329;
		$radtodeg = 57.29577951;

		$dlong = ($long1 - $long2);
		$dvalue = (sin($lat1 * $degtorad) * sin($lat2 * $degtorad))	+ (cos($lat1 * $degtorad) * cos($lat2 * $degtorad)* cos($dlong * $degtorad));

		$dd = acos($dvalue) * $radtodeg;

		$miles = ($dd * 69.16);
		$km = ($dd * 111.302);

		return $km;
	} 

?>