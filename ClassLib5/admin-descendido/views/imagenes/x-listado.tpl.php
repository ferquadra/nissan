<style>
div.cuadrito {border: 1px dashed gray; width: 134px; margin: 8px 16px; float: left;}
a.zoom {display: block; vertical-align: middle; width: 120px; height: 80px; margin: 5px; text-align: center;}
a img {border: 0px none;}
.cont {width: 40px; margin: 0px 0px 8px 3px; text-align: center; float: left;}
</style>
<div id="imagen-bloque-<?=$sector?>-<?=$id_elemento?>">
<?foreach ($archivos as $item):?>
	<div class="cuadrito">
		<a href="<?=APP_URL_IMAGENES?>/<?=$item['id_imagen']?>/imagen.jpg" class="zoom" id_imagen="<?=$item['id_imagen']?>"><img src="<?=APP_URL_IMAGENES?>/<?=$item['id_imagen']?>/imagen_thumb.jpg" /></a>
		<div class="cont">
			<a href="" class="crop" id_imagen="<?=$item['id_imagen']?>" title="Recortar imagen"><img src="images/image_field_write_16.png" /></a>
		</div>
		<div class="cont">
			<input type="radio" name="predeterminar" value="<?=$item['id_imagen']?>" <?=isset($extras['id_imagen']) && $extras['id_imagen'] == $item['id_imagen'] ? 'checked="checked"' : ''?> class="predeterminar" title="Predeterminada" />
		</div>
		<div class="cont">
			<a href="" class="eliminar" id_imagen="<?=$item['id_imagen']?>" title="Eliminar imagen"><img src="images/delete_16.png" /></a>
		</div>
	</div>
<?endforeach;?>
</div>

<script type="text/javascript">
$j().ready(function () {
	$j("#imagen-bloque-<?=$sector?>-<?=$id_elemento?> .zoom").click(function () {
		parent.GB_showCenter("Zoom", "?p=imagenes|x_zoom&id_imagen=" + $j(this).attr("id_imagen"), 650, 850);
		return false;
	});
	
	$j("#imagen-bloque-<?=$sector?>-<?=$id_elemento?> .eliminar").click(function () {
		$this = $j(this);
		$j.post("?p=imagenes|x_eliminar", {id_imagen: $this.attr("id_imagen")}, function () {
			$this.parent().parent().fadeOut("fast", function () {
				$j(this).remove();
			});
		});
		return false;
	});
	
	$j("#imagen-bloque-<?=$sector?>-<?=$id_elemento?> .crop").click(function () {
		parent.GB_showCenter("Zoom", "?p=imagenes|x_recortar&sector=<?=$sector?>&id_elemento=<?=$id_elemento?>&id_imagen=" + $j(this).attr("id_imagen"), 750, 850);
		return false;
	});
	
	$j("#imagen-bloque-<?=$sector?>-<?=$id_elemento?> .predeterminar").click(function () {
		$j.post("?p=<?=$contenedor?>|x_predeterminar_imagen", {id: <?=$id_elemento ? $id_elemento : 'null'?>, id_imagen: $j(this).val(), extras: $j(".input-extras").serialize()});
		$j("input[name='extras[id_imagen]']").val($j(this).val());
	});
});
</script>