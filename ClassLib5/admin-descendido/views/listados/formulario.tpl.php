<?if (@$datos['id_listado']):?>
	<h3>Modificando módulo dinámico (configuración avanzada)</h3>
<?else:?>
	<h3>Nuevo módulo dinámico (configuración avanzada)</h3>
<?endif;?>

<form action="?p=listados|guardar" method="post" id="formulario" autocomplete="off">
	<input type="hidden" name="id_listado" id="clave_primaria" value="<?=@$datos['id_listado']?>" />
	<input type="hidden" name="x-volver" value="<?if(@$datos['id_listado']):?><?=escape(@$_SERVER['HTTP_REFERER'])?><?else:?>?p=listados<?endif;?>" />
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Controlador</div>
		<div class="campo"><input type="text" name="controlador" id="controlador" value="<?=escape(@$datos['controlador'])?>" class="inputs medium requerido" maxlength="50" /></div>
	</div>
	<div class="clear"></div>
	<div class="texto-ayuda" style="width: 400px;">
		<b><u style="color: red;">ATENCION:</u></b> Introducir sólo letras o el guión bajo, sin acentos ni eñes. No usar palabras reservadas (otros nombres de controladores existentes).
	</div>
	<div class="clear"></div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Título</div>
		<div class="campo"><input type="text" name="titulo" id="titulo" value="<?=escape(@$datos['titulo'])?>" class="inputs medium requerido" maxlength="150" /></div>
	</div>
	<div class="clear"></div>
	<div class="texto-ayuda" style="width: 400px;">
		Título descriptivo del listado dinámico. Se admite todo tipo de caracteres.
	</div>
	<div class="clear"></div>
	
	<div class="bloque-campo">
		<div class="titulo">Campo predeterminado de búsqueda</div>
		<div class="campo">
			<input type="hidden" name="id_campobusqueda" id="id_campobusqueda" value="<?=@$datos['id_campobusqueda']?>" />
			<input type="text" id="campo_busqueda" value="<?=escape(@$datos['campo_busqueda'])?>" class="inputs medium" />
		</div>
	</div>
	<div class="clear"></div>
	
	<div class="bloque-campo">
		<div class="titulo">Campo de ordenación</div>
		<div class="campo">
			<input type="hidden" name="id_campoorden" id="id_campoorden" value="<?=@$datos['id_campoorden']?>" />
			<input type="text" id="campo_orden" value="<?=escape(@$datos['campo_orden'])?>" class="inputs medium" />
		</div>
	</div>
	<div class="bloque-campo">
		<div class="titulo">Dirección de ordenación</div>
		<div class="campo">
			<select name="campo_orden_direccion" class="inputs medium">
				<option value="">&nbsp;</option>
				<option value="ASC" <?=@$datos['campo_orden_direccion'] == 'ASC' ? 'selected="selected"' : ''?>>Ascendente</option>
				<option value="DESC" <?=@$datos['campo_orden_direccion'] == 'DESC' ? 'selected="selected"' : ''?>>Descendente</option>
			</select>
		</div>
	</div>
	<div class="clear"></div>
	
	<div class="bloque-campo">
		<div class="titulo">Edición bloqueada <input type="checkbox" name="bloqueado" id="bloqueado" value="1" <?=@$datos['bloqueado'] ? 'checked="checked"' : ''?> /></div>
	</div>
	<div class="clear"></div>
	<div class="texto-ayuda" style="width: 400px;">
		Marcar esta opción si se quiere ocultar el módulo en el menú.
	</div>
	<div class="clear"></div>
	
	<div class="botones">
		<button type="submit" class="boton-grafico verde" title="Guardar">Guardar</button>
		<button type="button" class="boton-grafico rojo" title="Cancelar" onclick="window.location.href='<?if(@$datos['id_listado']):?><?=escape(@$_SERVER['HTTP_REFERER'])?><?else:?>listados<?endif;?>'">Cancelar</button>
	</div>
</form>

<script type="text/javascript">
	$j().ready(function() {
		$j("form:first").preparar({
			deleteAction: false
		});
		
		$j("#campo_busqueda").autocomplete("?p=campos_listado|x_autocompletar&id_listado=<?=@$datos['id_listado']?>", {matchContains: true, mustMatch: true, minChars:0, delay: 200});
		$j("#campo_busqueda").result(function(event, data, formatted) {
			if (data) $j(this).prev().val(data[1]);
			else $j(this).prev().val('');
		});
		$j("#campo_busqueda").change(function(event) {
			if ($j(this).val() == '') {
				$j(this).prev().val('');
			}
		});
		$j("#campo_orden").autocomplete("?p=campos_listado|x_autocompletar&id_listado=<?=@$datos['id_listado']?>", {matchContains: true, mustMatch: true, minChars:0, delay: 200});
		$j("#campo_orden").result(function(event, data, formatted) {
			if (data) $j(this).prev().val(data[1]);
			else $j(this).prev().val('');
		});
		$j("#campo_orden").change(function(event) {
			if ($j(this).val() == '') {
				$j(this).prev().val('');
			}
		});
	});
</script>