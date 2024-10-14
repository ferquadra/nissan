<?foreach ((array)@$campos as $item):?>
<div class="campo base">
	<input type="hidden" name="campos_id[]" value="<?=$item['id_campocategoria']?>" />
	<div class="bloque-campo">
		<div class="titulo"><?=escape($item['nombre'])?></div>
		<div class="campo">
		<?switch ($item['tipo']) {
			case Configuracion::TIPO_TEXTO_MONOLINEA:
				?>
				<input type="text" name="campos[<?=$item['id_campocategoria']?>]" value="<?=escape(@$item['valor'])?>" class="inputs big" />
				<?
				break;
				
			case Configuracion::TIPO_TEXTO_MULTILINEA:
				?>
				<textarea name="campos[<?=$item['id_campocategoria']?>]" class="inputs big" rows="10" /><?=escape(@$item['valor'])?></textarea>
				<?
				break;
				
			case Configuracion::TIPO_TEXTO_ENRIQUECIDO:
				?><textarea name="campos[<?=$item['id_campocategoria']?>]" id="campos_<?=$item['id_campocategoria']?>" class="inputs big" rows="10" /><?=escape(@$item['valor'])?></textarea><?
				include('views/widgets/ayuda-ckeditor.tpl.php');
				require_once(APP_ADDONS_PATH.'/ckeditor.js.php');
				?>
				<script type="text/javascript">
					$j().ready(function () {
						$j("#campos_<?=$item['id_campocategoria']?>").ckeditor({toolbar: "Basic"});
					});
				</script>
				<?
				break;
				
			case Configuracion::TIPO_RADIO:
				foreach (explode(';', $item['extra']) as $pos => $radio) {
					$datos = explode('=', $radio);
					?>
					<input type="radio" name="campos[<?=$item['id_campocategoria']?>]" id="campos_<?=$item['id_campocategoria']?>_<?=$pos?>" value="<?=$datos[0]?>" <?=@$item['valor'] == $datos[0] ? 'checked="checked"' : ''?> />
					<label for="campos_<?="{$item['id_campocategoria']}_{$pos}"?>"><?=@$datos[1]?></label>
					<?
				}
				break;
				
			case Configuracion::TIPO_IMAGEN:
				?>
				<iframe src="?p=upload&contenedor=productos&origen=imagenes&destino=imagenes&sector=<?=SECTOR_CAMPOS_PRODUCTO?>&id_elemento=<?=@$id_producto?>&extras[id_campocategoria]=<?=$item['id_campocategoria']?>&extras[id_imagen]=<?=@$item['valor']?>" width="378" height="210"></iframe>
				<?include('views/widgets/ayuda-uploadimagen.tpl.php')?>
				<?
				break;
				
			case Configuracion::TIPO_ARCHIVO:
				?>
				<iframe src="?p=upload&contenedor=productos&origen=archivos&destino=archivos&sector=<?=SECTOR_CAMPOS_PRODUCTO?>&id_elemento=<?=@$id_producto?>&extras[campo]=1" width="378" height="210"></iframe>
				<?include('views/widgets/ayuda-uploadarchivo.tpl.php')?>
				<?
				break;
				
			case Configuracion::TIPO_GOOGLEMAP:
				?>
				<div class="texto-ayuda">
					El plugin de GOOGLE MAPS se encuentra en desarrollo.
				</div>
				<?
				break;
				
		}?>
		</div>
	</div>
	<div class="clear"></div>
</div>
<?endforeach;?>