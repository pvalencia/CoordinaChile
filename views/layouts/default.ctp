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

		<script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAAEbJVDLJQrWbQECox1QNqKBQlFJ7uMGmw31pn-fRymyxAeVKaWBS3180QHAhYGdBEW75YUlsUILZrEg"></script>
		<script type="text/javascript">
			google.load('jquery', '1.4.2');
		</script>
		<?php echo $javascript->link('general.js'); ?>
		<?php echo $javascript->link('visualizacion.js'); ?>
	</head> 
	<body> 
		<!-- INICIA SITIO --> 
		<div id="wrapper">
		
			<!-- INICIA HEADER --> 
			<div id="header"> 
			 
				<!-- INICIA MENU --> 
				<div id="menualternativo">
					<img src="/img/logoConfech.png" style="width: 180px" alt="Confech" />
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
						<a href="/operativos">Operativos</a>
						<ul class="menusecundario menu">
							<li> 
								<a href="/operativos/salud">Salud</a> 
							</li> 
							<li> 
								<a href="/operativos/vivienda">Viviendas</a> 
							</li> 
							<li> 
								<a href="/operativos/humanitaria">Ayuda Humanitaria</a> 
							</li>
							<li> 
								<a href="/operativos/otros">Otros</a> 
							</li>
						</ul>
					</li>
					<li> 
						<a href="/catastros">Catastros</a> 
						<ul class="menusecundario menu">
							<li> 
								<a href="/catastros/salud">Salud</a> 
							</li> 
							<li> 
								<a href="/catastros/vivienda">Viviendas</a> 
							</li> 
							<li> 
								<a href="/catastros/humanitaria">Ayuda Humanitaria</a> 
							</li>
							<li> 
								<a href="/catastros/otros">Otros</a> 
							</li>
						</ul>
					</li>
					<li> 
						<a href="/comunas">Comunas</a> 
					</li> 
					<li> 
						<a href="/pages/coordinachile">CoordinaChile</a> 
					</li>
					<!--<li>
						<a href="http://blog.coordinachile.cl">Blog</a>
					</li> -->
			    </ul> 
			</div> 
		 	<!-- TERMINA HEADER -->
		 	
		 	<!-- INICIA CONTENIDO --> 
			<div id="container">
		    	<?php echo $content_for_layout; ?>
			</div>
			
			<div id="sidebar">
				<?php if($session->flash()) :?>
					<div id="flash" class="widget">
						<?php $session->flash(); ?>
					</div>
				<?php endif; ?>
				
				<?php echo $this->element('ingreso'); ?>
				
				<div id="contacto" class="widget">
					<h2>Contacto</h2>
					<ul>
						<li>Mesa de ayuda (56) 2 977 09 07</li> 
						<li><a href="mailto:contacto@coordinachile.cl">contacto@coordinachile.cl</a></li>
					</ul>		
				</div>
			</div> 
		 	<!-- TERMINA CONTENIDO --> 
		 
			<div class="clear"></div> 
		</div>
		
		<!-- TERMINA SITIO -->
		<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
		try {
		var pageTracker = _gat._getTracker("UA-15338869-1");
		pageTracker._trackPageview();
		} catch(err) {}</script>
	</body>
</html>
