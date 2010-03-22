<?php
class RegionesHelper extends AppHelper {
	function getRegiones(){
		return array(13 => 'Metropolitana', 
					  5 => 'Valparaíso',
					  6 => 'O\'Higgins',
					  7 => 'Maule',
					  8 => 'Bío-Bío',
					  9 => 'Araucanía');
	}
	
	function getRegionId($id_comuna){
		return (int)($id_comuna/1000);
	}
	
	function getName($id, $is_comuna_id = false){
		if($is_comuna_id){
			$id = $this->getRegionId($id);
		}
		$regiones = $this->getRegiones();
		return $regiones[$id];
	}
	
	function getHtmlName($id, $is_comuna_id = false){
		if($is_comuna_id){
			$id = $this->getRegionId($id);
		}
		$regiones_html = array(13 => 'Metropolitana', 
					  5 => 'Valparaíso',
					  6 => 'O\'Higgins',
					  7 => 'Maule',
					  8 => 'Bío-Bío',
					  9 => 'Araucanía');
		return $regiones_html[$id];
	}
	
	function getFullHtmlName($id, $is_comuna_id = false){
		if($is_comuna_id){
			$id = $this->getRegionId($id);
		}
		$regiones_html = array(13 => 'Metropolitana', 
					  5 => 'de Valpara&iacute;so',
					  6 => 'de O\'Higgins',
					  7 => 'del Maule',
					  8 => 'del B&iacute;o-B&iacute;o',
					  9 => 'de la Araucan&iacute;a');
		return "Regi&oacute;n ".$regiones_html[$id];
	}
}
?>