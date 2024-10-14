<script type="text/javascript">
function ConfirmaSalida() {return MensajeUnload;}

$j().ready(function (e) {
	$j(document).keydown(function(e) {
		if (e.keyCode == 27) {
			if (volver) {
				volver();
			}
		}
		else if(e.keyCode == 118) {
			window.location.href = "?p=<?=$CONTROLLER?>|nuevo";
			return false;
		}
	});
	
	// Foco en el siguiente input.
	$j.fn.focusNextInputField = function() {
		return this.each(function() {
			var fields = $j(this).parents('form:eq(0),body').find('input,textarea,select,button').filter(':visible[tabstop!=no]');
			var index = fields.index( this );
			if ( index > -1 && ( index + 1 ) < fields.length ) {
				fields.eq( index + 1 ).focus().select();
			}
			return false;
		});
	};
	
	// Con enter va al siguiente input.
	$j("input, select").live("keydown", function (e) {
		if (e.keyCode == 13) { // Enter, siguiente input
			e.preventDefault();
			$j(this).blur();
			$j(this).focusNextInputField();
		}
	});
	
	// Habilita un formulario para modificacion.
	$j.fn.habilitar = function(oBoton, cFoco, cMensaje) {
		oBoton.onclick = false;
		oBoton.className = 'active';
		
		$j(this).find("input,select,textarea").attr("disabled", false);
		
		if (cMensaje) {
			MensajeUnload = cMensaje;
		}
		else {
			MensajeUnload = "Si abandona este formulario no se guardarán los cambios efectuados.";
		}
		
		window.onbeforeunload = ConfirmaSalida;
		
		$j('#botonesmodificacion').fadeIn('slow');
		
		if (cFoco) {
			$j(cFoco).focus().select();
		}
		else {
			$j(this).find("input:visible:first").focus().select();
		}
	};
	
	// Validacion automatica de formularios.
	var validarForm = function(e) {
		return forzarValidacion($j(this));
	};
	
	// Formatos estandar de inputs y mascaras de entrada.
	$j.fn.preparar = function (options) {
		var defaults = {
			focus: true,
			masked: true,
			format: true,
			validate: true,
			submit: true,
			deleteAction: true,
			data: {}
		};
		
		options = $j.extend({}, defaults, options);
		
		if (options.masked) {
			$j(this).find(".masked-fecha").mask("99/99/9999");
			$j(this).find(".masked-fechahora").mask("99/99/9999 99:99");
		}
		if (options.format) {
			$j(this).find(".format-entero")
				.format({format: "0", locale: "en"})
				.blur(function () {
					$j(this).format({format: "0", locale: "en"})
				});
			$j(this).find(".format-decimal")
				.format({format: "0.00", locale: "en"})
				.blur(function () {
					$j(this).format({format: "0.00", locale: "en"})
				});
		}
		if (options.validate) {
			$j(this).addClass("validar");
			$j(this).find(".requerido:visible").addClass("fondo-rosa");
			$j(this).bind("submit", validarForm);
		}
		if (options.submit) {
			$j(this).submit(function(e) {window.onbeforeunload = null});
		}
		if (options.deleteAction) {
			$j(this).find(".delete").click(function (e) {
				var oEliminar = new MsgBox();
				oEliminar.BaseUrl = '<?=APP_APPLICATION_URL?>';
				oEliminar.Buttons = MsgBox.BUTTON_YESNO;
				oEliminar.DefaultButton = 2;
				oEliminar.Icon = MsgBox.ICON_INFORMATION;
				oEliminar.Title = 'Confirmación';
				oEliminar.Prompt = '<?=utf8_encode('¿Está seguro que desea borrar este registro?')?>';
				oEliminar.OnYes = function() {
					eval("params = {"+ options.data.input_id +": "+ options.data.value_id +"}");
					
					$j.post(options.data.url + "|x_eliminar", params, function (data) {
						if (data.eliminado == 0) {
							var oMsg = new MsgBox();
							oMsg.BaseUrl = '<?=APP_APPLICATION_URL?>';
							oMsg.Buttons = MsgBox.BUTTON_OKONLY;
							oMsg.DefaultButton = 1;
							oMsg.Icon = MsgBox.ICON_CRITICAL;
							oMsg.Title = 'Atención';
							oMsg.Prompt = '<?=utf8_encode('El registro no se puede eliminar porque posee datos vinculados.')?>';
							oMsg.Show();
						}
						else {
							//$j('#reg-'+oEliminar.id).fadeOut('slow');
							window.onbeforeunload = null;
							window.location.href=options.data.back;
						}
					}, "json");
				}
				
				oEliminar.Show();
				
				return false;
			});
		}

		if (options.focus) {
			$j(this).find("input,select,textarea").filter(":enabled:visible:first").focus().select();
		}
	};
	
	$j.fn.preparar_listado = function (options) {
		var defaults = {
			deleteAction: true,
			publishAction: true,
			emphasizeAction: true,
			data: {}
		};
		
		options = $j.extend({}, defaults, options);
		
		if (options.deleteAction) {
			$j(this).find(".delete").click(function (e) {
				
				var oEliminar = new MsgBox();
				oEliminar.BaseUrl = '<?=APP_APPLICATION_URL?>';
				oEliminar.Buttons = MsgBox.BUTTON_YESNO;
				oEliminar.DefaultButton = 2;
				oEliminar.Icon = MsgBox.ICON_QUESTION;
				oEliminar.Title = 'Confirmación';
				oEliminar.Prompt = '<?=utf8_encode('¿Está seguro que desea borrar este registro?')?>';
				
				var $this = $j(this);
				
				oEliminar.OnYes = function() {
					eval("var params = {id: "+ $this.attr("clave_primaria") +"}");
					
					$j.post(options.data.url + "|x_eliminar", params, function (data) {
						
						if (data.eliminado == 0) {
							var oMsg = new MsgBox();
							oMsg.BaseUrl = '<?=APP_APPLICATION_URL?>';
							oMsg.Buttons = MsgBox.BUTTON_OKONLY;
							oMsg.DefaultButton = 1;
							oMsg.Icon = MsgBox.ICON_CRITICAL;
							oMsg.Title = 'Atención';
							oMsg.Prompt = '<?=utf8_encode('El registro no se puede eliminar porque posee datos vinculados.')?>';
							oMsg.Show();
						}
						else {
							$this.closest("tr").fadeOut("slow", function () {
								$j(this).remove();
							});
						}
					}, "json");
				}
				
				oEliminar.Show();
				
				return false;
			});
		}
		if (options.publishAction) {
			$j(this).find(".publish").click(function (e) {
				eval("var params = {id: "+ $j(this).attr("clave_primaria") +"}");
				
				var $this = $j(this);
				
				$j.post(options.data.url + "|x_publicar", params, function (resultado) {
					if (resultado.publicado == true) {
						$this.find("img").attr("src", "images/ok_16.png");
					}
					else {
						$this.find("img").attr("src", "images/dis/ok_16.png");
					}
				}, "json");
				
				return false;
			});
		}
		if (options.emphasizeAction) {
			$j(this).find(".emphasize").click(function (e) {
				eval("var params = {id: "+ $j(this).attr("clave_primaria") +"}");
				
				var $this = $j(this);
				
				$j.post(options.data.url + "|x_destacar", params, function (resultado) {
					if (resultado.destacado == true) {
						$this.find("img").attr("src", "images/offer_a_16.png");
					}
					else {
						$this.find("img").attr("src", "images/dis/offer_a_16.png");
					}
				}, "json");
				
				return false;
			});
		}
	};
	
	$j.fn.tabs = function() {
		var $tabs = $j(".tabs");
		var $elementos = $tabs.find(".menutabs li");
		var $divs = $tabs.find("div.tabcontent div.hiddentabs").children("div");
		
		// Muestra el div seleccionado
		$divs.filter("." + $elementos.filter(".selected").attr("rel")).show().find("input:visible:first").focus();
		
		$elementos.click(function () {
			var $this = $j(this);
			
			$divs.filter("." + $elementos.filter(".selected").attr("rel")).hide();
			$elementos.removeClass("selected");
			$this.addClass("selected");
			
			$divs.filter("." + $this.attr("rel")).show().find("input:visible:first").focus();
			
		});
	};
});

Math.Redondeo = function (numero, decimales) {
	var pot = Math.pow(10, decimales);
	return Math.round(numero * pot) / pot;
};

var forzarValidacion = function ($this) {
	$this.find(".fondo-rosa").removeClass("fondo-rosa");
	
	var nCantidad = $this.find(".requerido[value=]:visible").addClass("fondo-rosa").length;
	
	if (nCantidad > 0) {
		var oMsg = new MsgBox();
		oMsg.BaseUrl = '<?=APP_APPLICATION_URL?>';
		oMsg.Buttons = MsgBox.BUTTON_OKONLY;
		oMsg.Icon = MsgBox.ICON_CRITICAL;
		oMsg.Title = 'Atención';
		oMsg.Prompt = 'Debe completar los campos obligatorios';
		oMsg.Show();
		
		oMsg.OnOk = function() {
			$j(".fondo-rosa:first").focus();
		}
		return false;
	}
	else {
		return true;
	}
}
</script>