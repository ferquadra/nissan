<h3>Cambiar contraseña de acceso</h3>

<form action="?p=configuracion|cambiar_clave" method="post" id="formulario">
	<div class="bloque-campo">
		<div class="titulo">Contraseña actual</div>
		<div class="campo"><input type="password" name="actual" id="actual" class="inputs medium requerido" title="Debe ingresar la contraseña actual." /></div>
	</div>
	
	<div class="clear"></div>
	
	<div class="bloque-campo">
		<div class="titulo">Contraseña nueva</div>
		<div class="campo"><input type="password" name="nueva" id="nueva" class="inputs medium requerido" title="Introduzca la nueva contraseña." /></div>
	</div>

	<div class="bloque-campo">
		<div class="titulo">Repita</div>
		<div class="campo"><input type="password" name="repita" id="repita" class="inputs medium requerido" title="Repita la nueva contraseña." /></div>
	</div>
	
	<div class="clear"></div>
	
	<div class="texto-ayuda" style="width: 408px;">
		<b><u style="color: red;">ATENCION:</u></b> Si olvida su contraseña tendrá que solicitarla al administrador o el servicio técnico autorizado.
		Una vez que se haya cambiado la contraseña se le solicitará que vuelva a iniciar sesión en el sistema.
	</div>
	
	<div class="clear"></div>
	
	<div class="botones">
		<button type="submit" class="boton-grafico verde" title="Guardar">Guardar</button>
		<button type="button" class="boton-grafico rojo" title="Cancelar" onclick="window.location.href='?p=menu'">Cancelar</button>
	</div>
</form>
<script type="text/javascript">
	$j().ready(function() {
		$j("form:first").preparar({
			deleteAction: false
		});
		
		$j("form:first").submit(function () {
			if ($j("#nueva").val() != $j("#repita").val()) {
				var oMsg = new MsgBox();
				oMsg.BaseUrl = '<?=APP_APPLICATION_URL?>';
				oMsg.Buttons = MsgBox.BUTTON_OKONLY;
				oMsg.Icon = MsgBox.ICON_EXCLAMATION;
				oMsg.Title = "Atención";
				oMsg.Prompt = "<?=utf8_encode('Las contraseñas nuevas son diferentes.')?>";
				oMsg.Show();
				
				oMsg.OnOk = function () {
					$j("#nueva").focus().select();
				}
				return false;
			}
			
			return true;
		});
	});
</script>