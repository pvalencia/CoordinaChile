<h1>
	Operativos <?php if($area){ echo 'de '.$area; } ?>
</h1>

<div class="bloquegrande">
	<p class="intro">
		Revisa los operativos<?php if($area){ echo ' de '.$area; } ?> que se est&aacute;n realizando en estos momentos, as&iacute; como tambi&eacute;n los que ya se han realizado, y los que se pretenden concretar en el futuro. Haz clic en el nombre del operativo para ver su detalle. Tambi&eacute;n puedes revisar la situaci&oacute;n particular de cada localidad haciendo clic en su nombre.
	</p>
</div>
<?php
$carpetas_class = array(
	'activos' => array('', ' oculto'),
	'programados' => array('', ' oculto'),
	'realizados' => array('', ' oculto')
);
$carpetas_class[$tipo] = array(' active', ' active');

if(!empty($ajax)): 
    echo $javascript->link('prototype.js');
endif; 
?>
	<div id="carpetas">
		<div id="lenguetas">
			<ul class="menu">
				<li class="lengueta<?php echo $carpetas_class['activos'][0]; ?>" id="lenguetaactivos">
				<?php echo $ajax->link('Activos', array('tipo' => 'activos'), 
						array('title' => "Operativos que se están realizando en estos momentos", 'update'=>'paginar_operativos', 'indicator' => 'loading', 'complete' => "$('lenguetaactivos').addClassName('active');$('lenguetaprogramados').removeClassName('active');$('lenguetarealizados').removeClassName('active');  ")); // 'complete' agregado para funcionamiento correcto de lenguetas (con prototype y todo el ajax hubo conflictos con método usual)?>	
				</li>
				<li class="lengueta<?php echo $carpetas_class['programados'][0]; ?>" id="lenguetaprogramados">
				<?php echo $ajax->link('Agendados', array('tipo' => 'programados'), 
						array('title' => "Operativos que se han agendado para realizarse en el futuro", 'update'=>'paginar_operativos', 'indicator' => 'loading', 'complete' => "$('lenguetaactivos').removeClassName('active');$('lenguetaprogramados').addClassName('active');$('lenguetarealizados').removeClassName('active');  "));?>
				</li>
				<li class="lengueta<?php echo $carpetas_class['realizados'][0]; ?>" id="lenguetarealizados">
				<?php echo $ajax->link('Realizados', array('tipo' => 'realizados'), 
						array('title' => "Operativos que ya se han realizado y concluído", 'update'=>'paginar_operativos', 'indicator' => 'loading', 'complete' => "$('lenguetaactivos').removeClassName('active');$('lenguetaprogramados').removeClassName('active');$('lenguetarealizados').addClassName('active');  "));?>
				</li>
			</ul>
			<div class="clear"></div>
		</div>
		<div id="carpeta">
			<?php 
			$j = 0;
/*			foreach($operativos as $key => $operativos_modo): */
			?>
			<div class="lengueta<?php echo $tipo; ?> carpeta<?php echo $carpetas_class[$tipo][1]; ?>">
				<div id="paginar_operativos">
				<?php echo $this->element("paginar_operativos"); ?>
				</div>
				<div id="loading" style="display: none;"> 
					<?php echo $html->image('http://upload.wikimedia.org/wikipedia/commons/4/49/Linux_Ubuntu_Loader.gif'); ?> 
				</div>
			</div>
			<?php /*endforeach;*/ ?>
		</div>
	</div>
<?php if($operativos) : ?>
	
<?php else : ?>
	<p>
		No existen operativos<?php if($area){ echo ' de '.$area; } ?> ingresados.
	</p>
	<?php if($auth) : ?>
		<p>
			<a href="/operativos/nuevo" title="Agregar un nuevo operativo">Agregar un nuevo operativo</a>
		</p>
	<?php endif; ?>
<?php endif; ?>
