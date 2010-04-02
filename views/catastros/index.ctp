<h1>
	Catastros <?php if($area){ echo 'de '.$area; } ?>
</h1>

<div class="bloquegrande">
	<p class="intro">
		Revisa los catastros<?php if($area){ echo ' de '.$area; } ?> que las organizaciones estan realizando en estos momentos, as&iacute; como tambi&eacute;n los que ya han realizado, y los que pretenden concretar en el futuro. Haz clic en el nombre del catastro para ver su detalle. Tambi&eacute;n puedes revisar la situaci&oacute;n particular de cada localidad haciendo clic en su nombre.
	</p>
</div>
<?php if(!empty($ajax)): 
    echo $javascript->link('prototype.js');
endif; ?>

<?php if($catastros) : ?>
	<div id="paginar_catastros">
	<?php echo $this->element("paginar_catastros"); ?>
	</div>
	<div id="loading" style="display: none;"> 
		<?php echo $html->image('http://upload.wikimedia.org/wikipedia/commons/4/49/Linux_Ubuntu_Loader.gif'); ?> 
	</div>
<?php else : ?>
	<p>
		No existen catastros<?php if($area){ echo ' de '.$area; } ?> ingresados.
	</p>
	<?php if($auth) : ?>
		<p>
			<a href="/catastros/nuevo" title="Agregar un nuevo catastro">Agregar un nuevo catastro</a>
		</p>
	<?php endif; ?>
<?php endif; ?>
