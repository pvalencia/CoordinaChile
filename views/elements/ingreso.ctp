<?php 
	echo $form->create('Organizacion', array('url' => array('controller' => 'organizaciones', 'action' => 'ingreso')));
    echo $form->input('Organizacion.email');
    echo $form->input('Organizacion.password');
    echo $form->submit('Ingresar');
	echo $form->end(); 
?>
