<h3>Campos de módulo "<?=$listado_dinamico['titulo']?>" (configuración avanzada)</h3>

<div class="texto-ayuda" style="width: 400px;">
	<b><u style="color: red;">ATENCION:</u></b> La eliminación de un campo de listado dinámico provoca que se vacíen completamente las relaciones en la base de datos.
</div>
<div class="clear"></div><br />

<table class="admin-list">
<thead>
	<tr>
		<td width="20"></td>
		<td width="16">ID</td>
		<td>Título</td>
		<td>Tipo</td>
		<td>Extra</td>
		<td width="12"></td>
		<td width="20"></td>
	</tr>
</thead>
<tbody>
	<?foreach ($listado as $pos => $item):?>
	<?$item = escape($item)?>
		<tr class="<?=$pos % 2 == 1 ? 'impar' : ''?>">
			<td align="center"><a href="?p=campos_listado|editar&id_listado=<?=$listado_dinamico['id_listado']?>&id_campolistado=<?=$item['id_campolistado']?>" title="Modificar"><img src="images/write_16.png" /></a></td>
			<td align="right"><?=$item['id_campolistado']?></td>
			<td><?=$item['titulo']?></td>
			<td><?=$tipos[$item['tipo']]['titulo']?></td>
			<td><?=$item['extra']?></td>
			<td align="right"><?=$item['orden']?></td>
			<td><a href="" class="delete" clave_primaria="<?=$item['id_campolistado']?>" title="Borrar"><img src="images/delete_16.png" /></a></td>
		</tr>
	<?endforeach;?>
</tbody>
</table>

<script type="text/javascript">
$j().ready(function() {
	$j(".admin-list").preparar_listado({data: {url: "?p=campos_listado"}});
	$j("#buscador").find("input,textarea,select").filter(":visible:first").focus().select();
	
	$j(this).find(".active").click(function (e) {
		var $this = $j(this);
		params = {id: $this.attr("clave_primaria")};
		
		$j.post("?p=campos_listado|x_activar", params, function (resultado) {
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