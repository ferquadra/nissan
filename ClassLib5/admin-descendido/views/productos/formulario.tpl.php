<?if (@$datos['id_producto']):?>
<h3>Modificando producto</h3>
<?else:?>
<h3>Nuevo producto</h3>
<?endif;?>

<form action="?p=productos|guardar" method="post" id="formulario" autocomplete="off">
	<input type="hidden" name="id_producto" id="clave_primaria" value="<?=@$datos['id_producto']?>" />
	<div class="bloque-campo">
		<div class="titulo">Código</div>
		<div class="campo"><input type="text" name="codigo" id="codigo" class="inputs small" value="<?=escape(@$datos['codigo'])?>" /></div>
	</div>
	
	<?if (@$datos['id_producto']):?>
	<div style="float: right; margin-top: -24px;">
		<?$cAppUrl = str_replace('/admin', '', APP_APPLICATION_URL)?>
		<?$cUrl = urlencode($cAppUrl.'/productos/'.url_title($datos['nombre'])."&id={$datos['id_producto']}")?>
		
		<a href="http://www.facebook.com/sharer.php?u=<?=$cUrl?>" onclick="window.open(this.href,'compartir_en_facebook', 'toolbar=0, status=0, width=500, height=350'); return false;"><img src="images/compartir_facebook.gif" align="absmiddle" /></a>
		<a href="https://twitter.com/share?original_referer=<?=$cUrl?>&amp;source=tweetbutton&amp;text=<?=urlencode(stripslashes($datos['descripcion']))?>&amp;url=<?=$cUrl?>" onclick="window.open(this.href,'twittear', 'toolbar=0, status=0, width=500, height=350'); return false;"><img src="images/twittear.png" align="absmiddle" /></a>
		<!--
		<script type="text/javascript" src="https://apis.google.com/js/plusone.js">{lang: 'es'}</script>
		<g:plusone size="small" href="<?=urldecode($cUrl)?>"></g:plusone>
		-->
	</div>
	<?endif;?>
	
	<div class="clear"></div>
	
	<div class="bloque-campo">
		<div class="titulo">Nombre</div>
		<div class="campo"><input type="text" name="nombre" id="nombre" class="inputs medium requerido" title="Debe ingresar el nombre." value="<?=escape(@$datos['nombre'])?>" /></div>
	</div>
	
	<div class="bloque-campo">
		<div class="titulo">Descripción corta</div>
		<div class="campo"><input type="text" name="descripcion" id="descripcion" class="inputs big" title="" value="<?=escape(@$datos['descripcion'])?>" /></div>
	</div>
	
	<div class="clear"></div>
	
	<?include_once('views/productos/combo-categorias.php')?>
	<div class="bloque-campo">
		<div class="titulo">Categoría</div>
		<div class="campo">
			<select name="id_categoria" id="id_categoria" class="inputs big">
				<option value="">&nbsp;</option>
				<?
				$oCategorias = new Categorias_producto();
				$oCategorias->OrderBy = 'nombre';
				$oCategorias->LimitCant = null;
				combo_categorias($oCategorias, $datos);
				?>
			</select>
		</div>
	</div>
	
	
	<div class="bloque-campo">
		<div class="titulo">Marca</div>
		<div class="campo">
			<select name="id_marca" id="id_marca" class="inputs big">
				<option value="">&nbsp;</option>
				<?
				$oMarcas = new Marcas_producto();
				$oMarcas->OrderBy = 'nombre';
				$oMarcas->LimitCant = null;
				?>
				<?foreach ($oMarcas->Buscar() as $item):?>
				<option value="<?=$item['id_marcaproducto']?>" <?=@$datos['id_marca'] == $item['id_marcaproducto'] ? 'selected="selected"' : ''?>><?=escape($item['nombre'])?></option>
				<?endforeach;?>
			</select>
		</div>
	</div>
	
	<div class="clear"></div>
	
	<div class="bloque-campo">
		<div class="titulo">Precio</div>
		<div class="campo"><input type="text" name="precio" id="precio" class="inputs small format-decimal" value="<?=@$datos['precio']?>" /></div>
	</div>
	
	<?$nListasExtra=Configuracion::ObtenerValor('listas_extra')?>
	<?for ($i=1; $i<6; ++$i):?>
		<?if ($nListasExtra >= $i):?>
		<div class="bloque-campo">
			<div class="titulo">Lista <?=$i?></div>
			<div class="campo"><input type="text" name="precio<?=$i?>" id="precio<?=$i?>" class="inputs small format-decimal" value="<?=@$datos['precio'.$i]?>" /></div>
		</div>
		<?else:?>
		<input type="hidden" name="precio<?=$i?>" id="precio<?=$i?>" value="<?=@$datos['precio'.$i]?>" />
		<?endif;?>
	<?endfor;?>
	
	<div class="clear"></div>
	
	<div class="bloque-campo">
		<div class="titulo">Texto</div>
		<div class="campo" id="campo-texto">
		<textarea name="texto" id="texto" class="inputs big" rows="10"><?=escape(@$datos['texto'])?></textarea>
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
			<iframe src="?p=upload&contenedor=productos&origen=imagenes&destino=imagenes&sector=<?=SECTOR_PRODUCTOS?>&id_elemento=<?=@$datos['id_producto']?>&extras[id_imagen]=<?=@$datos['id_imagen']?>" width="378" height="210"></iframe>
			<?include('views/widgets/ayuda-uploadimagen.tpl.php')?>
		</div>
	</div>
	
	<div class="clear"></div>
	
	<div class="bloque-campo">
		<div class="titulo">Opciones de publicación:</div>
		<div class="campo">
			<input type="checkbox" name="publicado" id="publicado" value="1" <?=!isset($datos) || @$datos['publicado'] ? 'checked="checked"' : ''?> /> <label for="publicado"><img src="images/ok_16.png" align="absmiddle" /> Publicado</label><br />
			<input type="checkbox" name="destacado" id="destacado" value="1" <?=@$datos['destacado'] ? 'checked="checked"' : ''?> /> <label for="destacado"><img src="images/offer_a_16.png" align="absmiddle" /> Destacado</label><br />
			<input type="checkbox" name="oferta" id="oferta" value="1" <?=@$datos['oferta'] ? 'checked="checked"' : ''?> /> <label for="oferta"><img src="images/offer_b_16.png" align="absmiddle" /> Oferta</label>
		</div>
	</div>
	
	<div class="clear"></div>
	
	<hr />
	
	<div class="bloque-campo">
		<div class="titulo"><b><u>Campos dinámicos extra según categoría seleccionada.</u></b></div>
		
		<div id="contenedor-campos">
		<?=@$body_campos?>
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
	
	$j("#id_categoria").change(function () {
		$j("#contenedor-campos").load("?p=categorias_producto|x_lista_campos", {id: $j(this).val()});
	});
});
</script>