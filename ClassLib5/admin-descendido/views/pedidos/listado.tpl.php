<h3>Listado de pedidos</h3>

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
		<div class="titulo">Filtros por estado de pedido</div>
		<div class="campos">
			<div class="entrada">
				<select name="id_estado" id="id_estado" class="inputs medium">
					<option value="">&nbsp;</option>
					<?foreach ($estados as $item):?>
						<option value="<?=$item['id_estadopedido']?>" <?=isset($_GET['id_estado']) && $_GET['id_estado'] == $item['id_estadopedido'] ? 'selected="selected"' : ''?>><?=escape($item['nombre'])?></option>
					<?endforeach;?>
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
		<td colspan="1"></td>
		<td>Fecha</td>
		<td>Usuario / Cliente</td>
		<td>Estado</td>
		<td width="60px">Productos</td>
		<td width="70px">Importe total</td>
		<td width="20"></td>
	</tr>
</thead>
<tbody>
	<?foreach ($listado as $pos => $item):?>
	<?$item = escape($item)?>
		<tr class="<?=$pos % 2 == 1 ? 'impar' : ''?>">
			<td width="20"><a href="?p=pedidos|editar&id_pedido=<?=$item['id_pedido']?>" title="Modificar"><img src="images/write_16.png" /></a></td>
			<td><?=mysql2date($item['fecha'], '%d/%m/%Y %H:%i')?></td>
			<td><?=$item['usuario']?></td>
			<td><?=$item['estado']?></td>
			<td align="right"><?=$item['cantidad_total']?></td>
			<td align="right">$ <?=$item['importe_total']?></td>
			<td><a href="" class="delete" clave_primaria="<?=$item['id_pedido']?>" title="Borrar"><img src="images/delete_16.png" /></a></td>
		</tr>
	<?endforeach;?>
</tbody>
</table>

<script type="text/javascript">
$j().ready(function() {
	$j(".admin-list").preparar_listado({data: {url: "?p=pedidos"}});
	$j("#buscador").find("input,textarea,select").filter(":visible:first").focus().select();
	
	$j(this).find(".active").click(function (e) {
		var $this = $j(this);
		params = {id: $this.attr("clave_primaria")};
		
		$j.post("?p=pedidos|x_activar", params, function (resultado) {
			if (resultado.oferta == true) {
				$this.find("img").attr("src", "images/ok_16.png");
			}
			else {
				$this.find("img").attr("src", "images/dis/ok_16.png");
			}
		}, "json");
		
		return false;
	});
});
</script>