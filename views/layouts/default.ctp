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
		<?php echo $javascript->link('jquery.min.js'); ?>
	</head> 
	<body> 
		<!-- INICIA SITIO --> 
		<div id="wrapper">
		
			<!-- INICIA HEADER --> 
			<div id="header"> 
			 
				<!-- INICIA MENU --> 
				<div id="menualternativo">
					<ul class="menualternativo menu"> 
						<li> 
							<a title="Contacto" href="#">Contacto</a> 
						</li>
						<li class="separador">|</li> 
						<li> 
							<a title="Mapa del sitio" href="http://localhost/wordpress/?page_id=12">Mapa del sitio</a> 
						</li> 
					</ul>
				</div>
				<!-- TERMINA MENU --> 
		 
			</div>
			
			<!-- menu superior en los # se pone la ruta de la pagina que sale en wordpress cuando se edita, bajo el titulo --> 
			<div id="menuprincipal"> 
			    <ul class="menuprincipal menu"> 
					<li > 
						<a  href="/">Inicio</a> 
					</li> 
					<li > 
						<a href="/organizaciones">Organizaciones</a> 
					</li> 
					<li> 
						<a href="/catastros">Catastros</a> 
						<ul class="menusecundario menu">
							<li> 
								<a href="#">Salud</a> 
							</li> 
							<li> 
								<a href="#">Viviendas</a> 
							</li> 
							<li> 
								<a href="#">Ayuda Humanitaria</a> 
							</li>
						</ul>
					</li>
					<li> 
						<a href="#">Comunas</a> 
					</li> 
					<li> 
						<a href="#">CoordinaChile</a> 
					</li>
					<li>
						<a href="http://blog.coordinachile.cl">Blog</a>
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
				<div id="iniciosesion" class="widget">
				<!--
					<h2>Inicio de sesi&oacute;n</h2>
					<form> 
						<label>Correo electr&oacute;nico</label> 
						<div class="clear"></div> 
						<input type='text' class="input-text" id="correousuario" name="correousuario" /> 
						<div class="clear"></div> 
						<label>Contrase&ntilde;a</label> 
						<div class="clear"></div> 
						<input type='password' class="input-text" id="contrasenausuario" name="contrasenausuario" /> 
						<div class="clear"></div> 
						<input type="submit" value="Ingresar" class="input-button"> 
						<p>
							<a href="#">Reg&iacute;strate aqu&iacute;</a>
						</p> 
						<p>
							<a href="#">Olvidate tu contrase&ntilde;a</a>
						</p>
					</form>
				-->
				<?php echo $this->element('ingreso'); ?>
				</div>
				
				<div class="separador"></div>
			
				<div id="contacto" class="widget">
					<p class="contacto">Mesa de ayuda</p> 
					<p class="telefono">(56) 2 977 09 07</p> 
					<p class="mail">contacto@coordinachile.cl</p>		
				</div>
			</div> 
		 	<!-- TERMINA CONTENIDO --> 
		 
			<div class="clear"></div> 
		</div>
		
		<?php echo $javascript->link('general.js'); ?>
		
		<!-- TERMINA SITIO -->
	</body>
</html>
