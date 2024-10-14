	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Nombre o título del anuncio</div>
		<div class="campo"><input type="text" name="nombre" id="nombre" value="<?=escape(@$datos['nombre'])?>" class="inputs medium requerido" maxlength="100" /></div>
	</div>
	<div class="clear"></div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">URL</div>
		<div class="campo"><input type="text" name="url" id="url" value="<?=escape(@$datos['url'])?>" class="inputs big" maxlength="255" /></div>
	</div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Destino</div>
		<div class="campo">
			<select name="target" id="target" class="inputs medium">
				<option value="_blank">Ventana nueva</option>
				<option value="_self" <?=@$datos['target'] == '_self' ? 'selected="selected"' : ''?>>En la misma ventana</option>
			</select>
		</div>
	</div>
	<div class="clear"></div>
	
	<div class="texto-ayuda" style="width: 620px;">
		<b><u style="color: red;">URL Y DESTINO:</u></b> Opcionalmente puede especificar una página Web de destino al hacer click sobre el anuncio.<br />
		Si el anuncio es un archivo SWF de Adobe Flash &copy; el link puede no tener efecto.
	</div>
	<div class="clear"></div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Banner publicitario</div>
		<div class="campo">
			<iframe src="?p=upload&contenedor=anuncios&origen=archivos&destino=archivos&sector=<?=SECTOR_ANUNCIOS?>&id_elemento=<?=@$datos['id_anuncio']?>&limite=1" width="378" height="210"></iframe>
			<?include('views/widgets/ayuda-uploadarchivo.tpl.php')?>
		</div>
	</div>
	<div class="clear"></div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Desde</div>
		<div class="campo"><input type="text" name="vigencia_desde" id="vigencia_desde" value="<?=mysql2date(@$datos['vigencia_desde'])?>" class="inputs masked-fecha" maxlength="10" /></div>
	</div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Hasta</div>
		<div class="campo"><input type="text" name="vigencia_hasta" id="vigencia_hasta" value="<?=mysql2date(@$datos['vigencia_hasta'])?>" class="inputs medium masked-fecha" maxlength="10" /></div>
	</div>
	<div class="clear"></div>
	
	<div class="texto-ayuda" style="width: 300px;">
		<b><u style="color: red;">VIGENCIA:</u></b> Son las fechas de vigencia del anuncio.<br />
		Si omite alguna fecha no habrá límite.
	</div>
	<div class="clear"></div>
	
	<!-- INICIO DE CAMPO -->
	<!--<div class="bloque-campo">
		<div class="titulo">Impresiones pautadas</div>
		<div class="campo"><input type="text" name="impresiones" id="impresiones" value="<?=escape(@$datos['impresiones'])?>" class="inputs small" maxlength="11" /></div>
	</div>-->
	
	<!-- INICIO DE CAMPO -->
	<!--<div class="bloque-campo">
		<div class="titulo">Impresiones consumidas</div>
		<div class="campo">
			<input type="text" name="contador_impresiones" id="contador_impresiones" value="<?=escape(@$datos['contador_impresiones'])?>" class="inputs medium" maxlength="10" />
		</div>
	</div>
	<div class="clear"></div>-->
	
	<!-- INICIO DE CAMPO -->
	<!--<div class="bloque-campo">
		<div class="titulo">Clics</div>
		<div class="campo"><input type="text" name="clicks" id="clicks" value="<?=escape(@$datos['clicks'])?>" class="inputs medium" maxlength="10" /></div>
	</div>
	<div class="clear"></div>-->
	
	<!-- INICIO DE CAMPO -->
	<!--<div class="bloque-campo">
		<div class="titulo">Contador de clics</div>
		<div class="campo"><input type="text" name="contador_clicks" id="contador_clicks" value="<?=escape(@$datos['contador_clicks'])?>" class="inputs medium" maxlength="10" /></div>
	</div>
	<div class="clear"></div>-->
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Opciones de publicación</div>
		<div class="campo">
			<input type="checkbox" name="publicado" id="publicado" value="1" <?=!isset($datos['publicado']) || @$datos['publicado'] ? 'checked="checked"' : ''?> /> <label for="publicado">Publicado</label>
		</div>
	</div>
	<div class="clear"></div>
	
	<!-- INICIO DE CAMPO -->
	<div class="bloque-campo">
		<div class="titulo">Notas</div>
		<div class="campo">
			<textarea name="notas" id="notas" class="inputs big" rows="10"><?=escape(@$datos['notas'])?></textarea>
		</div>
	</div>
	<div class="clear"></div>