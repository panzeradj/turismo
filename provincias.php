<?php
	session_start();
	$_SESSION['municipio']=$_POST['municipios'];
	if(!isset($_SESSION['municipio']))
	{

		$bandera=true;//ensña el mapa
		
	}
	else
	{
		$bandera=false;///oculta el mapa
		
		//echo $_SESSION['municipio'];	
	}
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Turismo cyl</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- google fonts -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Pontano+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
<!-- end google fonts -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!--nav-->
<script src="js/jquery.min.js"></script>
<script>
		$(function() {
			var pull 		= $('#pull');
				menu 		= $('nav ul');
				menuHeight	= menu.height();

			$(pull).on('click', function(e) {
				e.preventDefault();
				menu.slideToggle();
			});

			$(window).resize(function(){
        		var w = $(window).width();
        		if(w > 320 && menu.is(':hidden')) {
        			menu.removeAttr('style');
        		}
    		});
		});
</script>
</head>
<body>
<div class="body">
<div class="wrap">
<div class="wrapper">
	<!-- start header-->
	<div class="header">
		<div class="logo">
			<a href="index.html"><img src="images/logo.png" alt=""></a>
		</div>
		<div class="cssmenu">
			<ul>
			  	<li class="active"><a href="index.html">Inicio</a></li>
				<li ><a href="contact.html">Contacto</a></li>
				<div class="clear"></div>
			 </ul>
		</div>
		<div class="clear"></div>
		<div class="top-nav">
		<nav class="clearfix">
				<ul>
			  	<li class="active"><a href="index.html">Inicio</a></li>
				<li ><a href="contact.html">Contacto</a></li>
				<div class="clear"></div>
			 </ul>
				<a href="#" id="pull">Menu</a>
			</nav>
		</div>
	</div>
	<!-- start banner -->
    <div class="banner">
    	<?php
	    	if($bandera==true)
	    	{
	    		echo " <img src='images/banner.png' alt'' />";

	    	}
	    	else
	    	{
	    		echo $_SESSION['municipio'];
	    	}
    	?>
    	
    	 <h2>Turismo CYL</h2>
    	 
    	 <div>
    	 <form name=a method=post action=provincias.php>
    	 	<input type=text name=municipios>
    	 </form>
    	</div>
    	<div  >
    		
    	Mapa

			<header id="mapa">

				<script type="text/javascript">		
								var datos="";
								var misPuntos = new Array();
								var direccion = datos.split(";");
								for (a in direccion){	
									var resultado = direccion[a].split("?");
									if(resultado[0]!= undefined && resultado[1]!= undefined ){
										console.log(resultado[0] );
										console.log("1: "+resultado[1] );
										var coordenadas = resultado[1].split("#");
										if(coordenadas[0]!=undefined && coordenadas[1]!=undefined ){
											misPuntos[a] = [""+resultado[0],""+coordenadas[0], ""+coordenadas[1], "icon1", ""+resultado[2]];							
										}
									}					
								}
							
								function inicializaGoogleMaps() {
								    // Coordenadas del centro de nuestro recuadro principal
								    var x =41.991;
								    var y = -2.024532100000033;
							
								    var mapOptions = {
								        zoom: 7,
								        center: new google.maps.LatLng(x, y),
								        mapTypeId: google.maps.MapTypeId.ROADMAP
								    }
							
								    var map = new google.maps.Map(document.getElementById("mapa"), mapOptions);
								    setGoogleMarkers(map, misPuntos);
								}
							
								var markers = Array();
								var infowindowActivo = false;
								
								function setGoogleMarkers(map, locations) {			    
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
								            title: elPunto[0],
								            animation: google.maps.Animation.DROP
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
				
			</header>

    	</div>
    	<article id="mapa">
    	
    	</article>
    </div>
    <!-- start content -->
    <div class="main1">
    	asdas
    	 Meter botones para decir qe quieres ver
    	hotel
    	apartamento
    	restaurante
    	monumento
    	eventos agenda cultural
    	ferias comerciales

    </div>
</div>
</div>
  <!-- start foorter -->
<div class="footer_bg">
<div class="wrap">
<div class="wrapper">
	<div class="footer">
		<div class="span_1_of_3">
			<h3>Contact Us</h3>
			<div class="footer_grid">
				<div class="foot_img">
					<img src="images/home.png" alt="" />
				</div>
				<div class="foot_text">
					<p>500 Lorem Ipsum Dolor Sit,</p>
					<p>22-56-2-9 Sit Amet, Lorem,</p>
					<p>USA</p>
				</div>	
				<div class="clear"></div>	
			</div>
			<div class="footer_grid">
				<div class="foot_img">
					<img src="images/call.png" alt="" />
				</div>
				<div class="foot_text">
					<p>(416) 431-4437</p>
				</div>		
				<div class="clear"></div>	
			</div>
			<a href=""><h4 class="mail">info(at)mycompany.com</h4></a>
			<div class="foot_nav">
				<ul>
					<li><a href="#"><img src="images/soc_icon1.png" alt="" /></a></li>
					<li><a href="#"><img src="images/soc_icon2.png" alt="" /></a></li>
					<li><a href="#"><img src="images/soc_icon3.png" alt="" /></a></li>
					<li><a href="#"><img src="images/soc_icon4.png" alt="" /></a></li>
					<div class="clear"></div>
				</ul>
				
			</div>
		</div>
		<div class="span_1_of_3">
			<h3>Latest Tweets</h3>
			<div class="footer_grid">
				<div class="foot_img">
					<img src="images/twitter.png" alt="" />
				</div>
				<div class="foot_text">
					<p>Confucius: Lorem Ipsum is simply dummy text of the printing.<br /> <b>#famousquotes</b></p>
					<h4>8 days ago</h4>
				</div>		
				<div class="clear"></div>	
			</div>			
			<div class="footer_grid">
				<div class="foot_img">
					<img src="images/twitter.png" alt="" />
				</div>
				<div class="foot_text">
					<p>Bruce Lee: Lorem Ipsum is simply dummy text of the printing.<br /> <b>#famousquotes</b></p>
					<h4>1 hour ago</h4>
				</div>		
				<div class="clear"></div>	
			</div>	
		</div>
		<div class="span_1_of_3">
			<h3>Latest Posts</h3>
			<a href=""><h5 class="fountain">Starting a new journey today</h5></a>
			<a href=""><h5 class="fountain">The life of a web designer</h5></a>
			<a href=""><h5 class="fountain">Your guide to navigating Around to wordoress</h5></a>
			<a href=""><h5 class="fountain">introduction to HTML5 and CSS3</h5></a>
			<a href=""><h5 class="fountain">The life of a web designer</h5></a>
		</div>
		<div class="clear"></div>
	</div>
</div>
</div>
</div>
</body>
</html>