<?php
class VistasHelper extends AppHelper {
	function getNum($text) {
		if($text)
			return $text;
		else
			return '0';
	}
	
	function getFechaFin($fecha_ini, $duracion_dias) {
		return strtotime($fecha_ini)+(($duracion_dias-1)*24*60*60);
	}
	
	function getClassExtensionArchivo($nombre_archivo) {
		$partes = explode('.', $nombre_archivo);
		
		return 'archivo'.$partes[count($partes)-1];
	}
	
	function text2p($text, $class = 'intro') {
		$saltos_text = array("\r\n", "\r", "\n");
		$salto = '<br/>';
		$reemplazo = str_replace($saltos_text, $salto, $text);
		return '<p class="'.$class.'">'.str_replace($salto.$salto, '</p><p class="'.$class.'">', $reemplazo).'</p>';
	}
}
?>