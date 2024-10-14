<h3>Árbol de categorías de productos</h3>

<style>
div.arbol {border: 1px dotted #999; width: 600px; float: left; height: 400px; overflow: auto;}

div.arbol ul {}
div.arbol ul ul {display: none; border-left: 1px dotted black; margin-left: 10px; padding: 0px;}
div.arbol li {padding: 4px 2px 4px 20px; cursor: pointer; list-style: none; border-bottom: 1px solid #ddd;}
div.arbol li div.titulo {float: left; width: 90%;}
div.arbol li:hover {background-color: #FEC;}
li.mas {background: url("images/plus.gif") no-repeat 5px 50%;}
li.menos {background: url("images/minus.gif") no-repeat 5px 50%;}
li a {float: right; margin-left: 6px;}
#editor {margin-top: 20px; border-top: 2px solid #666;}
</style>
<?
function arbol_categorias(&$oCategorias, $nIdPadre=0) {
	$oCategorias->IdPadre = $nIdPadre;
	$aCategs = $oCategorias->Buscar();
	
	if ($aCategs) {
		?><ul><?
		foreach ($aCategs as $item) {
			?>
			<li>
				<div class="titulo"><?=$item['nombre']?></div>
				<a href="" class="eliminar" title="Eliminar" habilitado="1" clave_primaria="<?=$item['id_categoriaproducto']?>"><img src="images/delete_16.png" align="absmiddle" /></a>
				<a href="" class="editar" title="Modificar" clave_primaria="<?=$item['id_categoriaproducto']?>"><img src="images/write_16.png" align="absmiddle" /></a>
				<div class="clear"></div>
			</li>
			<?
			arbol_categorias($oCategorias, $item['id_categoriaproducto']);
		}
		?></ul><?
	}
}
?>
<div class="texto-ayuda" style="float: left; margin: 8px 0px; width: 350px;">
	Haga un solo click para expandir la categoría.<br /><br />
	Utilice los botones de la derecha para acceder a las opciones.<br /><br />
	Para eliminar una categoría primero debe asegurarse de eliminar todas sus subcategorías.
</div>

<div class="arbol">
	<?
	$oCategorias = new Categorias_producto();
	$oCategorias->OrderBy = 'nombre';
	$oCategorias->LimitCant = null;
	?>
	<?=arbol_categorias($oCategorias);?>
</div>

<div class="clear"></div>

<button type="button" id="insertar" class="boton-grafico verde" title="Insertar" style="margin-top: 10px;">Insertar</button>

<div id="editor"></div>

<script>
$j().ready(function () {
	$j(".arbol ul ul").prev()
		.addClass("mas")
		.find(".eliminar")
			.attr("habilitado", "0").children()
			.attr("src", "images/dis/delete_16.png");
	
	$j(".arbol li").click(function () {
		var $this = $j(this);
		
		if ($this.next("ul").length == 0) return;
		
		$this.toggleClass("mas menos");
		$this.next().slideToggle("fast");
	});
	
	$j(".editar").click(function () {
		$j("#editor").load("?p=categorias_producto|x_editar&id_categoriaproducto="+$j(this).attr("clave_primaria"));
		return false;
	});
	
	$j("#insertar").click(function () {
		$j("#editor").load("?p=categorias_producto|x_nuevo");
		return false;
	});
	
	$j(".eliminar").click(function () {
		$this = $j(this);
		if ($this.attr("habilitado") == 0) return false;
		
			var oMsg = new MsgBox();
			oMsg.BaseUrl = '<?=APP_APPLICATION_URL?>';
			oMsg.Buttons = MsgBox.BUTTON_YESNO;
			oMsg.DefaultButton = 2;
			oMsg.Icon = MsgBox.ICON_QUESTION;
			oMsg.Title = "Atención";
			oMsg.Prompt = "<?=utf8_encode('¿Está seguro que desea eliminar este registro?')?>";
			oMsg.Show();
			
			oMsg.OnYes = function () {
				$j.post("?p=categorias_producto|x_eliminar", {id: $this.attr("clave_primaria")}, function () {
					location.href="?p=categorias_producto";
				});
			}		
		return false;
	});
});
</script>