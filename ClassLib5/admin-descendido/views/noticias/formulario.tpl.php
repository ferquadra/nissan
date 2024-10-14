<?if (@$datos['id_noticias']):?>
	<h3>Modificando noticias</h3>
<?else:?>
	<h3>Nuevo noticias</h3>
<?endif;?>

<form action="?p=noticias|guardar" method="post" id="formulario" autocomplete="off">
	<input type="hidden" name="id_noticias" id="clave_primaria" value="<?=@$datos['id_noticias']?>" />
	<input type="hidden" name="x-volver" value="<?if(@$datos['id_noticias']):?><?=escape(@$_SERVER['HTTP_REFERER'])?><?else:?>?p=noticias<?endif;?>" />

	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">título del noticias</div>
		<div class="campo"><input type="text" name="nombre" id="nombre" value="<?=escape(@$datos['nombre'])?>" class="inputs medium requerido" maxlength="100" /></div>
	</div>
	
	<div class="bloque-campo">
		<div class="titulo">Enlace (Incluir http://)</div>
		<div class="campo"><input type="text" name="descripcion" id="descripcion" class="inputs big" title="" value="<?=escape(@$datos['descripcion'])?>" /></div>
	</div>
	
	<div class="clear"></div>

	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Opciones de publicación</div>
		<div class="campo">
			<input type="checkbox" name="publicado" id="publicado" value="1" <?=!isset($datos['publicado']) || @$datos['publicado'] ? 'checked="checked"' : ''?> /> <label for="publicado">Publicado</label>
		</div>
	</div>
	<div class="clear"></div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Contenido</div>
		<div class="campo">
			<textarea name="notas" id="notas" class="inputs big" rows="10"><?=escape(@$datos['notas'])?></textarea>
			<?if (Configuracion::ObtenerValor(CONFIGURACION_USAR_CKEDITOR) == 1):?>
			<?include('views/widgets/ayuda-ckeditor.tpl.php')?>
			<?require_once(APP_ADDONS_PATH.'/ckeditor.js.php');?>
			<script type="text/javascript">
				$j().ready(function () {
					$j("#notas").ckeditor({toolbar: "Basic"});
				});
			</script>
		<?endif;?>
		</div>
	</div>
	<div class="clear"></div>
    
    <div class="bloque-campo">
		<div class="titulo">Imágenes</div>
		<div class="campo">
		<iframe src="?p=upload&contenedor=noticias&origen=imagenes&destino=imagenes&sector=<?=SECTOR_NOTICIAS?>&id_elemento=<?=@$datos['id_noticias']?>&limite=1" width="378" height="210"></iframe>
			<?include('views/widgets/ayuda-uploadarchivo.tpl.php')?><!--
			<iframe src="?p=upload&contenedor=noticias&origen=imagenes&destino=imagenes&sector=<?=SECTOR_NOTICIAS?>&id_elemento=<?=@$datos['id_noticias']?>&extras[id_imagen]=<?=@$datos['id_imagen']?>" width="260" height="105"></iframe>-->
		</div>
	</div>
	<div class="clear"></div>

	<div class="botones">
		<button type="submit" class="boton-grafico verde" title="Guardar">Guardar</button>
		<button type="button" class="boton-grafico rojo" title="Cancelar" onclick="window.location.href='<?if(@$datos['id_noticias']):?><?=escape(@$_SERVER['HTTP_REFERER'])?><?else:?>noticias<?endif;?>'">Cancelar</button>
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
