<?if (@$datos['id_anuncio']):?>
	<h3>Modificando anuncios</h3>
<?else:?>
	<h3>Nuevo anuncio</h3>
<?endif;?>

<form action="?p=anuncios|guardar" method="post" id="formulario" autocomplete="off">
	<input type="hidden" name="id_anuncio" id="clave_primaria" value="<?=@$datos['id_anuncio']?>" />
	<input type="hidden" name="x-volver" value="<?if(@$datos['id_anuncio']):?><?=escape(@$_SERVER['HTTP_REFERER'])?><?else:?>?p=anuncios<?endif;?>" />
	
	<div class="tabs">
		<ul class="menutabs">
			<li class="selected" rel="anuncio-tab1">Datos del anuncio</li>
			<li rel="anuncio-tab2">Ubicación en el sitio</li>
			<div style="clear: both; height: 0px;"></div>
		</ul>
		<div class="tabcontent">
			<div class="hiddentabs">
				<div class="anuncio-tab1" style="display: none;">
					<?include('views/anuncios/tab-datos.tpl.php')?>
				</div>
				<div class="anuncio-tab2" style="display: none;">
					<?include('views/anuncios/tab-ubicacion.tpl.php')?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="botones">
		<button type="submit" class="boton-grafico verde" title="Guardar">Guardar</button>
		<button type="button" class="boton-grafico rojo" title="Cancelar" onclick="window.location.href='<?if(@$datos['id_anuncio']):?><?=escape(@$_SERVER['HTTP_REFERER'])?><?else:?>anuncios<?endif;?>'">Cancelar</button>
	</div>
</form>
	
<script type="text/javascript">
	$j().ready(function() {
		$j("form:first").preparar({
			deleteAction: false
		});
		
		$j().tabs();
	});
</script>