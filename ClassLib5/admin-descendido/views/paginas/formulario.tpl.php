<?if (@$datos['id_pagina']):?>
	<h3>Modificando página <span><?=@$datos['nombre']?></span></h3>
<?else:?>
	<h3>Nueva página institucional</h3>
<?endif;?>

<form action="?p=paginas|guardar" method="post" id="formulario" autocomplete="off">
	<input type="hidden" name="id_pagina" id="clave_primaria" value="<?=@$datos['id_pagina']?>" />
	<input type="hidden" name="x-volver" value="?p=home" />
	<input type="hidden" name="identificador" id="identificador" value="<?=escape(@$datos['identificador'])?>" />
	<input type="hidden" name="maqueta" id="maqueta" value="<?=escape(@$datos['maqueta'])?>" />
	<input type="hidden" name="nombre" id="nombre" value="<?=escape(@$datos['nombre'])?>" />
	<input type="hidden" name="mapa" id="mapa" value="<?=escape(@$datos['mapa'])?>" />
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Título</div>
		<div class="campo"><input type="text" name="titulo" id="titulo" value="<?=escape(@$datos['titulo'])?>" class="inputs medium requerido" maxlength="100" /></div>
	</div>
	<div class="clear"></div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Descripción corta</div>
		<div class="campo">
			<textarea name="descripcion" id="descripcion" class="inputs big" rows="4"><?=escape(@$datos['descripcion'])?></textarea>
		</div>
	</div>
	<div class="clear"></div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Texto</div>
		<div class="campo">
			<textarea name="texto" id="texto" class="inputs big" rows="10"><?=stripslashes(@$datos['texto'])?></textarea>
			
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
		<button type="button" class="boton-grafico rojo" title="Cancelar" onclick="window.location.href='<?if(@$datos['id_pagina']):?><?=escape(@$_SERVER['HTTP_REFERER'])?><?else:?>paginas<?endif;?>'">Cancelar</button>
	</div>
</form>

<script type="text/javascript">
	$j().ready(function() {
		$j("form:first").preparar({
			deleteAction: false
		});
	});
</script>
