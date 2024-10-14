<h3>Listado de <?=$listado_dinamico['titulo']?></h3>

<div class="inforesultados"><b><?=$paginador['registros']?></b> resultados.</div>
<?include('views/paginador.tpl.php')?>

<table class="admin-list">
<thead>
	<tr>
		<td colspan="2"></td>
		<?for ($i=0; $i<4 && isset($campos_listado[$i]); ++$i):?>
		<td><?=$campos_listado[$i]['titulo']?></td>
		<?endfor;?>
		<td width="20"></td>
	</tr>
</thead>
<tbody>
	<?$oRL = new Registros_listado();?>
	<?$aControladores = array()?>
	<?foreach ($listado as $pos => $item):?>
	<?$item = escape($item)?>
		<tr class="<?=$pos % 2 == 1 ? 'impar' : ''?>">
			<td width="20"><a href="?p=registros|editar&id_registro=<?=$item['id_registro']?>&id_listado=<?=@$_GET['id_listado']?>" title="Modificar"><img src="images/write_16.png" /></a></td>
			<td width="20"><a href="" class="publish" clave_primaria="<?=$item['id_registro']?>" title="Publicado"><img src="images/<?=$item['publicado'] ? '' : 'dis/'?>ok_16.png" /></a></td>
			<?for ($i=0; $i<4 && isset($campos_listado[$i]); ++$i):?>
			<?
			$oRL->IdRegistro = $item['id_registro'];
			$oRL->IdCampolistado = $campos_listado[$i]['id_campolistado'];
			$aRegistro = $oRL->Obtener();
			$oRL->Limpiar();
			switch ($campos_listado[$i]['tipo']) {
				case Campos_listado::TIPO_TEXTO_MULTILINEA:
					if (strlen(@$aRegistro['valor']) > 50) {
						?><td><?=escape(substr(@$aRegistro['valor'], 0, 50)).'...'?></td><?
					}
					else {
						?><td><?=escape(@$aRegistro['valor'])?></td><?
					}
					break;
				
				case Campos_listado::TIPO_TEXTO_ENRIQUECIDO:
					if (strlen(@$aRegistro['valor']) > 50) {
						?><td><?=escape(substr(strip_tags(@$aRegistro['valor']), 0, 50)).'...'?></td><?
					}
					else {
						?><td><?=escape(strip_tags(@$aRegistro['valor']))?></td><?
					}
					break;
					
				case Campos_listado::TIPO_NUMERO_ENTERO:
				case Campos_listado::TIPO_NUMERO_DECIMAL:
					?><td align="right" width="70px"><?=escape(@$aRegistro['valor'])?>&nbsp;&nbsp;</td><?
					break;
					
				case Campos_listado::TIPO_RADIO:
					parse_str(str_replace(';', '&', $campos_listado[$i]['extra']), $aTmp);
					?><td><?=@$aTmp[@$aRegistro['valor']]?></td><?
					break;
					
				case Campos_listado::TIPO_SELECT:
					preg_match("/([^\&]+)\&?(.+)?/", $campos_listado[$i]['extra'], $aSpt);
					
					// Busca el listado por si hace referencia a otro módulo dinámico.
					if (preg_match('/id_listado=([0-9]+)/', $aSpt[2], $aIdLis)) {
						$nIdListado = $aIdLis[1];
						unset($aIdLis);
					}
					else {
						$nIdListado = null;
					}
					
					if (isset($aControladores[$campos_listado[$i]['tipo']])) {
						$oCont = $aControladores[$campos_listado[$i]['tipo']];
					}
					else {
						if ($aSpt[1] == 'registros') {
							$oCont = new RegistrosCtl();
						}
						else {
							$AUTORUN = false;
							require_once("controllers/{$aSpt[1]}.ctl.php");
						}
						
						$aControladores[$campos_listado[$i]['tipo']] = $oCont;
					}
					
					$cValorCampo = $oCont->x_obtener_nombre(@$aRegistro['valor'], $nIdListado);
					?><td><?=escape($cValorCampo)?></td><?
					break;
					
				case Campos_listado::TIPO_IMAGEN:
				case Campos_listado::TIPO_ARCHIVO:
				case Campos_listado::TIPO_GOOGLE_MAP:
					?><td>Vista previa no disponible</td><?
					break;
					
				case Campos_listado::TIPO_FECHA_CORTA:
					?><td><?=mysql2date(@$aRegistro['valor'])?></td><?
					break;
					
				case Campos_listado::TIPO_FECHA_HORA:
					?><td><?=mysql2date(@$aRegistro['valor'], '%d/%m/%Y %H:%i')?></td><?
					break;
					
				default:
					?><td><?=escape(@$aRegistro['valor'])?></td><?
			}?>
			<?endfor;?>
			<td><a href="" class="delete" clave_primaria="<?=$item['id_registro']?>" title="Borrar"><img src="images/delete_16.png" /></a></td>
		</tr>
	<?endforeach;?>
</tbody>
</table>

<script type="text/javascript">
$j().ready(function() {
	$j(".admin-list").preparar_listado({data: {url: "?p=registros"}});
	$j("#buscador").find("input,textarea,select").filter(":visible:first").focus().select();
});
</script>