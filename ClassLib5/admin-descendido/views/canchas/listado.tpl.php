<script src="http://maps.google.com/maps/api/js?sensor=false" 
	  type="text/javascript"></script>
	  
<div id="map" style="width: 1000px; height: 800px;"></div>
<br /><br />

<script type="text/javascript">
<?
$n=1;
$cFinal = "";
?>

<?$ultlat = 0;?>
<?$ultlng = 0;?>
<?foreach($todas as $item):?>
	<?if(@$item['lat']):?>
		<?$cStr = "['".$item['nombre']."<br />".$item['direccion']."<br>".$item['telefono']."', ".$item['lat'].", ".$item['lng'].", ".$n++."]";?>
		<?$cFinal .= $cStr.",\n";?>
		<?$ultlat = $item['lat']?>
		<?$ultlng = $item['lng']?>
	<?endif;?>
<?endforeach;?>
<?$cFinal = substr($cFinal, 0, -2);?>

 var locations = [
	<?=$cFinal?>
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 9,
      center: new google.maps.LatLng(<?=$ultlat?>, <?=$ultlng?>),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
		path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
		scale: 10,
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
</script>

<h3>Listado de Canchas</h3>

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
	
	<button type="submit" class="boton-grafico verde" title="Buscar">Buscar</button>
	</form>
</div></div>

<div class="inforesultados"><b><?=$paginador['registros']?></b> resultados.</div>
<?include('views/paginador.tpl.php')?>

<table class="admin-list">
<thead>
	<tr>
		<td width="20"></td>
		<td width="150">Nombre</td>
		<td width="150">Direccion</td>
		<td width="150">Datos</td>
		<td width="20"></td>
	</tr>
</thead>
<tbody>
	<?foreach ($listado as $pos => $item):?>
	<?$item = escape($item)?>
		<tr class="<?=$pos % 2 == 1 ? 'impar' : ''?>">
			<td width="20"><a href="?p=canchas|editar&id=<?=$item['id_cancha']?>" title="Modificar"><img src="images/write_16.png" /></a></td>
			<td><?=$item['nombre']?></td>
			<td><?=$item['direccion']?></td>
			<td><?=$item['telefono']?> ** <?=$item['celular']?></td>
			<td><a href="" class="delete" clave_primaria="<?=$item['id_cancha']?>" title="Borrar"><img src="images/delete_16.png" /></a></td>
		</tr>
	<?endforeach;?>
</tbody>
</table>

<script type="text/javascript">
$j().ready(function() {
	$j(".admin-list").preparar_listado({data: {url: "?p=canchas"}});
	$j("#buscador").find("input,textarea,select").filter(":visible:first").focus().select();
});
</script>
