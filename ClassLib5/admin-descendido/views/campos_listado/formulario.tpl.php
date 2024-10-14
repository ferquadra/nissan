<?if (@$datos['id_campolistado']):?>
	<h3>Modificando campos de módulo "<?=$listado_dinamico['titulo']?>" (configuración avanzada)</h3>
<?else:?>
	<h3>Nuevo campo de módulo "<?=$listado_dinamico['titulo']?>" (configuración avanzada)</h3>
<?endif;?>

<form action="?p=campos_listado|guardar&id_listado=<?=$listado_dinamico['id_listado']?>" method="post" id="formulario" autocomplete="off">
	<input type="hidden" name="id_campolistado" id="clave_primaria" value="<?=@$datos['id_campolistado']?>" />
	<input type="hidden" name="x-volver" value="<?if(@$datos['id_campolistado']):?><?=escape(@$_SERVER['HTTP_REFERER'])?><?else:?>?p=campos_listado&id_listado=<?=$listado_dinamico['id_listado']?><?endif;?>" />
	<input type="hidden" name="id_listado" id="id_listado" value="<?=$listado_dinamico['id_listado']?>" />
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Nombre o título</div>
		<div class="campo"><input type="text" name="titulo" id="ortituloden" value="<?=escape(@$datos['titulo'])?>" class="inputs medium requerido" /></div>
	</div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Tipo</div>
		<div class="campo">
			<select name="tipo" id="tipo" class="inputs medium requerido">
				<?asort($tipos)?>
				<?foreach ($tipos as $nId => $item):?>
				<option value="<?=$nId?>" <?=$nId == @$datos['tipo'] ? 'selected="selected"' : ''?>><?=$item['titulo']?></option>
				<?endforeach;?>
			</select>
		</div>
	</div>
	<div class="clear"></div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Datos extra</div>
		<div class="campo"><input type="text" name="extra" id="extra" value="<?=escape(@$datos['extra'])?>" class="inputs big" /></div>
	</div>
	<div class="clear"></div>
	<div class="texto-ayuda" style="width: 400px;">
		<b>Carga de archivos:</b><br />
		<br />
		
		<b>Carga de imágenes:</b><br />
		<u>limite=n;</u> - Define la cantidad máxima de archivos a subir.<br />
		<br />
		
		<b>Google map:</b><br />
		<br />
		
		<b>Opción de selección:</b><br />
		<u>productos</u> - Módulo de productos (similar para demás módulos).<br />
		<u>registros&id_listado=n;</u> - Módulo dinámico ('n' identifica el listado).<br />
		<br />
		
		<b>Opción de selección:</b><br />
		<u>checked=n;</u> - Indica el valor de la opción seleccionada por defecto.<br />
		<br />
		
	</div>
	<div class="clear"></div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Orden</div>
		<div class="campo"><input type="text" name="orden" id="orden" value="<?=escape(@$datos['orden'])?>" class="inputs small requerido" /></div>
	</div>
	<div class="clear"></div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Texto de ayuda</div>
		<div class="campo"><textarea name="ayuda" id="ayuda" class="inputs big" rows="4" /><?=escape(@$datos['ayuda'])?></textarea></div>
	</div>
	<div class="clear"></div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Requerido</div>
		<div class="campo"><input type="checkbox" name="requerido" id="requerido" value="1" <?=@$datos['requerido'] ? 'checked="checked"' : ''?> /></div>
	</div>
	<div class="clear"></div>
	
	<div class="botones">
		<button type="submit" class="boton-grafico verde" title="Guardar">Guardar</button>
		<button type="button" class="boton-grafico rojo" title="Cancelar" onclick="window.location.href='<?if(@$datos['id_campolistado']):?><?=escape(@$_SERVER['HTTP_REFERER'])?><?else:?>campos_listado<?endif;?>'">Cancelar</button>
	</div>
</form>

<script type="text/javascript">
	$j().ready(function() {
		$j("form:first").preparar({
			deleteAction: false
		});
	});
</script>