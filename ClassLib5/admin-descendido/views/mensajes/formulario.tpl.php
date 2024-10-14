<?if (@$datos['id_mensaje']):?>
	<h3>Mensaje enviado desde la Web</h3>
<?else:?>
	<h3>Nuevo mensajes</h3>
<?endif;?>

<form action="?p=mensajes|guardar" method="post" id="formulario" autocomplete="off">
	<input type="hidden" name="id_mensaje" id="clave_primaria" value="<?=@$datos['id_mensaje']?>" />
	<input type="hidden" name="x-volver" value="<?if(@$datos['id_mensaje']):?><?=escape(@$_SERVER['HTTP_REFERER'])?><?else:?>?p=mensajes<?endif;?>" />
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo" style="width: 120px;">
		<div class="titulo">Fecha</div>
		<div class="campo"><b><?=mysql2date(@$datos['fecha'], '%d/%m/%Y %H:%i')?></b></div>
	</div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">IP remota</div>
		<div class="campo"><b><?=escape(@$datos['ip'])?></b></div>
	</div>
	<div class="clear"></div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo" style="width: 120px;">
		<div class="titulo">Nombre</div>
		<div class="campo"><b><?=escape(@$datos['nombre'])?></b></div>
	</div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo" style="width: 180px;">Mail</div>
		<div class="campo"><b><?=escape(@$datos['email'])?></b></div>
	</div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Teléfono</div>
		<div class="campo"><b><?=escape(@$datos['telefono'])?></b></div>
	</div>
	<div class="clear"></div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Comentario</div>
		<div class="campo">
			<b><?=nl2br(escape(@$datos['comentario']))?></b>
		</div>
	</div>
	<div class="clear"></div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Nota</div>
		<div class="campo">
			<textarea name="nota" id="nota" class="inputs big" rows="10"><?=escape(@$datos['nota'])?></textarea>
		</div>
	</div>
	<div class="clear"></div>
	
	<div class="botones">
		<button type="submit" class="boton-grafico verde" title="Guardar">Guardar</button>
		<button type="button" class="boton-grafico rojo" title="Cancelar" onclick="window.location.href='<?if(@$datos['id_mensaje']):?><?=escape(@$_SERVER['HTTP_REFERER'])?><?else:?>mensajes<?endif;?>'">Cancelar</button>
	</div>
</form>

<script type="text/javascript">
	$j().ready(function() {
		$j("form:first").preparar({
			deleteAction: false
		});
	});
</script>