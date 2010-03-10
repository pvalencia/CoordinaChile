<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
	<head profile="http://gmpg.org/xfn/11"> 
	 
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
		<title>Coordina Chile</title> 
		<meta name="generator" content="WordPress 2.8.6" /> 
		<!-- leave this for stats --> 
		 
		<?php echo $html->css('style'); ?> 
		<link rel="alternate" type="application/rss+xml" title="Coordina Chile &#8211;  Coordinación de organizaciones voluntarias RSS Feed" href="http://blog.coordinachile.cl/?feed=rss2" /> 
		<link rel="pingback" href="http://blog.coordinachile.cl/xmlrpc.php" /> 
		 
		 
		<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://blog.coordinachile.cl/xmlrpc.php?rsd" /> 
		<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://blog.coordinachile.cl/wp-includes/wlwmanifest.xml" /> 
		<link rel='index' title='Coordina Chile -  Coordinación de organizaciones voluntarias' href='http://blog.coordinachile.cl' /> 
		<meta name="generator" content="WordPress 2.8.6" />
	</head> 
	<body> 
		<a name="top"></a> 
		
		<!-- INICIA SITIO --> 
		<div id="wrapper">
		
			<!-- INICIA HEADER --> 
			<div id="header"> 
			 
				<!-- INICIA MENU --> 
					<div id="menu"> 
						<ul id="menuList"> 
							<li class="page_item page-item-3"> 
								<a title="Contacto" href="#">Contacto</a> 
							</li>
							<li class="separador">|</li> 
							<li class="page_item page-item-5"> 
								<a title="Mapa del sitio" href="http://localhost/wordpress/?page_id=12">Mapa del sitio</a> 
							</li> 
						</ul> 
					</div>
					<div class="clear"></div>
		 
			</div>
			
			<!-- menu superior en los # se pone la ruta de la pagina que sale en wordpress cuando se edita, bajo el titulo --> 
			<div id="menuprincipal"> 
			    <ul class="menuprincipal"> 
					<li > 
						<a  href="/">Inicio</a> 
					</li> 
					<li > 
						<a href="/organizaciones">Organizaciones</a> 
					</li> 
					<li > 
						<a href="/catastros">Catastros</a> 
					</li> 
					<li > 
						<a href="#">Salud</a> 
					</li> 
					<li > 
						<a href="#">Viviendas</a> 
					</li> 
					<li > 
						<a href="#">Ayuda Humanitaria</a> 
					</li> 
					<li > 
						<a href="#">Comunas</a> 
					</li> 
					<li> 
						<a href="#">CoordinaChile</a> 
					</li> 
			    </ul> 
			</div> 
		 	<!-- TERMINA HEADER -->
		 	
		 	<!-- INICIA CONTENIDO --> 
			<div id="container"> 
				<?php $session->flash(); ?>
		    	<?php echo $content_for_layout; ?>
			</div>
			
			<div id="sidebar"> 
				<h1>Usuarios</h1> 
				<form> 
					<div class="formulariosidebar"> 
						<label>Usuario</label> 
						<div class="clear"></div> 
						<input type='text' /> 
						<div class="clear"></div> 
						<label>Contrase&ntilde;a</label> 
						<div class="clear"></div> 
						<input type='password' /> 
						<div class="clear"></div> 
						<input type="submit" value="Ingresar"> 
						<p>
							<a href="#">Reg&iacute;strate aqu&iacute;</a>
						</p> 
						<p>
							<a href="#">Olvidate tu contrase&ntilde;a</a>
						</p> 
					</div> 
				</form> 
				<div class="separador"></div> 
			
				<p class="contacto">Mesa de ayuda</p> 
				<p class="telefono">(56) 2 977 09 07</p> 
				<p class="mail">contacto@coordinachile.cl</p>		
			</div> 
		 	<!-- TERMINA CONTENIDO --> 
		 
			<div class="clear"></div> 
		</div>
		<!-- TERMINA SITIO -->
		
		<?php echo $javascript->link('http://code.jquery.com/jquery-1.4.2.min.js'); ?>
	</body>
</html>
