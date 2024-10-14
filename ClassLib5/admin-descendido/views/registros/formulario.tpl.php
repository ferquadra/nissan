<?if (@$datos['id_registro']):?>
<h3>Modificando <?=$listado_dinamico['titulo']?></h3>
<?else:?>
<h3>Alta de <?=$listado_dinamico['titulo']?></h3>
<?endif;?>

<form action="?p=registros|guardar&id_listado=<?=$_GET['id_listado']?>" method="post" id="formulario" autocomplete="off">
	<input type="hidden" name="id_registro" id="clave_primaria" value="<?=@$datos['id_registro']?>" />
	<input type="hidden" name="x_volver" id="x_volver" value="" />
	
	<?$oRL = new Registros_listado();?>
	<?$aControladores = array()?>
	<?foreach ($campos_listado as $item):?>
		<?
		$cRequerido = $item['requerido'] ? 'requerido' : '';
		
		if (@$datos['id_registro']) {
			$oRL->IdRegistro = $datos['id_registro'];
			$oRL->IdCampolistado = $item['id_campolistado'];
			$aRegistro = $oRL->Obtener();
			
			// Los datos pueden estar o no, dependiendo de si el campo es nuevo.
			$nIdRegistroListado = @$aRegistro['id_registrolistado'];
			$vValor = @$aRegistro['valor'];
			
			$oRL->Limpiar();
		}
		else {
			$nIdRegistroListado = $vValor = null;
		}
		?>
		<div class="bloque-campo">
			<div class="titulo"><?=escape($item['titulo'])?></div>
			<div class="campo">
				<input type="hidden" name="id_registrolistado[<?=$item['id_campolistado']?>]" value="<?=$nIdRegistroListado?>" />
				<?
				switch ($item['tipo']) {
					case Campos_listado::TIPO_TEXTO_CORTO:
						?><input type="text" name="registros[<?=$item['id_campolistado']?>]" class="inputs big <?=$cRequerido?>" value="<?=escape(@$vValor)?>" /><?
						break;
						
					case Campos_listado::TIPO_TEXTO_MULTILINEA:
						?><textarea name="registros[<?=$item['id_campolistado']?>]" class="inputs big <?=$cRequerido?>" rows="10" /><?=escape(@$vValor)?></textarea><?
						break;
						
					case Campos_listado::TIPO_TEXTO_ENRIQUECIDO:
						?><textarea name="registros[<?=$item['id_campolistado']?>]" id="registros_<?=$item['id_campolistado']?>" class="inputs big <?=$cRequerido?>" rows="10" /><?=escape(@$vValor)?></textarea><?
						include('views/widgets/ayuda-ckeditor.tpl.php');
						require_once(APP_ADDONS_PATH.'/ckeditor.js.php');
						?>
						<script type="text/javascript">
							$j().ready(function () {
								$j("#registros_<?=$item['id_campolistado']?>").ckeditor({toolbar: "Basic"});
							});
						</script>
						<?
						break;
						
					case Campos_listado::TIPO_NUMERO_ENTERO:
						?><input type="text" name="registros[<?=$item['id_campolistado']?>]" class="inputs format-entero <?=$cRequerido?>" value="<?=escape($vValor)?>" size="10" /><?
						break;
						
					case Campos_listado::TIPO_NUMERO_DECIMAL:
						?><input type="text" name="registros[<?=$item['id_campolistado']?>]" class="inputs format-decimal <?=$cRequerido?>" value="<?=escape($vValor)?>" size="10" /><?
						break;
						
					case Campos_listado::TIPO_RADIO:
						if (preg_match('/checked=([^\;]+)/', $item['extra'], $aTmp)) {
							$vChecked = $aTmp[1];
							$item['extra'] = str_replace("checked={$vChecked};", '', $item['extra']);
						}
						
						foreach (explode(';', $item['extra']) as $pos => $radio) {
							if (!$radio) continue;
							
							preg_match('/([^\=]+)\=(.+)/', $radio, $aTmp);
							if ($aTmp) {
								
							}
							?>
							<input type="radio" name="registros[<?=$item['id_campolistado']?>]" id="registros_<?=$item['id_campolistado']?>_<?=$pos?>" value="<?=$aTmp[1]?>" <?=$vValor == $aTmp[1] ? 'checked="checked"' : ''?> class="<?=$cRequerido?>" <?=isset($vChecked) && $vChecked == $aTmp[1] ? 'checked="checked"' : ''?> />
							<label for="registros_<?="{$item['id_campolistado']}_{$pos}"?>"><?=@$aTmp[2]?></label>
							<?
						}
						
						unset($vChecked);
						break;
						
					case Campos_listado::TIPO_SELECT:
						preg_match("/([^\&]+)\&?([^\=]+\=([0-9]+))?/", $item['extra'], $aSpt);
						
						if (isset($aControladores[$item['tipo']])) {
							$oCont = $aControladores[$item['tipo']];
						}
						else {
							if ($aSpt[1] == 'registros') {
								$oCont = new RegistrosCtl();
							}
							else {
								$AUTORUN = false;
								require_once("controllers/{$aSpt[1]}.ctl.php");
							}
							
							$aControladores[$item['tipo']] = $oCont;
						}
						
						$cValorCampo = $oCont->x_obtener_nombre($vValor, $aSpt[3]);
						?>
						<input type="hidden" name="registros[<?=$item['id_campolistado']?>]" value="<?=$vValor?>" />
						<input type="text" id="registros_<?=$item['id_campolistado']?>" value="<?=escape($cValorCampo)?>" class="inputs medium <?=$cRequerido?>" />
						<script type="text/javascript">
						$j().ready(function () {
							$j("#registros_<?=$item['id_campolistado']?>").autocomplete("?p=<?=$aSpt[1]?>|x_autocompletar&<?=@$aSpt[2]?>", {matchContains: true, mustMatch: true, minChars:0, delay: 200});
							$j("#registros_<?=$item['id_campolistado']?>").result(function(event, data, formatted) {
								if (data) $j(this).prev().val(data[1]);
								else $j(this).prev().val('');
							});
							$j("#registros_<?=$item['id_campolistado']?>").change(function(event) {
								if ($j(this).val() == '') {
									$j(this).prev().val('');
								}
							});
						});
						</script>
						<?
						break;
						
					case Campos_listado::TIPO_IMAGEN:
						preg_match("/limite\=([0-9]+);/", $item['extra'], $aSpt);
						$cLimite = @$aSpt[1] ? "&limite={$aSpt[1]}" : '';
						
						if (@$datos['id_registro']) {
							?><iframe src="?p=upload&contenedor=registros&origen=imagenes&destino=imagenes&sector=<?=SECTOR_CAMPOS_REGISTRO?>&id_elemento=<?=$nIdRegistroListado?>&extras[id_imagen]=<?=$vValor?><?=$cLimite?>" width="378" height="210"></iframe><?
							include('views/widgets/ayuda-uploadimagen.tpl.php');
						}
						else {
							include('views/widgets/ayuda-guardarantes.tpl.php');
						}
						break;
						
					case Campos_listado::TIPO_ARCHIVO:
						preg_match("/limite\=([0-9]+);/", $item['extra'], $aSpt);
						$cLimite = @$aSpt[1] ? "&limite={$aSpt[1]}" : '';
						
						if (@$datos['id_registro']) {
							?><iframe src="?p=upload&contenedor=registros&origen=archivos&destino=archivos&sector=<?=SECTOR_CAMPOS_REGISTRO?>&id_elemento=<?=$nIdRegistroListado?><?=$cLimite?>" width="378" height="210"></iframe><?
							include('views/widgets/ayuda-uploadarchivo.tpl.php');
						}
						else {
							include('views/widgets/ayuda-guardarantes.tpl.php');
						}
						break;
						
					case Campos_listado::TIPO_GOOGLE_MAP:
						?>
						<input type="hidden" name="registros[<?=$item['id_campolistado']?>]" id="registros_<?=$item['id_campolistado']?>" value="<?=$vValor?>" />
						<div id="mapa_<?=$item['id_campolistado']?>" class="mapa" style="width: 400px; height: 300px;"></div>
						<?
						$aCoordenadas = explode('&', $vValor);
						?>
						<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?=GOOGLEMAPS_API_KEY?>&sensor=false" type="text/javascript"></script>
						<script type="text/javascript"> 
							$j().ready(function (e) {
								var map = new GMap2(document.getElementById("mapa_<?=$item['id_campolistado']?>"));
								var center = new GLatLng<?=@$aCoordenadas[1] ? $aCoordenadas[1] : '(-32.95019913442736, -60.66375732421875)'?>;
								
								map.setCenter(center, <?=@$aCoordenadas[2] ? $aCoordenadas[2] : 12?>);
								map.setMapType(G_NORMAL_MAP);
								map.setUIToDefault();
								
								var marker = new GMarker(new GLatLng<?=@$aCoordenadas[0] ? $aCoordenadas[0] : '(-32.950741, -60.6665)'?>, {draggable: true});
								var cCoordenadas = null;
								
								map.addOverlay(marker);
								
								$j("form").submit(function (e) {
									$j("#registros_<?=$item['id_campolistado']?>").val(marker.getLatLng() + "&" + map.getCenter() + "&" + map.getZoom());
								});
							});
						</script>
						<?
						break;
						
					case Campos_listado::TIPO_FECHA_CORTA:
						?><input type="text" name="registros[<?=$item['id_campolistado']?>]" class="inputs small masked-fecha <?=$cRequerido?>" value="<?=mysql2date($vValor)?>" /><?
						break;
						
					case Campos_listado::TIPO_FECHA_HORA:
						?><input type="text" name="registros[<?=$item['id_campolistado']?>]" class="inputs small masked-fechahora <?=$cRequerido?>" value="<?=mysql2date($vValor, '%d/%m/%Y %H:%i')?>" /><?
						break;
						
					default:
						?>NO IMPLEMENTADO AUN<?
						break;
				}
				?>
				<?if ($item['ayuda']):?>
				<div class="texto-ayuda">
					<b><u style="color: red;">ATENCION:</u></b> <?=$item['ayuda']?>
				</div>
				<?endif;?>
			</div>
		</div>
		<div class="clear"></div>
	<?endforeach;?>
	
	<div class="bloque-campo">
		<div class="titulo">Opciones de publicación:</div>
		<div class="campo">
			<input type="checkbox" name="publicado" id="publicado" value="1" <?=!@$datos['id_registro'] || @$datos['publicado'] ? 'checked="checked"' : ''?> /> <label for="publicado"><img src="images/ok_16.png" align="absmiddle" /> Publicado</label>
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