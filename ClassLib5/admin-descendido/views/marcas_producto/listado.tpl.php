<h3>Listado de marcas de productos</h3>

<div class="inforesultados"><b><?=$paginador['registros']?></b> resultados</div>
<table class="admin-list">
<thead>
	<tr>
		<td colspan="2"></td>
		<td width="*">Nombre</td>
		<td width="20"></td>
	</tr>
</thead>
<tbody>
	<?foreach ($listado as $pos => $item):?>
	<tr class="<?=$pos % 2 == 1 ? 'impar' : ''?>">
		<td width="20"><a href="" class="publish" clave_primaria="<?=$item['id_marcaproducto']?>"><img src="images/<?=$item['publicado'] ? '' : 'dis/'?>ok_16.png" /></a></td>
		<td width="20"><a href="?p=marcas_producto|editar&id_marcaproducto=<?=$item['id_marcaproducto']?>"><img src="images/write_16.png" /></a></td>
		<td><?=escape($item['nombre'])?></td>
		<td><a href="" class="delete" clave_primaria="<?=$item['id_marcaproducto']?>"><img src="images/delete_16.png" /></a></td>
	</tr>
	<?endforeach;?>
</tbody>
</table>

<script>
$j().ready(function () {
	$j(".admin-list").preparar_listado({data: {url: "?p=marcas_producto"}});
});
</script>