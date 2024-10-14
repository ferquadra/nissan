<h3>Listado de usuarios</h3>

<div id="buscador"><div class="interno">
	<form method="GET" autocomplete="off">
	<input type="hidden" name="p" value="<?=@$_GET['p']?>" />
	<input type="hidden" name="pg" value="1" />
	<input type="hidden" name="alfabetica" value="<?=escape(@$_GET['alfabetica'])?>" />
	
	<button type="submit" class="boton-grafico verde" title="Buscar">Buscar</button>
	</form>
</div></div>

<div class="inforesultados"><b><?=$paginador['registros']?></b> resultados.</div>
<?include('views/paginador.tpl.php')?>

<table class="admin-list">
<thead>
	<tr>
		<td colspan="2"></td>
		<td width="*">Nombre</td>
		<td width="*">Email</td>
		<td width="*">Lugar</td>
		<td width="*">Estado</td>
		
		
		<td width="20"></td>
	</tr>
</thead>
<tbody>
	<?foreach ($listado as $pos => $item):?>
	<tr class="<?=$pos % 2 == 1 ? 'impar' : ''?>">
		<td width="20"><!--<a href="" class="active" clave_primaria="<?=$item['id_user']?>" title="Activo"><img src="images/<?=$item['activo'] ? '' : 'dis/'?>ok_16.png" /></a>--></td>
		<td width="20"><?=escape($item['id_partido'])?><!--<a href="?p=usuarios|editar&id_usuario=<?=$item['id_user']?>" title="Modificar"><img src="images/write_16.png" /></a>--></td>
		<td><?=escape($item['nombre_amigo'])?></td>
		<td><?=escape($item['email_amigo'])?></td>
		<td><?=escape($item['lugar'])?></td>
		<td><?=escape($item['estado'])?></td>
		
		
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