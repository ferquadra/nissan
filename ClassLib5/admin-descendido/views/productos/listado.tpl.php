<h3>Listado de productos</h3>

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
	
	<?include_once('views/productos/combo-categorias.php')?>
	<div class="filtro">
		<div class="titulo">Categoría</div>
		<div class="campos">
			<div class="entrada">
				<select name="id_categoria" id="id_categoria" class="inputs medium">
					<option value="">&nbsp;</option>
					<?
					$oCategorias = new Categorias_producto();
					$oCategorias->OrderBy = 'nombre';
					$oCategorias->LimitCant = null;
					combo_categorias($oCategorias, $_GET);
					?>
				</select>
			</div>
		</div>
	</div>
	
	<div class="filtro">
		<div class="titulo">Marca</div>
		<div class="campos">
			<div class="entrada">
				<select name="id_marca" id="id_marca" class="inputs medium">
					<option value="">&nbsp;</option>
					<?
					$oMarcas = new Marcas_producto();
					$oMarcas->OrderBy = 'nombre';
					$oMarcas->LimitCant = null;
					?>
					<?foreach ($oMarcas->Buscar() as $item):?>
					<option value="<?=$item['id_marcaproducto']?>" <?=@$_GET['id_marca'] == $item['id_marcaproducto'] ? 'selected="selected"' : ''?>><?=escape($item['nombre'])?></option>
					<?endforeach;?>
				</select>
			</div>
		</div>
	</div>
	
	<div class="filtro">
		<div class="titulo">Filtros por estado</div>
		<div class="campos">
			<div class="entrada">
				<img src="images/ok_16.png" align="absmiddle" /> Publicado&nbsp;
				<select name="publicado" id="publicado" class="inputs small">
					<option value="">&nbsp;</option>
					<option value="1" <?=isset($_GET['publicado']) && $_GET['publicado'] == '1' ? 'selected="selected"' : ''?>>Sí</option>
					<option value="0" <?=isset($_GET['publicado']) && $_GET['publicado'] == '0' ? 'selected="selected"' : ''?>>No</option>
				</select>
				&nbsp;&nbsp;
				<img src="images/offer_a_16.png" align="absmiddle" /> Destacado&nbsp;
				<select name="destacado" id="destacado" class="inputs small">
					<option value="">&nbsp;</option>
					<option value="1" <?=isset($_GET['destacado']) && $_GET['destacado'] == '1' ? 'selected="selected"' : ''?>>Sí</option>
					<option value="0" <?=isset($_GET['destacado']) && $_GET['destacado'] == '0' ? 'selected="selected"' : ''?>>No</option>
				</select>
				&nbsp;&nbsp;
				<img src="images/offer_b_16.png" align="absmiddle" /> Oferta&nbsp;
				<select name="oferta" id="oferta" class="inputs small">
					<option value="">&nbsp;</option>
					<option value="1" <?=isset($_GET['oferta']) && $_GET['oferta'] == '1' ? 'selected="selected"' : ''?>>Sí</option>
					<option value="0" <?=isset($_GET['oferta']) && $_GET['oferta'] == '0' ? 'selected="selected"' : ''?>>No</option>
				</select>
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
		<td colspan="4"></td>
		<td width="*">Nombre</td>
		<td width="*">Marca</td>
		<td width="*">Categoría</td>
		<td width="20"></td>
	</tr>
</thead>
<tbody>
	<?foreach ($listado as $pos => $item):?>
	<tr class="<?=$pos % 2 == 1 ? 'impar' : ''?>">
		<td width="20"><a href="" class="publish" clave_primaria="<?=$item['id_producto']?>" title="Publicado"><img src="images/<?=$item['publicado'] ? '' : 'dis/'?>ok_16.png" /></a></td>
		<td width="20"><a href="" class="emphasize" clave_primaria="<?=$item['id_producto']?>" title="Destacado"><img src="images/<?=$item['destacado'] ? '' : 'dis/'?>offer_a_16.png" /></a></td>
		<td width="20"><a href="" class="offer" clave_primaria="<?=$item['id_producto']?>" title="Oferta"><img src="images/<?=$item['oferta'] ? '' : 'dis/'?>offer_b_16.png" /></a></td>
		<td width="20"><a href="?p=productos|editar&id_producto=<?=$item['id_producto']?>" title="Modificar"><img src="images/write_16.png" /></a></td>
		<td><?=escape($item['nombre'])?></td>
		<td><?=escape($item['marca'])?></td>
		<td><?=escape($item['categoria'])?></td>
		<td><a href="" class="delete" clave_primaria="<?=$item['id_producto']?>"><img src="images/delete_16.png" /></a></td>
	</tr>
	<?endforeach;?>
</tbody>
</table>

<script>
$j().ready(function () {
	$j(".admin-list").preparar_listado({data: {url: "?p=productos"}});
	$j("#buscador").find("input,textarea,select").filter(":visible:first").focus().select();
	
	$j(this).find(".offer").click(function (e) {
		var $this = $j(this);
		params = {id: $this.attr("clave_primaria")};
		
		$j.post("?p=productos|x_ofertar", params, function (resultado) {
			if (resultado.oferta == true) {
				$this.find("img").attr("src", "images/offer_b_16.png");
			}
			else {
				$this.find("img").attr("src", "images/dis/offer_b_16.png");
			}
		}, "json");
		
		return false;
	});
});
</script>
