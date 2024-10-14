<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="es-ar" />
	<?require_once(APP_ADDONS_PATH.'/jquery.php')?>
	<script>var $j = jQuery.noConflict();</script>
	<?require_once(APP_ADDONS_PATH.'/jcrop.php')?>
	<style type="text/css">
		#imagen {border: 1px solid #999;}
		.opciones {background: #eee; height: 90px; margin-bottom: 10px; padding: 3px;}
		BODY, TABLE, TD {font-family: "Trebuchet MS", sans-serif;margin: 0px;font-size: 8pt;}
		h1 {margin: 0px; font-weight: bold; font-size: 10pt; color: #4F998D;}
		input[type=radio], label {cursor: pointer;}
		.recorte {border: 1px dashed white; width: 200px; float: left; padding: 2px; margin: 2px;}
	</style>
</head>
<body>
<div align="center">
	<div class="opciones" align="left">
		<button type="button" class="boton-grafico verde" id="guardar" title="Guardar" disabled="disabled" style="float: left; margin-top: 6px;">Guardar</button>
		<div style="float: left; width: 20px; height: 20px; margin-top: 6px;">
			<img src="images/loading_16.gif" align="absmiddle" style="display: none;" id="cargando" />
		</div>
		<h1>Opciones de recorte:</h1>
		<small>Seleccione una opción para realizar el recorte.</small>
		<br />
		<?
		if ($sector == SECTOR_CAMPOS_REGISTRO) {
			// Recortes definidos de forma dinámica para los registros dinámicos.
			$aRecortes = array();
			
			$oRL = new Registros_listado();
			$oRL->IdRegistrolistado = $id_elemento;
			$oRL->Obtener();
			
			$oCL = new Campos_listado();
			$oCL->IdCampolistado = $oRL->IdCampolistado;
			$oCL->Obtener();
			preg_match_all("/(([^\=\;]+)\=([0-9]+)x([0-9]+));/", $oCL->Extra, $aSpt);
			
			foreach ($aSpt[0] as $pos => $item) {
				// Hay una serie de palabras reservadas, las ignora.
				if (in_array($item, array('limite'))) {
					continue;
				}
				
				$aRecortes[] = array('descripcion'=> $aSpt[2][$pos], 'ancho'=>$aSpt[3][$pos], 'alto'=>$aSpt[4][$pos]);
			}
		}
		else {
			if (isset($GLOBALS['CROPS'][$sector]['elem'][$id_elemento])) {
				$aRecortes = (array)@$GLOBALS['CROPS'][$sector]['elem'][$id_elemento];
			}
			else {
				$aRecortes = (array)@$GLOBALS['CROPS'][$sector]['sector'];
			}
		}
		?>
		
		<?foreach ($aRecortes as $pos => $item):?>
			<div class="recorte">
				<?if (file_exists(APP_PATH_IMAGENES."/{$id_imagen}/imagen_{$item['ancho']}x{$item['alto']}.jpg")):?>
					<img src="images/ok_16.png" align="absmiddle" class="estado" />
				<?else:?>
					<img src="images/cancel_16.png" align="absmiddle" class="estado" />
				<?endif;?>
				<input type="radio" name="recortes" class="recortes" id="recorte_<?=$pos?>" value="1" ancho="<?=$item['ancho']?>" alto="<?=$item['alto']?>" />
				<label for="recorte_<?=$pos?>"><?=$item['descripcion']?> (<?=$item['ancho']?> x <?=$item['alto']?>)</label>
			</div>
		<?endforeach;?>
	</div>
	<img src="<?=APP_URL_IMAGENES?>/<?=$id_imagen?>/imagen.jpg" id="imagen" />
</div>
<script type="text/javascript">
$j().ready(function () {
	//$j("#imagen").Jcrop();
	var $radio = null;
	var $crop = null;
	
	$j(".recortes").click(function () {
		var $this = $j(this);
		
		// Deselecciona el anterior.
		if ($radio != null) {
			$crop.destroy();
			$radio.parent().css("background", "transparent").css("color", "black");
		}
		
		// Marca como seleccionado al actual.
		$this.parent().css("background", "#999").css("color", "white");
		$crop = $j.Jcrop('#imagen',{
			aspectRatio: $this.attr("ancho") / $this.attr("alto"),
			setSelect:   [ 0, 0, $this.attr("ancho"), $this.attr("alto") ],
			allowSelect: false
		});
		
		// Establece el anterior al que se le hizo click.
		$radio = $this;
		
		// Habilita el boton guardar.
		$j("#guardar").attr("disabled", false);
	});
	
	$j("#guardar").click(function () {
		$j("#cargando").fadeIn("fast");
		
		var $pars = $crop.tellSelect();
		$pars.id_imagen = <?=$id_imagen?>;
		
		$pars.ancho = $j(".recortes:checked").attr("ancho");
		$pars.alto = $j(".recortes:checked").attr("alto");
		
		$j.post("?p=imagenes|x_efectuar_recorte", $pars, function () {
			$j("#cargando").fadeOut("slow");
			$radio.prev().attr("src", "images/ok_16.png");
		});
		
	});
});

</script>
</body>
</html>