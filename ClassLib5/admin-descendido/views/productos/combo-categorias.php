<?
function combo_categorias(&$oCategorias, &$datos, $nIdPadre=0, $nEspacios=-1) {
	$oCategorias->IdPadre = $nIdPadre;
	$aCategs = $oCategorias->Buscar();
	
	if ($aCategs) {
		++$nEspacios;
		
		foreach ($aCategs as $item) {
			?><option value="<?=$item['id_categoriaproducto']?>" <?=@$datos['id_categoria'] == $item['id_categoriaproducto'] ? 'selected="selected"' : ''?>><?=str_repeat("&nbsp;&nbsp;&nbsp;", $nEspacios)?> <?=escape($item['nombre'])?></option><?
			combo_categorias($oCategorias, $datos, $item['id_categoriaproducto'], $nEspacios);
		}
	}
}
?>