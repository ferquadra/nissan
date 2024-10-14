<h3>Listado de mensajes</h3>

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
				<img src="images/ok_16.png" align="absmiddle" /> Activo&nbsp;
				<select name="activo" id="activo" class="inputs small">
					<option value="">&nbsp;</option>
					<option value="1" <?=isset($_GET['activo']) && $_GET['activo'] == '1' ? 'selected="selected"' : ''?>>Sí</option>
					<option value="0" <?=isset($_GET['activo']) && $_GET['activo'] == '0' ? 'selected="selected"' : ''?>>No</option>
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
		<td width="160">Nombre</td>
		<td>Mensaje</td>
		<td width="60">Fecha</td>
		<td width="20"></td>
	</tr>
</thead>
<tbody>
	<?foreach ($listado as $pos => $item):?>
	<?$item = escape($item)?>
		<tr class="<?=$pos % 2 == 1 ? 'impar' : ''?>" style="<?=$item['visto'] ? 'font-size: 8pt;' : 'font-weight: bold;'?>">
			<td width="20"><a href="?p=mensajes|editar&id_mensaje=<?=$item['id_mensaje']?>" title="Modificar"><img src="images/write_16.png" /></a></td>
			<td width="20"><?if(!$item['visto']):?><img src="images/mail_fav_16.png" /><?endif;?></td>
			<td><?=$item['nombre']?></td>
			<td><?=word_limiter($item['comentario'], 10)?></td>
			<td>
				<?if ($item['fecha'] > date('Y-m-d 00:00:00')):?>
					<?=mysql2date($item['fecha'], '%H:%i')?>
				<?else:?>
					<?=ucwords(strftime('%d %b', strtotime($item['fecha'])))?>
				<?endif;?>
			</td>
			<td><a href="" class="delete" clave_primaria="<?=$item['id_mensaje']?>" title="Borrar"><img src="images/delete_16.png" /></a></td>
		</tr>
	<?endforeach;?>
</tbody>
</table>

<script type="text/javascript">
$j().ready(function() {
	$j(".admin-list").preparar_listado({data: {url: "?p=mensajes"}});
	$j("#buscador").find("input,textarea,select").filter(":visible:first").focus().select();
	
	$j(this).find(".active").click(function (e) {
		var $this = $j(this);
		params = {id: $this.attr("clave_primaria")};
		
		$j.post("?p=mensajes|x_activar", params, function (resultado) {
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