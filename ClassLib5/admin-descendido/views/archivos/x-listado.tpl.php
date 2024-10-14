<style>
div.cuadrito {border: 1px dashed gray; width: 134px; margin: 8px 16px; float: left;}
a.descarga {display: block; vertical-align: middle; width: 120px; height: 80px; margin: 5px; text-align: center;}
a img {border: 0px none;}
.cont {width: 60px; margin: 0px 0px 8px 3px; text-align: center; float: left;}
</style>
<?foreach ($archivos as $item):?>
	<div class="cuadrito">
		<a href="" class="descarga descargar" clave_primaria="<?=$item['id_archivo']?>" title="<?=escape($item['nombre'])?> (<?=filesize(APP_PATH_ARCHIVOS."/{$item['id_archivo']}/archivo.dat")?> bytes)"><img src="images/down_64.png" /></a>
		<div class="cont">
			<a href="" class="descargar" clave_primaria="<?=$item['id_archivo']?>" title="Descargar archivo"><img src="images/image_field_write_16.png" /></a>
		</div>
		<div class="cont">
			<a href="" class="eliminar" clave_primaria="<?=$item['id_archivo']?>" title="Eliminar archivo"><img src="images/delete_16.png" /></a>
		</div>
	</div>
<?endforeach;?>

<script type="text/javascript">
$j().ready(function () {
	$j(".descargar").click(function () {
		window.location = "?p=archivos|x_descargar&id_archivo=" + $j(this).attr("clave_primaria");
		return false;
	});
	
	$j(".eliminar").click(function () {
		$this = $j(this);
		$j.post("?p=archivos|x_eliminar", {id_archivo: $this.attr("clave_primaria")}, function () {
			$this.parent().parent().fadeOut("fast", function () {
				$j(this).remove();
			});
		});
		return false;
	});
});
</script>