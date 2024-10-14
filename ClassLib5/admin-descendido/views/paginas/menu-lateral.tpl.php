<div class="titulo">Otras páginas</div>
<?
$oPaginas = new Paginas();
$oPaginas->OrderBy = 'nombre';
$oPaginas->LimitCant = null;
?>
<?foreach ($oPaginas->Buscar() as $item):?>
<a href="?p=paginas|editar&id_pagina=<?=$item['id_pagina']?>"><img src="images/write_16.png" align="absmiddle" /><?=$item['identificador']?></a>
<?endforeach;?>
