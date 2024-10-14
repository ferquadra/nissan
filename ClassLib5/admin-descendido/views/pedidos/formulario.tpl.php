<?if (@$datos['id_pedido']):?>
	<h3>Modificando pedido</h3>
<?else:?>
	<h3>Nuevo pedido</h3>
<?endif;?>

<form action="?p=pedidos|guardar" method="post" id="formulario" autocomplete="off">
	<input type="hidden" name="id_pedido" id="clave_primaria" value="<?=@$datos['id_pedido']?>" />
	<input type="hidden" name="x-volver" value="<?if(@$datos['id_pedido']):?><?=escape(@$_SERVER['HTTP_REFERER'])?><?else:?>?p=pedidos<?endif;?>" />
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Fecha del pedido</div>
		<div class="campo"><b><?=mysql2date(@$datos['fecha'], '%d/%m/%Y %H:%i')?></b></div>
	</div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Usuario</div>
		<div class="campo"><b><?=escape(@$datos['usuario'])?></b></div>
	</div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Estado</div>
		<div class="campo">
			<select name="id_estado" id="id_estado" class="inputs medium">
				<?foreach ($estados as $item):?>
					<option value="<?=$item['id_estadopedido']?>" <?=@$datos['id_estado'] == $item['id_estadopedido'] ? 'selected="selected"' : ''?>><?=escape($item['nombre'])?></option>
				<?endforeach;?>
			</select>
		</div>
	</div>
	<div class="clear"></div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Comentario del usuario</div>
		<div class="campo"><b><?=nl2br(escape(@$datos['comentario']))?></b></div>
	</div>
	<div class="clear"></div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Nota (administración)</div>
		<div class="campo">
			<textarea name="nota" id="nota" class="inputs big" rows="10"><?=escape(@$datos['nota'])?></textarea>
			<?if (Configuracion::ObtenerValor(CONFIGURACION_USAR_CKEDITOR) == 1):?>				<?include('views/widgets/ayuda-ckeditor.tpl.php')?>				<?require_once(APP_ADDONS_PATH.'/ckeditor.js.php');?>				<script type="text/javascript">
					$j().ready(function () {
						$j("#nota").ckeditor({toolbar: "Basic"});
					});
				</script>
			<?endif;?>
		</div>
	</div>
	<div class="clear"></div>
	
	<div class="bloque-campo">
		<div class="titulo">Productos pedidos</div>
		<div class="campo">
			<table class="admin-list" style="width: 700px;">
			<thead>
				<tr>
					<td width="60px" style="text-align: right">Código</td>
					<td>Producto</td>
					<td width="40px" style="text-align: right">Cant.</td>
					<td width="70px" style="text-align: right">Precio</td>
					<td width="80px" style="text-align: right">Total</td>
				</tr>
			</thead>
			<tbody>
				<?foreach ($productos as $pos => $item):?>
				<?$item = escape($item)?>
				<tr class="<?=$pos % 2 == 1 ? 'impar' : ''?>">
					<td align="right"><?=$item['codigo']?></td>
					<td><?=$item['producto']?></td>
					<td align="right"><?=$item['cantidad']?></td>
					<?if ($item['unitario'] > 0):?>
					<td align="right">$ <?=number_format($item['unitario'], 2, ',', '.')?></td>
					<td align="right"><b>$ <?=number_format($item['total'], 2, ',', '.')?></b></td>
					<?else:?>
					<td align="right">------</td>
					<td align="right"><b>------</b></td>
					<?endif;?>
				</tr>
				<?endforeach;?>
				<tr style="border-top: 1px solid #666;">
					<td colspan="2" align="right"></td>
					<td align="right"><b><?=$datos['cantidad_total']?></b></td>
					<td></td>
					<td align="right"><b>$ <?=number_format($datos['importe_total'], 2, ',', '.')?></b></td>
				</tr>
			</tbody>
			</table>
		</div>
	</div>
	<div class="clear"></div>
	
	<div class="botones">
		<button type="submit" class="boton-grafico verde" title="Guardar">Guardar</button>
		<button type="button" class="boton-grafico rojo" title="Cancelar" onclick="window.location.href='<?if(@$datos['id_pedido']):?><?=escape(@$_SERVER['HTTP_REFERER'])?><?else:?>pedidos<?endif;?>'">Cancelar</button>
	</div>
</form>

<script type="text/javascript">
	$j().ready(function() {
		$j("form:first").preparar({
			deleteAction: false
		});
	});
</script>