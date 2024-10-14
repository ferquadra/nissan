<?foreach ($listado as $item):?>
<div class="bloque-campo">
	<div class="titulo"><?=$item['titulo']?></div>
	<div class="campo">
	<input type="hidden" name="tipo[<?=$item['id_configuracion']?>]" value="<?=escape($item['tipo'])?>" />
	<?switch ($item['tipo']) {
		case Configuracion::TIPO_TEXTO_MONOLINEA:
			?>
			<input type="text" name="configuracion[<?=$item['id_configuracion']?>]" id="configuracion_<?=$item['id_configuracion']?>" value="<?=escape($item['valor'])?>" class="inputs big" />
			<?
			break;
			
		case Configuracion::TIPO_TEXTO_MULTILINEA:
			?>
			<textarea name="configuracion[<?=$item['id_configuracion']?>]" id="configuracion_<?=$item['id_configuracion']?>" class="inputs big" rows="10" /><?=escape($item['valor'])?></textarea>
			<?
			break;
			
		case Configuracion::TIPO_TEXTO_ENRIQUECIDO:
			require_once(APP_ADDONS_PATH.'/ckeditor.php');
			$oCK = new CKEditor();
			echo $oCK->editor("configuracion[{$item['id_configuracion']}]", $item['valor'], array('toolbar'=>'Basic'));
			?>
			<?include('views/widgets/ayuda-ckeditor.tpl.php')?>
			<?
			break;
			
		case Configuracion::TIPO_RADIO:
			foreach (explode(';', $item['extra']) as $pos => $radio) {
				$datos = explode('=', $radio);
				?>
				<input type="radio" name="configuracion[<?=$item['id_configuracion']?>]" id="configuracion_<?="{$item['id_configuracion']}_{$pos}"?>" value="<?=$datos[0]?>" <?=$item['valor'] == $datos[0] ? 'checked="checked"' : ''?> />
				<label for="configuracion_<?="{$item['id_configuracion']}_{$pos}"?>"><?=$datos[1]?></label>
				<?
			}
			break;
			
		case Configuracion::TIPO_IMAGEN:
			?>
			<iframe src="?p=upload&contenedor=configuracion&origen=imagenes&destino=imagenes&sector=<?=SECTOR_DATOS?>&id_elemento=<?=$item['id_configuracion']?>&extras[id_imagen]=<?=@$item['valor']?>" width="378" height="210"></iframe>
			<?include('views/widgets/ayuda-uploadimagen.tpl.php')?>
			<?
			break;
			
		case Configuracion::TIPO_GOOGLEMAP:
			preg_match('/width=([0-9]+)/', $item['extra'], $aSpt);
			$cWidth = $aSpt[1];
			preg_match('/height=([0-9]+)/', $item['extra'], $aSpt);
			$cHeight = $aSpt[1];
			?>
			<input type="hidden" name="configuracion[<?=$item['id_configuracion']?>]" id="configuracion_<?="{$item['id_configuracion']}_{$pos}"?>" value="<?=$item['valor']?>" />
			<div id="mapa_configuracion_<?="{$item['id_configuracion']}_{$pos}"?>" class="mapa" style="width: <?=$cWidth?>px; height: <?=$cHeight?>px;"></div>
			<?
			$aCoordenadas = explode('&', $item['valor']);
			?>
			<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?=GOOGLEMAPS_API_KEY?>&sensor=false" type="text/javascript"></script>
			<script type="text/javascript"> 
				$j().ready(function (e) {
					var map = new GMap2(document.getElementById("mapa_configuracion_<?="{$item['id_configuracion']}_{$pos}"?>"));
					var center = new GLatLng<?=$aCoordenadas[1] ? $aCoordenadas[1] : '(-32.95019913442736, -60.66375732421875)'?>;
					
					map.setCenter(center, <?=$aCoordenadas[2] ? $aCoordenadas[2] : 12?>);
					map.setMapType(G_NORMAL_MAP);
					map.setUIToDefault();
					
					var marker = new GMarker(new GLatLng<?=$aCoordenadas[0] ? $aCoordenadas[0] : '(-32.950741, -60.6665)'?>, {draggable: true});
					var cCoordenadas = null;
					
					map.addOverlay(marker);
					
					$j("form").submit(function (e) {
						$j("#configuracion_<?="{$item['id_configuracion']}_{$pos}"?>").val(marker.getLatLng() + "&" + map.getCenter() + "&" + map.getZoom());
					});
					
					var nOk = 0;
					$j("#mapa_configuracion_<?="{$item['id_configuracion']}_{$pos}"?>").mouseenter(function () {
						if (nOk == 0) {
							map.checkResize();
							map.setCenter(center, <?=$aCoordenadas[2] ? $aCoordenadas[2] : 12?>);
							map.disableScrollWheelZoom();
							nOk = 1;
						}
					});
					
				});
			</script>
			<?
			break;
	}?>
	<?if($item['ayuda']):?><div class="texto-ayuda" style="width: 350px;"><?=$item['ayuda']?></div><?endif;?>
	</div>
</div>
<div class="clear"></div>
<?endforeach;?>