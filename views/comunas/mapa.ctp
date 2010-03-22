<?php if($full): ?>
	<div id="map_canvas" class="canvasmapa ancho100 mapacompleto"></div>
<?php else: ?>
	<h1>
		Operativos
	</h1>
	
	<div class="bloquegrande">
		<p class="intro">
			Revisa los operativos por comunas que las distintas organizaciones que utilizan Coordina Chile han realizado, tienen programados realizar, o que en estos momentos estan llevando a cabo. Haz clic en los marcadores <span class="icono operativo">Operativos</span> para ver un resumen general de las cantidades de recursos y voluntarios que se han llevado y participado en cada comuna. 
		</p>
	</div>
	
	<div id="carpetas">
		<div id="lenguetas">
			<ul class="menu">
				<li class="lengueta active" id="lenguetaactivos">
					<a href="#" title="Operativos que se estan realizando en estos momentos">Activos</a>
				</li>
				<li class="lengueta" id="lenguetaprogramados">
					<a href="#" title="Operativos que se han agendado para realizar en el futuro">Agendados</a>
				</li>
				<li class="lengueta" id="lenguetarealizados">
					<a href="#" title="Operativos que ya se han realizado y concluido">Realizados</a>
				</li>
			</ul>
			<div class="clear"></div>
		</div>
		<div id="carpeta">
			<div class="lenguetaactivos carpeta active">
				<?php if($comunasactivos) :?>
					<div id="mapaoperativosactivos" class="canvasmapa mapagrande ancho100"></div>
				<?php else: ?>
					<p>
						No existen operativos activos.
					</p>
				<?php endif; ?>
			</div>
			<div class="lenguetaprogramados carpeta oculto">
				<?php if($comunasprogramados) :?>
					<div id="mapaoperativosprogramados" class="canvasmapa mapagrande ancho100"></div>
				<?php else: ?>
					<p>
						No existen operativos agendados.
					</p>
				<?php endif; ?>
			</div>
			<div class="lenguetarealizados carpeta oculto">
				<?php if($comunasrealizados) :?>
					<div id="mapaoperativosrealizados" class="canvasmapa mapagrande ancho100"></div>
				<?php else: ?>
					<p>
						No existen operativos realizados.
					</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php if($comunasactivos || $comunasprogramados || $comunasrealizados) : ?>
	<?php echo $javascript->link('http://maps.google.com/maps/api/js?sensor=true'); ?>
	<?php echo $javascript->link('mapa.js'); ?>
	<script type="text/javascript">
		$(document).ready(function() {
			<?php if($comunasactivos) :?>
				var comunas_activos = <?php echo $javascript->Object($comunasactivos); ?>;
				var params_activos = {
					controlador: 'comunas',
					vista: 'mapa',
					canvasmapa_id: 'mapaoperativosactivos',
					tipo: 'operativos',
					nombre: 'Operativo'
				};
		
				cargarMapa(comunas_activos, params_activos);
			<?php endif; ?>
			<?php if($comunasprogramados) :?>
				var comunas_programados = <?php echo $javascript->Object($comunasprogramados); ?>;
				var params_programados = {
					controlador: 'comunas',
					vista: 'mapa',
					canvasmapa_id: 'mapaoperativosprogramados',
					tipo: 'operativos',
					nombre: 'Operativo'
				};
		
				cargarMapa(comunas_programados, params_programados);
			<?php endif; ?>
			<?php if($comunasrealizados) :?>
				var comunas_realizados = <?php echo $javascript->Object($comunasrealizados); ?>;
				var params_realizados = {
					controlador: 'comunas',
					vista: 'mapa',
					canvasmapa_id: 'mapaoperativosrealizados',
					tipo: 'operativos',
					nombre: 'Operativo'
				};
		
				cargarMapa(comunas_realizados, params_realizados);
			<?php endif; ?>
		});
	</script>
<?php endif; ?>
