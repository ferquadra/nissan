<h1>Bienvenido/a, Administrador</h1>
<h2>Acciones generales</h2>

<!--
<div class="menu">
	<div class="opciones">
		<h2><img src="images/benchmarking_16.png" align="absmiddle" />Noticias</h2>
		<a class="skh" href="?p=noticias"><img src="images/binoculars_16.png" align="absmiddle" />Buscar</a>
		<a class="skh" href="?p=noticias|nuevo"><img src="images/add_16.png" align="absmiddle" />Agregar</a>
	</div>
</div>
-->
<!--
<div class="menu">
	<div class="opciones">
		<h2><img src="images/shopping_cart_16.png" align="absmiddle" />Pedidos</h2>
		<a class="skh" href="?p=pedidos"><img src="images/shopping_cart_16.png" align="absmiddle" />Pedidos</a>
		<a class="skh" href="?p=estados_pedido"><img src="images/binoculars_16.png" align="absmiddle" />Estados de pedidos</a>
	</div>
</div>
-->
<div class="menu">
	<div class="opciones">
		<h2><img src="images/clients_16.png" align="absmiddle" />Usuarios registrados</h2>
		<a class="skh" href="?p=usuarios"><img src="images/binoculars_16.png" align="absmiddle" />Buscar</a>
		<!--<a class="skh" href="?p=usuarios|nuevo"><img src="images/add_16.png" align="absmiddle" />Agregar</a>-->
	</div>
</div>

<div class="menu">
	<div class="opciones">
		<h2><img src="images/clients_16.png" align="absmiddle" />Partidos</h2>
		<a class="skh" href="?p=partidos"><img src="images/binoculars_16.png" align="absmiddle" />Ver</a>
		<!--<a class="skh" href="?p=usuarios|nuevo"><img src="images/add_16.png" align="absmiddle" />Agregar</a>-->
	</div>
</div>
<!--
<div>
	<br />
	<img src="images/zoom_24.png" style="vertical-align: middle;" />
	<input type="text" class="inputs medium" id="buscador" />
</div>

<div class="clear"></div><hr class="simple" />

<div class="menu">
	<div class="opciones">
		<h2><img src="images/world_next_16.png" align="absmiddle" />Anuncios publicitarios</h2>
		<a class="skh" href="?p=anuncios"><img src="images/binoculars_16.png" align="absmiddle" />Buscar</a>
		<a class="skh" href="?p=anuncios|nuevo"><img src="images/add_16.png" align="absmiddle" />Agregar</a>
	</div>
</div>
-->
<div class="menu">
	<div class="opciones">
		<h2><img src="images/mail_16.png" align="absmiddle" />Mensajes de contacto</h2>
		<a class="skh" href="?p=mensajes"><img src="images/mail_16.png" align="absmiddle" />Mensajes recibidos</a>
	</div>
</div>
<!--
<?
$oListados = new Listados();
$oListados->Bloqueado = 0;
$oListados->LimitCant = null;
$oListados->OrderBy = 'titulo';
$aListados = $oListados->Buscar();
?>
<?if ($aListados):?>
<div class="clear"></div><hr class="simple" />
<?foreach ($aListados as $item):?>
<div class="menu">
	<div class="opciones">
		<h2><img src="images/document_16.png" align="absmiddle" /><?=escape($item['titulo'])?></h2>
		<a class="skh" href="?p=registros|listado&id_listado=<?=$item['id_listado']?>"><img src="images/binoculars_16.png" align="absmiddle" />Buscar</a>
		<a class="skh" href="?p=registros|nuevo&id_listado=<?=$item['id_listado']?>"><img src="images/add_16.png" align="absmiddle" />Agregar</a>
	</div>
</div>
<?endforeach;?>
<?endif;?>
-->
<div class="clear"></div><hr class="simple" />

<?/**
<div class="menu">
	<div class="opciones">
		<h2><img src="images/window_config_16.png" align="absmiddle" />Configuración</h2>
		<a class="skh" href="?p=configuracion|cambiar_clave"><img src="images/primary_key_16.png" align="absmiddle" />Contraseña de acceso</a>
		<a class="skh" href="?p=configuracion"><img src="images/database_config_16.png" align="absmiddle" />Configuración del sitio</a>
		<a class="skh" href="?p=listados"><img src="images/document_config_16.png" align="absmiddle" />Módulos dinámicos</a>
	</div>
</div>
**/?>

<h1>Valoraciones</h1>
<h2 style="font-size: 9pt; color: red;">Tiro al arco / Velocidad / Defensa / Hábilidad / Pase / Resistencia</h2>
<div style="width: 100%; height: 200px; overflow: auto; font-size: 10pt; line-height: 25px;">
<?foreach($valoraciones as $item):?>
<div style="border-bottom: 1px solid #aaa; width: 100%; float: left;">
	<div style="float: left; width: 50%;">
		<?if($item['id_origen'] == $item['id_usuario']):?>
			<span style="color: green;"><?=$item['origen']?></span> se valoró a si mismo.
		<?else:?>
			<span style="color: green;"><?=$item['origen']?></span> valoró a <span style="color: blue;"><?=$item['nombre']?></span>
		<?endif;?>
	</div>
	<div style="float: left;">
		<span style="color: black;"><?=$item['tiroalarco']?> .: <?=$item['velocidad']?> .: <?=$item['defensa']?> .: <?=$item['habilidad']?> .: <?=$item['pase']?> .: <?=$item['fisica']?></span>
	</div>
</div>
<?endforeach;?>
</div>
<div class="clear"></div><hr class="simple" />
<h1>Actividad</h1>
<div style="width: 100%; height: 100px; overflow: auto; font-size: 12pt; line-height: 20px;">
<?foreach($actividad as $item):?>
	<div <?if((time()-$item['timestamp']) > 345600):?>style="color: #aaa"<?endif;?> >
		<?=date("d/m/Y H:i", $item['timestamp'])?> <?=$item['nombre']?> <span><?=$item['mensaje']?></span>
	</div>
<?endforeach;?>
</div>

<?require_once('includes/jquery.autocomplete.min.js.php')?>
<?require_once('includes/jquery.autocomplete.css.php')?>

<script type="text/javascript">
var accesos = [
	{url: "?p=categorias_producto", titulo: "Árbol de categorías"},
	{url: "?p=configuracion", titulo: "Configuración"},
	{url: "?p=configuracion|cambiar_clave", titulo: "Cambiar clave de acceso"},
	{url: "?p=productos|importar", titulo: "Importar productos"},
	{url: "?p=anuncios", titulo: "Listado de anuncios"},
	{url: "?p=estados_pedido", titulo: "Listado de estados de ped."},
	{url: "?p=marcas_producto", titulo: "Listado de marcas"},
	{url: "?p=pedidos", titulo: "Listado de pedidos"},
	{url: "?p=productos", titulo: "Listado de productos"},
	{url: "?p=usuarios", titulo: "Listado de usuarios"},
	{url: "?p=marcas_producto|nuevo", titulo: "Nueva marca"},
	{url: "?p=anuncios|nuevo", titulo: "Nuevo anuncio"},
	{url: "?p=productos|nuevo", titulo: "Nuevo producto"},
	{url: "?p=usuarios|nuevo", titulo: "Nuevo usuario"}
];

$j().ready(function () {
	var $buscador = $j("#buscador");
	$buscador.focus();
	$buscador.autocomplete(accesos, {
		selectImg: false,
		matchContains: true,
		mustMatch: true,
		minChars:0,
		formatItem: function(item) {
			return item.titulo;
		}}).result(function(event, item) {
			if (item != undefined) {
				location.href = item.url;
			}
		});
});
</script>
