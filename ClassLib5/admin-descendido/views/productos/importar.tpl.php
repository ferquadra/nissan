<h3>Importar productos</h3>

<br />
<p>Para importar productos puede utilizar un archivo CSV.</p>
<br />

<div id="subir-archivo">
	<div class="bloque-campo">
		<div class="titulo">Archivo</div>
		<div class="campo">
			<form method="POST" enctype="multipart/form-data" action="?p=productos|importar" id="upload">
				<input type="file" name="archivo" id="archivo" />
			</form>
		</div>
	</div>
	<div class="clear"></div>
	<?if (isset($error) && $error):?>
		<div style="color: red; padding: 4px;" id="subiendo"><?=$error?></div>
	<?else:?>
		<div style="display:none; color: red; padding: 4px;" id="subiendo"></div>
	<?endif;?>
	<?include('views/widgets/ayuda-uploadarchivo.tpl.php')?>
</div>

<?if (isset($columnas)):?>
<form method="POST" action="?p=productos|importar" id="datos">
<div id="seleccionar-campos" style="margin-top: 20px;">
	<div class="bloque-campo">
		<div class="titulo">Seleccionar campos para sincronizar</div>
		<div class="campo">
			<?
			$aColumnasDB = array(
				'' => 'No sincronizar',
				'codigo' => 'Código de producto',
				'REL::CodigoCategoria' => 'Código de categoría (relacional)',
				'REL::CodigoMarca' => 'Código de marca (relacional)',
				'nombre' => 'Nombre producto',
				'descripcion' => 'Descripción corta',
				'texto' => 'Texto',
				'precio' => 'Precio',
				'precio1' => 'Precio lista 1',
				'precio2' => 'Precio lista 2',
				'precio3' => 'Precio lista 3',
				'precio4' => 'Precio lista 4',
				'precio5' => 'Precio lista 5',
			);
			?>
			<table class="admin-list">
				<thead>
				<tr>
					<td width="200px">Su dato</td>
					<td>Campo producto</td>
				</tr>
				</thead>
				<tbody>
				<?foreach ($columnas as $pos => $item):?>
				<tr class="<?=$pos % 2 == 1 ? 'impar' : ''?>">
					<td><?=$item?></td>
					<td>
					<select name="columna[<?=$pos?>]" class="inputs medium columnas">
					<?foreach ($aColumnasDB as $key => $value):?>
						<option value="<?=$key?>" <?=$key == ucfirst(trim($item)) ? 'selected="selected"' : ''?>><?=$value?></option>
					<?endforeach;?>
					</select>
					</td>
				</tr>
				<?endforeach;?>
				</tbody>
			</table>
			<input type="hidden" name="separador" value="<?=$separador?>" />
			<input type="checkbox" name="ignorar_1linea" id="ignorar_1linea" value="1" checked="checked" /><label for="ignorar_1linea">Ignorar primera línea (nombres de columnas).</label><br />
			<input type="checkbox" name="auto_insertar" id="auto_insertar" value="1" checked="checked" /><label for="auto_insertar">Insertar datos automáticamente en tablas de referencia.</label>
			
			<div class="clear"></div>
			
			<div class="texto-ayuda">
				Seleccione las columnas para sincronizar en su base de datos.<br />
				Si la primera fila del archivo CSV contiene los nombres de las<br />
				columnas deje marcada la opción <b>Ignorar primera línea</b>.<br /><br />
			</div>
			
			<div class="clear" style="margin-top: 20px;"></div>
			
			<?include_once('views/productos/combo-categorias.php')?>
			<div class="bloque-campo">
				<div class="titulo">Categoría</div>
				<div class="campo">
					<select name="id_categoria" id="id_categoria" class="inputs big">
						<option value="">&nbsp;</option>
						<?
						$oCategorias = new Categorias_producto();
						$oCategorias->OrderBy = 'nombre';
						$oCategorias->LimitCant = null;
						combo_categorias($oCategorias, $datos);
						?>
					</select>
				</div>
			</div>
			
			<div class="clear"></div>
			
			<div class="bloque-campo">
				<div class="titulo">Marca</div>
				<div class="campo">
					<select name="id_marca" id="id_marca" class="inputs big">
						<option value="">&nbsp;</option>
						<?
						$oMarcas = new Marcas_producto();
						$oMarcas->OrderBy = 'nombre';
						$oMarcas->LimitCant = null;
						?>
						<?foreach ($oMarcas->Buscar() as $item):?>
						<option value="<?=$item['id_marcaproducto']?>" <?=@$datos['id_marca'] == $item['id_marcaproducto'] ? 'selected="selected"' : ''?>><?=escape($item['nombre'])?></option>
						<?endforeach;?>
					</select>
				</div>
			</div>
			
			<div class="clear"></div>
			
			<div class="bloque-campo">
				<div class="titulo">
					Importar como publicados
					<select name="publicado" id="publicado" class="inputs small">
						<option value="1">Sí</option>
						<option value="1">No</option>
						<option value="">Dejar como está (actualizar)</option>
					</select>
				</div>
			</div>
			
			<div class="clear"></div>
			
			<div class="texto-ayuda">
				Seleccione lo que corresponda si desea importar esta lista de productos<br />
				en una categoría o marca en particular.<br /><br />
				Los productos importados se pueden guardar como publicados, despublicados<br />
				o dejarlos con el valor actual (en caso de que esté actualizando el catálogo).<br /><br />
				La selección de Categoría y Marca funciona únicamente cuando no hay datos<br />
				relacionales durante la importación de cada producto.
			</div>
			
			<div class="clear" style="margin-top: 20px;"></div>
			
			<button type="submit" class="boton-grafico verde" title="Importar" id="boton-enviar" style="float: left;">Importar productos</button>
			<div style="float: left; margin: 6px 8px 0px 6px;">% completado:</div>
			<div style="float: left; width: 150px; height: 20px; background: #eee; border: 1px solid #999;"><div id="progreso" style="background: green; height: 20px; width: 0px;"></div></div>
			<div style="float: left; margin-top: 6px;">&nbsp;<b id="porcentaje">0%</b>&nbsp;<b id="tiempo"></b></div>
			
			<div class="clear"></div>
			
			<div style="float: left; padding: 5px; color: red;">
				<div style="float: left; width: 40px; height: 20px;"><img src="images/loading_16.gif" align="absmiddle" id="cargando" style="display: none;" /></div>
				
				<div style="float: left">
					<b>
						ATENCIÓN: No actualice ni cambie de página<br />mientras se importan los productos a su base de datos.<br /><br />
						Si está importando más de 50.000 productos<br />
						consulte al departamento técnico de Estudio Quadra.<br /><br />
						Este proceso puede demorar varios minutos dependiendo<br />
						de la cantidad de productos que desea importar.
					</b>
				</div>
			</div>
			
		</div>
	</div>
</div>
</form>
<?endif;?>

<script type="text/javascript">
$j().ready(function () {
	$j("#archivo").change(function () {
		$j("#subiendo").html("Subiendo archivo...").fadeIn("fast");
		$j("#upload").submit();
	});
	
	$j("#datos").submit(function () {
		if ($j(".columnas").find("[value=nombre]:selected").length == 0) {
			var oMsg = new MsgBox();
			oMsg.BaseUrl = '<?=APP_APPLICATION_URL?>';
			oMsg.Buttons = MsgBox.BUTTON_OKONLY;
			oMsg.DefaultButton = 1;
			oMsg.Icon = MsgBox.ICON_EXCLAMATION;
			oMsg.Title = "Atención";
			oMsg.Prompt = "<?=utf8_encode('Debe sincronizar nombre del producto.')?>";
			oMsg.Show();
			
			return false;
		}
		
		$j("#boton-enviar").attr("disabled", "disabled");
		$j("#cargando").fadeIn("fast");
		
		var nTiempo = 0;
		
		var interval = setInterval(function () {
			++nTiempo;
			
			$j.get("./productos-importacion.dat", function (data) {
				
				if (data) {
					$j("#progreso").css("width", data.porcentaje + "%");
					$j("#porcentaje").text(data.porcentaje + "%");
					
					/*
					var nSegundos = 100 * nTiempo / data.porcentaje * 500/1000;
					var nMinutos = parseInt(nSegundos / 60);
					
					$j("#tiempo").text(nMinutos.toString() + ":" + (nSegundos % 60).toString());
					*/
				}
				
			}, "json");
			
		}, 500);
		
		$j.post("?p=productos|importar&datos=1", $j("#datos").serialize(), function () {
			clearInterval(interval);
			$j("#cargando").fadeOut("fast");
			$j("#progreso").css("width", "100%");
			$j("#porcentaje").text("100%");
			
			var oMsg = new MsgBox();
			oMsg.BaseUrl = '<?=APP_APPLICATION_URL?>';
			oMsg.Buttons = MsgBox.BUTTON_OKONLY;
			oMsg.DefaultButton = 1;
			oMsg.Icon = MsgBox.ICON_INFORMATION;
			oMsg.Title = "Atención";
			oMsg.Prompt = "<?=utf8_encode('Productos importados con éxito. Pulse aceptar para continuar.')?>";
			oMsg.Show();
			
			oMsg.OnOk = function () {
				window.location.href = '?p=productos';
			};
		});
		
		return false;
	});
});
</script>
