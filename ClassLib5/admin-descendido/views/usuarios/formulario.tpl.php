<?if (@$datos['id_usuario']):?>
<h3>Modificando usuario</h3>
<?else:?>
<h3>Nuevo usuario</h3>
<?endif;?>

<form action="?p=usuarios|guardar" method="post" id="formulario" autocomplete="off">
	<input type="hidden" name="id_usuario" id="clave_primaria" value="<?=@$datos['id_usuario']?>" />
	
	<div class="bloque-campo">
		<div class="titulo">Nombre y apellido</div>
		<div class="campo"><input type="text" name="nombre" id="nombre" class="inputs medium requerido" title="Debe ingresar el nombre." value="<?=escape(@$datos['nombre'])?>" /></div>
	</div>
	
	<div class="clear"></div>
	
	<div class="bloque-campo">
		<div class="titulo">Email (necesario para iniciar sesión)</div>
		<div class="campo"><input type="text" name="email" id="email" class="inputs big requerido" title="Debe ingresar el email." value="<?=escape(@$datos['email'])?>" /></div>
	</div>
	
	<div class="bloque-campo">
		<div class="titulo">Clave</div>
		<div class="campo"><input type="text" name="clave" id="clave" class="inputs small requerido" title="" value="<?=escape(@$datos['pass'])?>" /></div>
	</div>
	
	<div class="clear"></div>
	
	<div class="bloque-campo">
		<div class="titulo">Localidad</div>
		<div class="campo">
			<select name="loc" id="loc" class="inputs medium">
				<option value="">Ninguna...</option>
			</select>
		</div>
	</div>
		
	<div class="clear"></div>
	
	<div class="bloque-campo">
		<div class="titulo">DNI</div>
		<div class="campo"><input type="text" name="dni" id="dni" class="inputs medium" title="" value="<?=escape(@$datos['dni'])?>" /></div>
	</div>
	
	<div class="clear"></div>
	
	<div class="bloque-campo">
		<div class="titulo">Localidad</div>
		<div class="campo"><input type="text" name="localidad" id="localidad" class="inputs medium" title="" value="<?=escape(@$datos['localidad'])?>" /></div>
	</div>
	
	<div class="clear"></div>

	<div class="bloque-campo">
		<div class="titulo">Teléfono</div>
		<div class="campo"><input type="text" name="telefono" id="telefono" class="inputs medium" title="" value="<?=escape(@$datos['telefono'])?>" /></div>
	</div>
	
	<div class="clear"></div>
	
	<div class="bloque-campo">
		<div class="titulo">Notas (ingresadas por el usuario)</div>
		<div class="campo" id="campo-texto">
			<textarea name="nota" id="nota" class="inputs big" rows="10" /><?=escape(@$datos['horarios'])?></textarea>
		</div>
	</div>
	
	<div class="bloque-campo">
		<div class="titulo">Observaciones (ingresadas por el administrador)</div>
		<div class="campo" id="campo-texto">
			<textarea name="observacion" id="observacion" class="inputs big" rows="10" /><?=escape(@$datos['fb_friends'])?></textarea>
		</div>
	</div>
	
	<div class="clear"></div>
	
	<div class="bloque-campo">
		<div class="titulo">Opciones de registro:</div>
		<div class="campo">
			<input type="checkbox" name="activo" id="activo" value="1" <?=!@$datos['id_usuario'] || @$datos['activo'] ? 'checked="checked"' : ''?> disabled="disabled" /> <img src="images/ok_16.png" align="absmiddle" /> Activo <small>(se completó el proceso de activación por email).</small><br />
			<input type="checkbox" name="bloqueado" id="bloqueado" value="1" <?=@$datos['bloqueado'] ? 'checked="checked"' : ''?> /> <label for="bloqueado"><img src="images/clients_cancel_16.png" align="absmiddle" /> Bloqueado <small>(utilice esta opción si quiere denegar el acceso al usuario).</small></label><br />
		</div>
	</div>
	
	<div class="clear"></div>
	
	<?if (@$datos['id_usuario']):?>
	<hr />
	<div class="bloque-campo">
		<div class="titulo"><b><u>Estadísticas básicas del usuario.</u></b></div>
		
		<div id="contenedor-campos">
			Fecha de alta: <b><?=mysql2date($datos['fecha_alta'], '%d/%m/%Y %H:%i')?></b><br />
			Alta desde la administración: <b><?=$datos['alta_admin'] ? 'Sí' : 'No'?></b><br />
			Fecha de último ingreso: <b><?=mysql2date($datos['ultimo_ingreso'], '%d/%m/%Y %H:%i')?></b><br />
			<!--Fecha de última actividad: <b><?=mysql2date($datos['ultima_actividad'], '%d/%m/%Y %H:%i')?></b><br />-->
		</div>
	</div>
	
	<div class="clear"></div>
	<?endif;?>
	
	<div class="botones">
		<button type="submit" class="boton-grafico verde" title="Guardar">Guardar</button>
		<button type="button" class="boton-grafico rojo" title="Cancelar" onclick="window.location.href='?p=menu'">Cancelar</button>
	</div>
</form>
<script type="text/javascript">
	$j().ready(function() {
		$j("form:first").preparar({
			deleteAction: false
		});
	});
</script>