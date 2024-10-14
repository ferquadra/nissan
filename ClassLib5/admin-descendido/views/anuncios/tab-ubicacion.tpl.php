<?
$aSecciones = array(
	'home'=>'Home',
	'productos'=>'Productos',
	'paginas'=>'Páginas institucionales',
	'contacto'=>'Contacto'
);
$aUbicaciones = array(
	''=>'&nbsp;',
	'top'=>'Superior',
	'middle'=>'Medio',
	'bottom'=>'Inferior',
	'lat_top'=>'Lateral superior',
	'lat_middle'=>'Lateral medio',
	'lat_bottom'=>'Lateral inferior'
);

foreach ((array) @$ubicaciones_grabadas as $item) {
	$aUbicacionesGrabadas[$item['sector']] = $item['ubicacion'];
}
?>
<!-- INICIO DE CAMPO -->
<?foreach ($aSecciones as $nombre_seccion => $titulo_seccion):?>
	<div class="bloque-campo">
		<div class="titulo"><?=$titulo_seccion?></div>
		<div class="campo">
			<select name="ubicacion[<?=$nombre_seccion?>]" class="inputs" style="width: 150px;">
			<?foreach ($aUbicaciones as $key => $item):?>
				<option value="<?=$key?>" <?=@$aUbicacionesGrabadas[$nombre_seccion] == $key ? 'selected="selected"' : ''?>><?=$item?>
			<?endforeach;?>
			</select>
		</div>
	</div>
<?endforeach;?>
<div class="clear"></div>
<div class="texto-ayuda" style="width: 408px;">
	<b><u style="color: red;">ATENCION:</u></b> Si olvida su contraseña tendrá que solicitarla al administrador o el servicio técnico autorizado.
	Una vez que se haya cambiado la contraseña se le solicitará que vuelva a iniciar sesión en el sistema.
</div>