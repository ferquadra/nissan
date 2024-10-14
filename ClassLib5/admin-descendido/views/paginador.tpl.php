<?if ($paginador['paginas'] > 1):?>
<?require_once(APP_FUNCTIONS_PATH.'/url_functions.php')?>
<?$cDireccion = $GLOBALS['CONTROLLER']?>
<?if ($GLOBALS['METHOD'] != APP_DEFAULT_METHOD):?>
	<?$cDireccion .= "|{$GLOBALS['METHOD']}"?>
<?endif;?>
<?$cParams = get_query_string('p', 'pg')?>
<script>

$j(function() {
	$j(".slider").slider({
		value: <?=$paginador['pagina']?>,
		min: 1,
		max: <?=$paginador['paginas']?>,
		step: 1,
		slide: function(event, ui) {
			$j(".irapagina").html('Ir a página ' + ui.value);
		},
		stop: function(event, ui) {
			window.location.href = '?p=<?=$cDireccion?>&pg='+ui.value+'&<?=html_entity_decode($cParams)?>';
		}
	});
	
});

</script>
<div class="paginadormini">
	<div class="izq">
		<!-- ANTERIORES -->
		<?if($paginador['anterior'] > 0):?>
			<a class="skh" href="?p=<?=$cDireccion?>&amp;pg=1&amp;<?=$cParams?>">
				<img src="images/rew_16.png" align="absmiddle" />&nbsp;Primera
			</a>
			&nbsp;&nbsp;
			<a class="skh" href="?p=<?=$cDireccion?>&amp;pg=<?=$paginador['anterior']?>&amp;<?=$cParams?>">
				<img src="images/play_rew_16.png" align="absmiddle" />&nbsp;Anterior
			</a>
		<?else:?>
			<a class="skh">
				<img src="images/rew_16.png" align="absmiddle" />&nbsp;Primera
			</a>
			&nbsp;&nbsp;
			<a class="skh">
				<img src="images/play_rew_16.png" align="absmiddle" />&nbsp;Anterior
			</a>
		<?endif;?>

		<!-- SIGUIENTES -->
		<?if($paginador['siguiente'] <= $paginador['paginas']):?>
			<a href="?p=<?=$cDireccion?>&amp;pg=<?=$paginador['siguiente']?>&amp;<?=$cParams?>" class="skh">
				<img src="images/play_16.png" align="absmiddle" />&nbsp;Siguiente
			</a>
			<a href="?p=<?=$cDireccion?>&amp;pg=<?=$paginador['paginas']?>&amp;<?=$cParams?>" class="skh">
				<img src="images/forward_16.png" align="absmiddle" />&nbsp;Última
			</a>
		<?else:?>
			<a class="skh">
				<img src="images/play_16.png" align="absmiddle" />&nbsp;Siguiente
			</a>
			<a class="skh">
				<img src="images/forward_16.png" align="absmiddle" />&nbsp;Última
			</a>
		<?endif;?>
	</div>
	
	<div class="cen">
		<!-- RANGO -->
		<div class="slider skh"></div>
		<div class="irapagina">Página <b><?=$paginador['pagina']?> de <?=$paginador['paginas']?></b></div>
	</div>

</div>
<?endif;?>