<div style="color: black; background: white; border: 1px solid red;">
Error: <b><?=isset($aErrType[$nErrNo]) ? $aErrType[$nErrNo] : $nErrNo?></b><br />
Mensaje: <?=$cErrStr?><br />
Archivo: <?=basename($cPath)?><br />
Linea: <?=$nLine?>
</div>