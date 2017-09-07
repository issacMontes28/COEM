<?php
include("conectar.php");
mysql_select_db("coem",$conectar);
extract($_POST);

$fecha = date('Y-m-d');
$consulta = mysql_query("insert into ventas_c_cita(id_cita,producto,cantidad,subtotal,fecha) values ('$id','$producto','$cantidad','$subtotal','$fecha')",$conectar);

if ($consulta) {
		echo "se ha guardado en la base de datos<br>";
		echo "<a href='../index.html'>Regresar</a>";
}
else{
	echo "no se pudo<br>".mysql_error();
	echo "<a href='../index.html'>Regresar</a>";
}
?>
