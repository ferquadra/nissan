<style>
.efe{background:#06C; color:#fff; border-radius:50%; width:15px; height:15px; margin-left:5px;padding: 5px 10px;}
</style>
<h3>Listado de usuarios</h3>

<div id="buscador"><div class="interno">
	<form method="GET" autocomplete="off">
	<input type="hidden" name="p" value="<?=@$_GET['p']?>" />
	<input type="hidden" name="pg" value="1" />
	<input type="hidden" name="alfabetica" value="<?=escape(@$_GET['alfabetica'])?>" />

	<div class="filtro">
		<div class="titulo">Búsqueda por nombre</div>
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
				<img src="images/ok_16.png" align="absmiddle" /> ¿Tiene App?&nbsp;
				<select name="activo" id="activo" class="inputs small">
					<option value="">&nbsp;</option>
					<option value="1" <?=isset($_GET['activo']) && $_GET['activo'] == '1' ? 'selected="selected"' : ''?>>Sí</option>
					<option value="0" <?=isset($_GET['activo']) && $_GET['activo'] == '0' ? 'selected="selected"' : ''?>>No</option>
				</select>
			</div>
		</div>
	</div>

	<button type="submit" class="boton-grafico verde" title="Buscar">Buscar</button>
	</form>
</div></div>

<div class="inforesultados"><b><span style="font-size: 20pt; line-height: 40pt;"><?=($paginador['registros'])?></span></b> resultados.</div>
<?include('views/paginador.tpl.php')?>
<hr>
<?
$aEscudos = array();
?>
<?$n = 0;?>
<?foreach ($total as $item):?>

	<?
	if($item['anexo']['equipo']){
		$n++;
		if(!isset($aEscudos[$item['anexo']['equipo']])){
			$aEscudos[$item['anexo']['equipo']] = 1;
		} else {
			$aEscudos[$item['anexo']['equipo']] = $aEscudos[$item['anexo']['equipo']] + 1;
		}
	}
	?>
<?endforeach;?>

<a onclick="javascript:$j('#estadisticas').toggle();" style="font-size: 12pt; color: green; text-decoration: none; cursor: pointer;">Ver estadísticas de clubes .·.</a>
<div id="estadisticas" style="text-align: right; width: 400px; display: none;">
<?
foreach($aEscudos as $key => $item){

	echo "<span style='font-size: 10pt; line-height: 20px'>".$key." .: ".$item." __ <b>".round(($item*100)/$n)."%</b></span><br >";
}
echo "<br /><br />Total equipos completados: <span style='font-size: 14pt;'>".$n." ___ 100%</span>";
?>
</div>
<hr>
<table class="admin-list">
<thead>
	<tr>
		<td width="*">ID</td>
		<td colspan="4"></td>
		<td width="*">Nombre</td>
		<td width="*">Email</td>
		<td width="*">APP</td>
		<td width="*">Localidad</td>
		<td width="*">Fecha de registro</td>
		<td width="20"></td>
	</tr>
</thead>
<tbody>
	<?foreach ($listado as $pos => $item):?>
	<tr class="<?=$pos % 2 == 1 ? 'impar' : ''?>">
		<td><span style="color: gray"><?=$item['id_user']?></span></td>
		<td width="20"><a href="?p=usuarios|data&id_user=<?=$item['id_user']?>" class="heart <?if(is_array($item['anexo'])):?>anexo<?endif;?>" title="La data..."><i class="fa fa-heart fa-fw"></i></a></td>
		<td width="20"><a href="" class="active sexo" clave_primaria="<?=$item['id_user']?>" title="Activo"><img src="images/<?if($item['sexo'] == 'M'):?>offer_a_16.png<?else:?>offer_b_16.png<?endif;?>" /></a>
			<?if($item['id_partido']):?><a href="?p=usuarios|listadopartidos&id_user=<?=$item['id_user']?>" title="Partidos..."><img src="images/soccer.png" width="24px" height="24px" /></a><?endif;?>
		</td>
		<td width="20"><?if($item['id_amigo']):?><a href="?p=usuarios|listadoamigos&id_user=<?=$item['id_user']?>" title="Amigos..."><img src="images/amigos.png" width="24px" height="24px" /></a><?endif;?></td>
		<td width="20"><?if($item['cantidadamigos']>0):?><span style="font-size: 14pt;"><?=$item['cantidadamigos']?></span><?endif;?></td>
		<td>
			<a href="http://www.porgoleada.com/<?=$item['fb_user_id'];?>" target="_blank"><?=escape($item['nombre'])?></a>
			<?if(substr($item['fb_user_id'],0,2)!="pg"):?><a href="https://www.facebook.com/<?=$item['fb_user_id'];?>" target="_blank"><span class="efe">f</span></a><?endif;?></td>
		<td><?=escape($item['email'])?></td>
		<td><?if(@$item['pushtoken']):?><img title="App instalada!" src="images/es_app.png" width="30px" /><?endif;?></td>
		<td><?=@$item['geo']['geo_3'];?></td>
		<td><?=$item['fecha_alta']?></td>
		<td style="height: 50px;"><?if($item['anexo']['equipo']):?><img src="http://www.porgoleada.com/<?=$item['anexo']['equipo']?>" style="width: 40px;" title="<?=$item['anexo']['equipo']?>" /><?endif;?></td>
	</tr>
	<?endforeach;?>
</tbody>
</table>
<?/**<?include('views/paginador.tpl.php')?>**/?>
<script>
$j(".sexo").on('click', function (e) {
	var $this = $j(this);
	params = {id: $this.attr("clave_primaria")};

	$j.post("?p=usuarios|x_sexo", params, function (resultado) {
		if (resultado.sexo == "M") {
			$this.find("img").attr("src", "images/offer_a_16.png");
		}
		else {
			$this.find("img").attr("src", "images/offer_b_16.png");
		}
	}, "json");

	return false;
});
</script>
