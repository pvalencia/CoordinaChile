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
		<link rel='index' title='Coordina Chile -  Coordinación de organizaciones voluntarias' href='http://www.coordinachile.cl' /> 

		<script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAAEbJVDLJQrWbQECox1QNqKBQlFJ7uMGmw31pn-fRymyxAeVKaWBS3180QHAhYGdBEW75YUlsUILZrEg"></script>
		<script type="text/javascript">
			google.load('jquery', '1.4.2');
			<?php if($auth) : ?>
				var auth = true;
				var user_id = <?php echo $user['Organizacion']['id']; ?>;
			<?php endif; ?>
			<?php if($user['Organizacion']['admin']) : ?>
				var admin = true;
			<?php endif; ?>
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
						<a  href="/" title="Coordina Chile">Inicio</a> 
					</li> 
					<li > 
						<a href="/organizaciones" title="Organizaciones que utilizan Coordina Chile">Organizaciones</a> 
					</li> 
					<li>
						<a href="/operativos" title="Operativos que realizan las organizaciones en diversas localidades">Operativos</a>
						<ul class="menusecundario menu">
							<li> 
								<a href="/operativos/salud" title="Operativos que socorren a la población en ámbitos de su salud">Salud</a> 
							</li> 
							<li> 
								<a href="/operativos/vivienda" title="Operativos enfocados a la reconstrucción y reparación de viviendas, y a la instalación de viviendas de emergencia">Viviendas</a> 
							</li> 
							<li> 
								<a href="/operativos/humanitaria" title="Operativos que llevan y entregan a la población abrigo, agua, alimentos, entre otros">Ayuda Humanitaria</a> 
							</li>
							<li> 
								<a href="/operativos/otros" title="Operativos que consideran el uso de maquinaria pesada de construcción, herramientas para reparaciones, entre otros">Otros</a> 
							</li>
						</ul>
					</li>
					<li> 
						<a href="/catastros" title="Catastros que realizan las organizaciones">Catastros</a> 
						<ul class="menusecundario menu">
							<li> 
								<a href="/catastros/salud" title="Catastros que entregan información sobre el estado de salud de la población">Salud</a> 
							</li> 
							<li> 
								<a href="/catastros/vivienda" title="Catastros sobre el estado y condición de las viviendas y construcciones">Viviendas</a> 
							</li> 
							<li> 
								<a href="/catastros/humanitaria" title="Catastros que entregan información sobre la situación del agua, la ropa, el abrigo, entre otros">Ayuda Humanitaria</a> 
							</li>
							<li> 
								<a href="/catastros/otros" title="Catastros sobre los problemas jurídicos de la población, entre otros">Otros</a> 
							</li>
						</ul>
					</li>
					<li> 
						<a href="/comunas" title="Listado de los operativos y catastros por regiones y comunas">Comunas</a> 
					</li> 
					<li> 
						<a href="/pages/coordinachile" title="¿Qué es Coordina Chile?">Coordina Chile</a> 
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

				<?php $session->flash(); ?>
				
				<?php echo $this->element('registro'); ?>
				
				<?php if($this->params['controller'] != 'organizaciones' || $this->params['action'] != 'nuevo' ): ?>
				<?php echo $this->element('ingreso'); ?>
				<?php endif; ?>	
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

			try {
				var pageTracker = _gat._getTracker("UA-15338869-1");
				pageTracker._trackPageview();
			} catch(err) {}
		</script>
	</body>
</html>
