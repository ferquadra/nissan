<h3>Listado de Partidos</h3>

<table class="admin-list">
<thead>
	<tr>
		<td colspan="2"></td>
		<td width="*">Lugar</td>
		<td width="*">MD5</td>
		<td width="*">Fecha</td>
		<td width="*">Cantidad</td>
		<td width="*">Confirmados</td>
		
		
		<td width="20"></td>
	</tr>
</thead>
<tbody>
	<?$n=0;?>
	<?foreach ($listado as $pos => $item):?>
	<?$n++;?>
	<tr class="<?=$pos % 2 == 1 ? 'impar' : ''?>">
		<td width="20"><?=$n?></td>
		<td width="20"><?=escape($item['id_partido'])?><!--<a href="?p=usuarios|editar&id_usuario=<?=$item['id_user']?>" title="Modificar"><img src="images/write_16.png" /></a>--></td>
		<td><?=escape($item['lugar'])?></td>
		<td><a href="http://www.porgoleada.com/convocatoria/<?=escape($item['md5'])?>" target="_blank">Ver convocatoria</a></td>
		<td><?=escape($item['fecha'])?></td>
		<td><?=escape($item['cantidad'])?></td>
		<td><?=escape($item['total'])?></td>
		
		
		<td><!--<a href="" class="delete" clave_primaria="<?=$item['id_user']?>"><img src="images/delete_16.png" /></a>--></td>
	</tr>
	<?endforeach;?>
</tbody>
</table>

<script>
$j().ready(function () {
	$j(".admin-list").preparar_listado({data: {url: "?p=usuarios"}});
	$j("#buscador").find("input,textarea,select").filter(":visible:first").focus().select();
	
	$j(this).find(".active").click(function (e) {
		var $this = $j(this);
		params = {id: $this.attr("clave_primaria")};
		
		$j.post("?p=usuarios|x_activar", params, function (resultado) {
			if (resultado.activo == true) {
				$this.find("img").attr("src", "images/ok_16.png");
			}
			else {
				$this.find("img").attr("src", "images/dis/ok_16.png");
			}
		}, "json");
		
		return false;
	});
	
	$j(this).find(".block").click(function (e) {
		var $this = $j(this);
		params = {id: $this.attr("clave_primaria")};
		
		$j.post("?p=usuarios|x_bloquear", params, function (resultado) {
			if (resultado.bloqueado == true) {
				$this.find("img").attr("src", "images/clients_cancel_16.png");
			}
			else {
				$this.find("img").attr("src", "images/dis/clients_cancel_16.png");
			}
		}, "json");
		
		return false;
	});
});
</script>