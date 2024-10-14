<style>
.data p{
	line-height: 20px;
	text-decoration: none;
	font-size: 12pt;
}
.valoraciones{
	background-color: yellow;
	padding: 10px;
}
</style>
<h3><?=$user['nombre']?></h3>
<div class="data">
<?if(is_array($anexo)):?>
<div class="valoraciones">
	<h1>ANEXO</h1>
	<?foreach($anexo as $key => $item):?>
		<p><?=$key?>: <?=$item?><br /></p>
	<?endforeach;?>
</div>
<?else:?>
	<h1>No completó ningún dato adicional.</h1>
<?endif;?>
<?foreach($user as $key => $item):?>
<?if(($key != "fb_access_token")):?>
	<p><?=$key?>: <?=$item?><br /></p>
<?endif;?>
<?endforeach;?>

</div>