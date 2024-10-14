<?if (@$datos['id_pagina']):?>
	<h3>Modificando página <span><?=@$datos['nombre']?></span></h3>
<?else:?>
	<h3>Nueva página institucional</h3>
<?endif;?>

<form action="?p=canchas|guardar" method="post" id="formulario">
	<input type="hidden" name="id" id="clave_primaria" value="<?=@$datos['id_cancha']?>" />
	<input type="hidden" name="x-volver" value="?p=home" />
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Nombre</div>
		<div class="campo"><input type="text" name="nombre" id="nombre" value="<?=escape(@$datos['nombre'])?>" class="inputs medium" maxlength="100" /></div>
	</div>
	<div class="clear"></div>
	
		<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Dirección</div>
		<div class="campo"><input type="text" name="direccion" id="direccion" value="<?=escape(@$datos['direccion'])?>" class="inputs medium" maxlength="100" /></div>
	</div>
	<div class="clear"></div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Telefono Fijo</div>
		<div class="campo"><input type="text" name="telefono" id="telefono" value="<?=escape(@$datos['telefono'])?>" class="inputs medium" maxlength="100" /></div>
	</div>
	<div class="clear"></div>
	
		<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Celular</div>
		<div class="campo"><input type="text" name="celular" id="celular" value="<?=escape(@$datos['celular'])?>" class="inputs medium" maxlength="100" /></div>
	</div>
	<div class="clear"></div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Email</div>
		<div class="campo"><input type="text" name="email" id="email" value="<?=escape(@$datos['email'])?>" class="inputs medium" maxlength="100" /></div>
	</div>
	<div class="clear"></div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Latitud (LAT) Ej: 23.234234 USAR EL PUNTO PARA SEPARAR</div>
		<div class="campo"><input type="text" name="lat" id="lat" value="<?=escape(@$datos['lat'])?>" class="inputs medium" maxlength="100" /></div>
	</div>
	<div class="clear"></div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Longitud (LNG) Ej: 33.126363</div>
		<div class="campo"><input type="text" name="lng" id="lng" value="<?=escape(@$datos['lng'])?>" class="inputs medium" maxlength="100" /></div>
	</div>
	<div class="clear"></div>

	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">NOTAS PRIVADAS</div>
		<div class="campo">
			<textarea name="notas" id="notas" class="inputs big" rows="10"><?=stripslashes(@$datos['notas'])?></textarea>
			
		</div>
	</div>
	<div class="clear"></div>
	<!--
	<div class="bloque-campo">
		<div class="titulo">Imágenes</div>
		<div class="campo">
			<iframe src="?p=upload&contenedor=paginas&origen=imagenes&destino=imagenes&sector=<?=SECTOR_PAGINAS?>&id_elemento=<?=@$datos['id_pagina']?>&extras[id_imagen]=<?=@$datos['id_imagen']?>" width="378" height="210"></iframe>
			<?include('views/widgets/ayuda-uploadimagen.tpl.php')?>
		</div>
	</div>
	
	<div class="clear"></div>
	
	<div class="bloque-campo">
		<div class="titulo">Archivos o documentos</div>
		<div class="campo">
			<iframe src="?p=upload&contenedor=productos&origen=archivos&destino=archivos&sector=<?=SECTOR_PAGINAS?>&id_elemento=<?=@$datos['id_pagina']?>" width="378" height="210"></iframe>
			<?include('views/widgets/ayuda-uploadarchivo.tpl.php')?>
		</div>
	</div>
	-->
	<div class="botones">
		<button type="submit" class="boton-grafico verde" title="Guardar">Guardar</button>
		<button type="submit" class="boton-grafico verde" name="guardarycargar" title="Guardar">Guardar y cargar otro</button>
		<button type="button" class="boton-grafico rojo" title="Cancelar" onclick="window.location.href='<?if(@$datos['id_cancha']):?><?=escape(@$_SERVER['HTTP_REFERER'])?><?else:?>canchas<?endif;?>'">Cancelar</button>
	</div>
</form>

<script type="text/javascript">
	$j().ready(function() {
		$j("form:first").preparar({
			deleteAction: false
		});
	});
</script>