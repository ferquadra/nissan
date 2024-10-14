<h3>Listado de noticias</h3>

<div id="buscador"><div class="interno">
	<form method="GET" autocomplete="off">
	<input type="hidden" name="p" value="<?=@$_GET['p']?>" />
	<input type="hidden" name="pg" value="1" />
	<input type="hidden" name="alfabetica" value="<?=escape(@$_GET['alfabetica'])?>" />
	
	<div class="filtro">
		<div class="titulo">Búsqueda general</div>
		<div class="campos">
			<div class="entrada">
				<input type="text" name="general" id="general" size="50" class="inputs" value="<?=escape(@$_GET['general'])?>" />
			</div>
		</div>
	</div>
	
	<div class="filtro">
		<div class="titulo">Filtros por estado de registro</div>
		<div class="campos">
			<div class="entrada">
				<img src="images/ok_16.png" align="absmiddle" /> Publicado&nbsp;
				<select name="publicado" id="publicado" class="inputs small">
					<option value="">&nbsp;</option>
					<option value="1" <?=isset($_GET['publicado']) && $_GET['publicado'] == '1' ? 'selected="selected"' : ''?>>Sí</option>
					<option value="0" <?=isset($_GET['publicado']) && $_GET['publicado'] == '0' ? 'selected="selected"' : ''?>>No</option>
				</select>
				&nbsp;&nbsp;
			</div>
		</div>
	</div>
	
	<button type="submit" class="boton-grafico verde" title="Buscar">Buscar</button>
	</form>
</div></div>

<div class="inforesultados"><b><?=$paginador['registros']?></b> resultados.</div>
<?include('views/paginador.tpl.php')?>

<table class="admin-list">
<thead>
	<tr>
		<td colspan="2"></td>
		<td width="150">Título</td>
		<td width="150">Fecha Alta</td>
		<td width="20"></td>
	</tr>
</thead>
<tbody>
	<?foreach ($listado as $pos => $item):?>
	<?$item = escape($item)?>
		<tr class="<?=$pos % 2 == 1 ? 'impar' : ''?>">
			<td width="20"><a href="" class="publish" clave_primaria="<?=$item['id_noticias']?>" title="Publicado"><img src="images/<?=$item['publicado'] ? '' : 'dis/'?>ok_16.png" /></a></td>
			<td width="20"><a href="?p=noticias|editar&id_noticias=<?=$item['id_noticias']?>" title="Modificar"><img src="images/write_16.png" /></a></td>
			<td><?=$item['nombre']?></td>
			<td><?=$item['fecha_alta']?></td>
			<td><a href="" class="delete" clave_primaria="<?=$item['id_noticias']?>" title="Borrar"><img src="images/delete_16.png" /></a></td>
		</tr>
	<?endforeach;?>
</tbody>
</table>

<script type="text/javascript">
$j().ready(function() {
	$j(".admin-list").preparar_listado({data: {url: "?p=noticias"}});
	$j("#buscador").find("input,textarea,select").filter(":visible:first").focus().select();
});
</script>
