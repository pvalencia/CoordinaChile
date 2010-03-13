<h1>
	Inicio de sesi&oacute;n
</h1>
<p>
	<?php
	if($session->flash('auth')) :
		$session->flash('auth');
	else :
	?>
		Inicia tu sesi&oacute;n ingresando tu correo electr&oacute;nico y contrase&ntilde;a.
	<?php
	endif;
	?>
</p>
