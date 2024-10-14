<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="es-ar" />
	<link rel="stylesheet" type="text/css" href="css/estilo-admin.css" />
	<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
	<title>V8</title>
	<style type="text/css">
	body {background: none; background-color: #000;}
	input {border: 1px solid #aaa; border-left: 3px solid #04ccab; font-size: 21px; padding: 3px; width: 240px;}
	</style>
</head>
<body>

<div align="center">
	<form action="?p=home|login" method="POST" accept-charset="UTF-8" autocomplete="off">
	
	<div style="width: 600px; margin-top: 10px; background: url('images/mundo.jpg') no-repeat;">
		<div style="text-align: center; padding-top: 250px; height: 290px;">
			<p style="color:white; font-weight: bold;">Usuario</p>
			<input type="text" name="usuario" id="usuario" />
			
			<p style="margin-top: 10px; color:white; font-weight: bold;">Contraseña</p>
			<input type="password" name="clave" id="clave" />
			<?if (isset($error)):?>
				<p style="color: darkred; margin-top: 16px; background-color: white; padding: 10px; font-weight: bold;">¿Otra vez sopa?</p>
			<?endif;?>

		</div>
	</div>
	<button type="submit" class="loginbutton" style="color: white; font-size: 20pt;">INGRESAR</button>
	
	</form>
</div>
<script type="text/JavaScript">
	document.getElementById('usuario').focus();
</script>
</body>
</html>