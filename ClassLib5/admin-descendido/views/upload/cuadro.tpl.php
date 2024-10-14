<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="es-ar" />
	<?require_once(APP_ADDONS_PATH.'/jquery.php')?>
	<script>var $j = jQuery.noConflict();</script>
	<?require_once(APP_ADDONS_PATH.'/jqgreybox.php')?>
	<?require_once(APP_ADDONS_PATH.'/msgbox.php')?>
	<style type="text/css">
		body {background: #eee;font-family: "Trebuchet MS", sans-serif;margin: 0px;font-size: 8pt;}
		.cuadro {border: 1px solid #999; width: 360px; height: 130px; overflow: auto; margin: 5px;}
	</style>
</head>
<body>
<div class="cuadro">
	<?=$body?>
</div>

<form method="POST" enctype="multipart/form-data" action="?p=upload|guardar" id="upload">
	<input type="hidden" name="contenedor" value="<?=escape($contenedor)?>" />
	<input type="hidden" name="origen" value="<?=escape($origen)?>" />
	<input type="hidden" name="destino" value="<?=escape($destino)?>" />
	<input type="hidden" name="sector" value="<?=escape($sector)?>" />
	<input type="hidden" name="id_elemento" id="id_elemento" value="<?=escape($id_elemento)?>" />
	<?foreach ($extras as $key => $value):?>
	<input type="hidden" name="extras[<?=$key?>]" class="input-extras" value="<?=escape($value)?>" />
	<?endforeach;?>
	<input type="hidden" name="limite" id="limite" value="<?=escape($limite)?>" />
	
	<input type="file" name="archivo[]" id="archivo" multiple="multiple" />
	<?if (isset($error) && $error):?>
		<div style="color: red; padding: 4px;" id="subiendo"><?=$error?></div>
	<?else:?>
		<div style="display:none; color: red; padding: 4px;" id="subiendo"></div>
	<?endif;?>
</form>

<script type="text/javascript">
$j().ready(function() {
	$j("#archivo").change(function () {
		
		var nLimite = $j("#limite").val();
		if (nLimite > 0 && $j(".cuadrito").length >= nLimite) {
			var oMsg = new parent.MsgBox();
			oMsg.BaseUrl = '<?=APP_APPLICATION_URL?>';
			oMsg.Buttons = MsgBox.BUTTON_OKONLY;
			oMsg.Icon = MsgBox.ICON_CRITICAL;
			oMsg.Title = "Atención";
			oMsg.Prompt = "<?=utf8_encode('Ha alcanzado el límite de archivos para subir en este sector.')?>";
			oMsg.Show();
			return false;
		}
		
		<?if ($id_elemento == null):?>
			var oMsg = new parent.MsgBox();
			oMsg.BaseUrl = '<?=APP_APPLICATION_URL?>';
			oMsg.Buttons = MsgBox.BUTTON_YESNO;
			oMsg.Icon = MsgBox.ICON_EXCLAMATION;
			oMsg.Title = "Atención";
			oMsg.Prompt = "<?=utf8_encode('Antes de subir archivos debe guardar. ¿Desea guardar ahora?')?>";
			oMsg.Show();
			
			oMsg.OnYes = function () {
				if (parent.forzarValidacion(parent.$j("#formulario"))) {
					if (parent.CKEDITOR) {
						for ( instance in parent.CKEDITOR.instances ) {
							parent.CKEDITOR.instances[instance].updateElement();
						}
					}
					parent.$j.post(parent.$j("#formulario").attr("action")+'&devolver=1', parent.$j("#formulario").serialize(), function (data) {
						var id = data.id;
						parent.$j("#clave_primaria").val(id);
						
						$j("#id_elemento").val(id);
						$j("#subiendo").html("Subiendo archivos y realizando tareas, aguarde un instante...").fadeIn("fast");
						$j("#upload").submit();
					}, "json");
				}
			}
			return false;
		<?else:?>
		$j("#subiendo").html("Subiendo archivo y realizando tareas, aguarde un instante...").fadeIn("fast");
		$j("#upload").submit();
		<?endif;?>
	});
});
</script>
</body>
</html>