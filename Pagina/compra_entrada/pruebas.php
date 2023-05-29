<?php

$conexion = mysqli_connect ("localhost", "root", "") or die ("No hay conexion");
mysqli_select_db ($conexion, "fabrik") or die ("No se puede seleccionar la base de datos");
$instruccion="SELECT * FROM Fiestas";
$consulta=mysqli_query($conexion, $instruccion) or die ("Fallo de la consulta");
$nfilas = mysqli_fetch_rows($consulta);
for ($i=0; $i < $nfilas; $i++){
    $fila= mysqli_fetch_array ($consulta);
}
mysqli_close($conexion);
?>