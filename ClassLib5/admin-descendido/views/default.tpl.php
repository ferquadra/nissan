<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="es-ar" />
	<link rel="stylesheet" type="text/css" href="css/estilo-admin.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.2.custom.css" />
	<?/**<link href="../vendor/fontawesome4/css/font-awesome.min.css" rel="stylesheet">**/?>
	<!--[if IE]><link rel="stylesheet" type="text/css" href="css/estilo-admin-ie.css" /><![endif]-->
	<title>V8 ADMIN</title>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<script>var $j = jQuery.noConflict();</script>
	
	<?/**<?require_once(APP_ADDONS_PATH.'/jqgreybox.php')?>
	<?require_once(APP_ADDONS_PATH.'/msgbox.php')?>**/?>
	<?require_once('includes/utils.js.php')?>
	<?require_once('includes/jquery-ui-1.8.2.custom.min.js.php')?>
	<?require_once('includes/jquery.maskedinput.min.js.php')?>
	<?require_once('includes/jquery.numberformatter.min.js.php')?>
	<?require_once('includes/jquery.autocomplete.min.js.php')?>
	<?require_once('includes/jquery.autocomplete.css.php')?>
</head>
<body>
<div align="center">
<table cellpadding="0" cellspacing="0" class="tabla-principal">
	<tr>
		<td class="barra-superior" colspan="2">
			<div><div style="color: #aaa; margin-top: 20px; float: left; font-size: 20pt;">V8</div>
				<div id="logo" style="float: right;"><a href="?p=home"><img src="http://www.porgoleada.com/img/porgoleada/logo.png"></a></div>
				<div class="clear"></div>
			</div>
			<div id="menu-superior">
				<button type="button" onclick="window.location.href='?p=home'" class="superior">Inicio</button>
				<!--<button type="button" onclick="window.location.href='?p=productos'" class="superior">Productos</button>-->
				<button type="button" onclick="window.location.href='?p=usuarios'" class="superior">Usuarios</button>
				<button type="button" onclick="window.location.href='?p=partidos'" class="superior">Partidos</button>
				<button type="button" onclick="window.location.href='?p=invitaciones'" class="superior">Invitaciones</button>
				<button type="button" onclick="window.location.href='?p=mapa'" class="superior">Mapa</button>
				<button type="button" onclick="window.location.href='?p=canchas'" class="superior">Canchas</button>
				
				<!--<button type="button" onclick="window.location.href='?p=anuncios'" class="superior">Anuncios</button>
				
				<button type="button" onclick="window.location.href='?p=pedidos'" class="superior">Pedidos</button>
				<button type="button" onclick="window.location.href='?p=usuarios'" class="superior">Usuarios</button>-->
				<button type="button" onclick="window.location.href='?p=configuracion'" class="superior">Configuración</button>
			</div>
		</td>
	</tr>
	<tr>
		<?if (isset($menu_lateral)):?>
		<td class="panelizq">
			<h2>Más opciones</h2>
			<?=$menu_lateral?>
		</td>
		<?endif;?>
		<td class="panelcen">
			<!-- contenido -->
			<?if (isset($botonera)):?>
				<div id="botonera">
				<?foreach ($botonera as $item):?>
					<div class="boton">
					<?=$item?>
					</div>
				<?endforeach;?>
				</div>
			<?endif;?>
			
			<?if (isset($errores)):?>
				<div id="error">
				<?foreach ($errores as $item):?>
					<?=$item['errstr']?><br />
				<?endforeach;?>
				</div>
			<?endif;?>
			
			<?if (isset($informaciones)):?>
				<div id="information">
				<?foreach ($informaciones as $item):?>
					<?=$item?><br />
				<?endforeach;?>
				</div>
			<?endif;?>
			
			<?if (isset($mensajes)):?>
				<div id="ok">
				<?foreach ($mensajes as $item):?>
					<?=$item?><br />
				<?endforeach;?>
				</div>
			<?endif;?>
			
			<?=@$body?>
		</td>
	</tr>
	<tr>
		<td class="pie" colspan="2" align="right">
			Usuario conectado: <?=$_SESSION['operador']['nombre']?>
			<a href="?p=home|logout" class="logout">Cerrar Sesión</a>
		</td>
	</tr>
</table>
</div>
</body>
</html>
