<h3>Módulos dinámicos (configuración avanzada)</h3>

<div class="texto-ayuda" style="width: 400px;">
	<b><u style="color: red;">ATENCION:</u></b> La eliminación de un listado dinámico provoca que se vacíen completamente las relaciones en la base de datos.
</div>
<div class="clear"></div><br />

<table class="admin-list">
<thead>
	<tr>
		<td colspan="2"></td>
		<td>Controlador</td>
		<td>Título</td>
		<td width="20"></td>
	</tr>
</thead>
<tbody>
	<?foreach ($listado as $pos => $item):?>
	<?$item = escape($item)?>
		<tr class="<?=$pos % 2 == 1 ? 'impar' : ''?>">
			<td width="20"><a href="?p=listados|editar&id_listado=<?=$item['id_listado']?>" title="Modificar"><img src="images/write_16.png" /></a></td>
			<td width="20"><a href="?p=campos_listado&id_listado=<?=$item['id_listado']?>" title="Ver campos"><img src="images/files_16.png" /></a></td>
			<td><?=$item['controlador']?></td>
			<td><?=$item['titulo']?></td>
			<td><a href="" class="delete" clave_primaria="<?=$item['id_listado']?>" title="Borrar"><img src="images/delete_16.png" /></a></td>
		</tr>
	<?endforeach;?>
</tbody>
</table>

<script type="text/javascript">
$j().ready(function() {
	$j(".admin-list").preparar_listado({data: {url: "?p=listados"}});
	$j("#buscador").find("input,textarea,select").filter(":visible:first").focus().select();
	
	$j(this).find(".active").click(function (e) {
		var $this = $j(this);
		params = {id: $this.attr("clave_primaria")};
		
		$j.post("?p=listados|x_activar", params, function (resultado) {
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