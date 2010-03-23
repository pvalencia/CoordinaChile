<?php
Router::connect('/', array('controller' => 'comunas', 'action' => 'mapa'));


Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
Router::connect('/organizaciones', array('controller' => 'organizaciones', 'action' => 'todos'));
Router::connect('/catastros', array('controller' => 'catastros', 'action' => 'todos'));
Router::connect('/operativos', array('controller' => 'operativos', 'action' => 'todos'));
Router::connect('/comunas', array('controller' => 'comunas', 'action' => 'todos'));
Router::connect('/archivo/:id/:nombre', array('controller' => 'catastros', 'action' => 'bajar_archivo'), 
										array('id' => '\d+', 'nombre' => '.+'));


Router::parseExtensions('json');
?>
