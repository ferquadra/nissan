<?if (@$datos['id_estadopedido']):?>
	<h3>Modificando estado de pedido</h3>
<?else:?>
	<h3>Nuevo estado de pedido</h3>
<?endif;?>

<form action="?p=estados_pedido|guardar" method="post" id="formulario" autocomplete="off">
	<input type="hidden" name="id_estadopedido" id="clave_primaria" value="<?=@$datos['id_estadopedido']?>" />
	<input type="hidden" name="x-volver" value="<?if(@$datos['id_estadopedido']):?><?=escape(@$_SERVER['HTTP_REFERER'])?><?else:?>?p=estados_pedido<?endif;?>" />
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Nombre</div>
		<div class="campo"><input type="text" name="nombre" id="nombre" value="<?=escape(@$datos['nombre'])?>" class="inputs medium requerido" maxlength="80" /></div>
	</div>
	<div class="clear"></div>
	
	<div class="botones">
		<button type="submit" class="boton-grafico verde" title="Guardar">Guardar</button>
		<button type="button" class="boton-grafico rojo" title="Cancelar" onclick="window.location.href='<?if(@$datos['id_estadopedido']):?><?=escape(@$_SERVER['HTTP_REFERER'])?><?else:?>estados_pedido<?endif;?>'">Cancelar</button>
	</div>
</form>

<script type="text/javascript">
	$j().ready(function() {
		$j("form:first").preparar({
			deleteAction: false
		});
	});
</script>