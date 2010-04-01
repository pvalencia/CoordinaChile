<?php
Router::connect('/', array('controller' => 'comunas', 'action' => 'mapa'));

Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

Router::connect('/archivo/:id/:nombre', array('controller' => 'catastros', 'action' => 'bajar_archivo'), 
										array('id' => '\d+', 'nombre' => '.+'));

Router::parseExtensions('json');
?>
