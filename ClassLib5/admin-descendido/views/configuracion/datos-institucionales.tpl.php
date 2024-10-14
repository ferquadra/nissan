<h3>Configuración del sitio Web</h3>

<form action="?p=configuracion|guardar" method="post" id="formulario" enctype="multipart/form-data" autocomplete="off">
	<div class="tabs">
		<ul class="menutabs">
			<li class="selected" rel="config-general">General</li>
			<li rel="config-contacto">Contacto</li>
			<li rel="config-catalogo">Catálogo</li>
			<li rel="config-avanzada">Avanzada</li>
			<div style="clear: both; height: 0px;"></div>
		</ul>
		<div class="tabcontent">
			<div class="hiddentabs">
				<?foreach ($configuracion as $nombre => $listado):?>
				<div class="config-<?=$nombre?>" style="display: none;">
					<?include('views/configuracion/lista-configuracion.tpl.php')?>
				</div>
				<?endforeach;?>
			</div>
		</div>
	</div>
	
	<div class="botones" style="margin-top: 10px;">
		<button type="submit" class="boton-grafico verde" title="Guardar">Guardar</button>
		<button type="button" class="boton-grafico rojo" title="Cancelar" onclick="window.location.href='?p=menu'">Cancelar</button>
	</div>
</form>
<script type="text/javascript">
	$j().ready(function() {
		$j("form:first").preparar({
			deleteAction: false
		});
		
		$j().tabs();
	});
</script>