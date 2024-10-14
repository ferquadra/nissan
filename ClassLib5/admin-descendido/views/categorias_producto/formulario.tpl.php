<?if (@$datos['id_categoriaproducto']):?>
<h3>Modificando categoría de producto</h3>
<?else:?>
<h3>Nueva categoría de producto</h3>
<?endif;?>

<form action="?p=categorias_producto|guardar" method="post" id="formulario" autocomplete="off">
	<input type="hidden" name="id_categoriaproducto" id="clave_primaria" value="<?=escape(@$datos['id_categoriaproducto'])?>" />
	<div class="bloque-campo">
		<div class="titulo">Nombre</div>
		<div class="campo"><input type="text" name="nombre" id="nombre" class="inputs medium requerido" title="Debe ingresar el nombre." value="<?=escape(@$datos['nombre'])?>" /></div>
	</div>
	
	<div class="bloque-campo">
		<div class="titulo">Código</div>
		<div class="campo"><input type="text" name="codigo" id="codigo" class="inputs small" title="" value="<?=escape(@$datos['codigo'])?>" /></div>
	</div>
	
	<div class="clear"></div>
	<?if (@$datos['id_categoriaproducto'] == null):?>
	<?
	function combo_categorias(&$oCategorias, $nIdPadre=0, $nEspacios=-1) {
		$oCategorias->IdPadre = $nIdPadre;
		$aCategs = $oCategorias->Buscar();
		
		if ($aCategs) {
			++$nEspacios;
			
			foreach ($aCategs as $item) {
				?><option value="<?=$item['id_categoriaproducto']?>"><?=str_repeat("&nbsp;&nbsp;&nbsp;", $nEspacios)?> <?=escape($item['nombre'])?></option><?
				combo_categorias($oCategorias, $item['id_categoriaproducto'], $nEspacios);
			}
		}
	}
	?>
	<div class="bloque-campo">
		<div class="titulo">Categoría superior</div>
		<div class="campo">
			<select name="id_padre" id="id_padre" class="inputs big">
				<option value="0">&nbsp;</option>
				<?
				$oCategorias = new Categorias_producto();
				$oCategorias->OrderBy = 'nombre';
				$oCategorias->LimitCant = null;
				combo_categorias($oCategorias);
				?>
			</select>
		</div>
	</div>
	
	<div class="clear"></div>
	<?endif;?>
	
	<div class="bloque-campo">
		<div class="titulo">Descripción corta</div>
		<div class="campo"><input type="text" name="descripcion" id="descripcion" class="inputs big" title="" value="<?=escape(@$datos['descripcion'])?>" /></div>
	</div>
	
	<div class="clear"></div>
	
	<div class="bloque-campo">
		<div class="titulo">Imágenes</div>
		<div class="campo">
			<iframe src="?p=upload&contenedor=categorias_producto&origen=imagenes&destino=imagenes&sector=<?=SECTOR_CATEGORIAS?>&id_elemento=<?=@$datos['id_categoriaproducto']?>&extras[id_imagen]=<?=@$datos['id_imagen']?>" width="378" height="210"></iframe>
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
	
	<hr />
	
	<div class="bloque-campo">
		<div class="titulo"><b><u>Campos dinámicos extra</u></b></div>
		
		<div class="texto-ayuda">
			<b><u style="color: red;">ATENCION:</u></b> Los campos extra por categoría no pueden modificarse o eliminarse una vez guardados aunque sí puede añadir campos adicionales.
		</div>
		
		<div class="campo base" style="display: none;">
			<input type="hidden" name="campos_id[]" value="" />
			<div class="bloque-campo">
				<div class="titulo">Nombre</div>
				<div class="campo"><input type="text" name="campos_nombre[]" class="inputs medium requerido" title="Debe ingresar el nombre." value="" /></div>
			</div>
			<div class="bloque-campo">
				<div class="titulo">Tipo</div>
				<div class="campo">
					<select name="campos_tipo[]" class="inputs small">
						<?foreach (Configuracion::$CAMPOS as $nKey => $cNombre):?>
						<option value="<?=$nKey?>"><?=$cNombre?></option>
						<?endforeach;?>
					</select>				
				</div>
			</div>
			<div class="bloque-campo">
				<div class="titulo">Extra</div>
				<div class="campo"><input type="text" name="campos_extra[]" class="inputs medium" title="" value="" /></div>
			</div>
			<div class="bloque-campo">
				<div class="titulo">Borrar</div>
				<div class="campo"><a href="" class="borrar"><img src="images/delete_16.png" style="margin: 5px 0px 0px 8px;" /></a></div>
			</div>
			<div class="clear"></div>
		</div>
		
		<div id="contenedor-campos">
		<?foreach ((array)@$campos as $item):?>
		<div class="campo base">
			<input type="hidden" name="campos_id[]" value="<?=$item['id_campocategoria']?>" />
			<div class="bloque-campo">
				<div class="titulo">Nombre</div>
				<div class="campo"><input type="text" name="campos_nombre[]" class="inputs medium requerido" title="Debe ingresar el nombre." value="<?=escape($item['nombre'])?>" /></div>
			</div>
			<div class="bloque-campo">
				<div class="titulo">Tipo</div>
				<div class="campo">
					<input type="hidden" name="campos_tipo[]" value="<?=$item['tipo']?>" />
					<select class="inputs small" disabled="disabled">
						<?foreach (Configuracion::$CAMPOS as $nKey => $cNombre):?>
						<option value="<?=$nKey?>" <?=$item['tipo'] == $nKey ? 'selected="selected"' : ''?>><?=$cNombre?></option>
						<?endforeach;?>
					</select>				
				</div>
			</div>
			<div class="bloque-campo">
				<div class="titulo">Extra</div>
				<div class="campo"><input type="text" name="campos_extra[]" class="inputs medium" title="" value="<?=escape($item['extra'])?>" /></div>
			</div>
			<div class="clear"></div>
		</div>
		<?endforeach;?>
		</div>
		
		<div class="clear"></div>
		<button type="button" class="boton-grafico verde" id="aniadir" title="Añadir" style="margin-top: 10px; margin-bottom: 20px;">Añadir</button>
	</div>
	
	<div class="clear"></div>
	
	<div class="botones">
		<button type="submit" class="boton-grafico verde" title="Guardar">Guardar</button>
		<button type="button" class="boton-grafico rojo" title="Cancelar" onclick="window.location.href='?p=menu'">Cancelar</button>
	</div>
</form>
<script type="text/javascript">
	$j().ready(function() {
		$j("#formulario").preparar({
			deleteAction: false
		});
		
		$j("#aniadir").click(function () {
			$renglon = $j(".base:first").clone();
			$renglon.appendTo("#contenedor-campos");
			
			$renglon.removeClass("base").slideDown().find("input:visible:first").focus();
		});
		
		$j(".borrar").live("click", function () {
			$j(this).parent().parent().parent().slideUp("fast", function () {$j(this).remove()});
			return false;
		});
	});
</script>