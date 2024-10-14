<?if (@$datos['id_pagina']):?>
	<h3>Modificando página <span><?=@$datos['nombre']?></span></h3>
<?else:?>
	<h3>Nueva página institucional</h3>
<?endif;?>

<script src="http://maps.google.com/maps/api/js?sensor=false" 
	  type="text/javascript"></script>
	  
<div id="map" style="width: 1000px; height: 800px;"></div>
<br /><br />
<?$aCuenta = array();?>
<?foreach($geo as $item):?>
	<?if(@$item['lat']):?>
		<?if(isset($aCuenta[$item['geo_3']]['cant'])):?>
			<?$aCuenta[$item['geo_3']]['cant'] = $aCuenta[$item['geo_3']]['cant'] + 1;?>		
		<?else:?>
			<?$aCuenta[$item['geo_3']]['cant'] = 1;?>
		<?endif;?>
	<?endif;?>
<?endforeach;?>
<?arsort($aCuenta);?>
<?foreach($aCuenta as $key => $val):?>
	<p style="font-size: 18px; line-height: 20px;">
	Hay <span style="font-weight: bold"><?=$aCuenta[$key]['cant'];?></span> usuarios en <span style="font-weight: bold"><?=$key;?></span>
	</p>
<?endforeach;?>
<script type="text/javascript">
<?
$n=1;
$cFinal = "";
?>

<?$ultlat = 0;?>
<?$ultlng = 0;?>
<?foreach($geo as $item):?>
	<?if(@$item['lat']):?>
		<?$cStr = "['".$item['usuario']['nombre']."', ".$item['lat'].", ".$item['lng'].", ".$n++."]";?>
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
