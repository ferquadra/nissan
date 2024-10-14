<?if (@$datos['id_marcaproducto']):?>
<h3>Modificando marca de producto</h3>
<?else:?>
<h3>Nueva marca de producto</h3>
<?endif;?>

<form action="?p=marcas_producto|guardar" method="post" id="formulario" autocomplete="off">
	<input type="hidden" name="id_marcaproducto" id="clave_primaria" value="<?=@$datos['id_marcaproducto']?>" />
	<div class="bloque-campo">
		<div class="titulo">Nombre</div>
		<div class="campo"><input type="text" name="nombre" id="nombre" class="inputs medium requerido" title="Debe ingresar el nombre." value="<?=escape(@$datos['nombre'])?>" /></div>
	</div>
	
	<div class="bloque-campo">
		<div class="titulo">Código</div>
		<div class="campo"><input type="text" name="codigo" id="codigo" class="inputs small" title="" value="<?=escape(@$datos['codigo'])?>" /></div>
	</div>
	
	<div class="clear"></div>
	
	<div class="bloque-campo">
		<div class="titulo">Descripción corta</div>
		<div class="campo"><input type="text" name="descripcion" id="descripcion" class="inputs big" title="" value="<?=escape(@$datos['descripcion'])?>" /></div>
	</div>
	
	<div class="clear"></div>
	
	<div class="bloque-campo">
		<div class="titulo">Texto</div>
		<div class="campo">
			<textarea name="texto" id="texto" class="inputs big" rows="10" /><?=escape(@$datos['texto'])?></textarea>
			<?if (Configuracion::ObtenerValor(CONFIGURACION_USAR_CKEDITOR) == 1):?>
				<?include('views/widgets/ayuda-ckeditor.tpl.php')?>
				<?require_once(APP_ADDONS_PATH.'/ckeditor.js.php');?>
				<script type="text/javascript">
					$j().ready(function () {
						$j("#texto").ckeditor({toolbar: "Basic"});
					});
				</script>
			<?endif;?>
		</div>
	</div>
	
	<div class="clear"></div>
	
	<div class="bloque-campo">
		<div class="titulo">Imágenes</div>
		<div class="campo">
			<iframe src="?p=upload&contenedor=marcas_producto&origen=imagenes&destino=imagenes&sector=<?=SECTOR_MARCAS?>&id_elemento=<?=@$datos['id_marcaproducto']?>&extras[id_imagen]=<?=@$datos['id_imagen']?>" width="378" height="210"></iframe>
			<?include('views/widgets/ayuda-uploadimagen.tpl.php')?>
		</div>
	</div>
	
	<div class="clear"></div>
	
	<div class="bloque-campo">
		<div class="titulo">Opciones adicionales</div>
		<div class="campo">
			<input type="checkbox" name="publicado" id="publicado" value="1" <?=!isset($datos) || @$datos['publicado'] ? 'checked="checked"' : ''?> /> <label for="publicado">Publicada</label>
		</div>
	</div>
	
	<div class="clear"></div>
	
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