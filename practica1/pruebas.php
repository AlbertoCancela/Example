<?php
$variable = 'LIBRETA RAYAS:14:LIBRETA BITÁCORA:1';
$resultado = explode(":",$variable);
echo $resultado[0]."<br>";
echo $resultado[1]."<br>";
echo $resultado[2]."<br>";
echo $resultado[3]."<br>";

$resultado[1]=(int)$resultado[1];
$resultado[3]=(int)$resultado[3];

echo gettype($resultado[1]);

include ('connection.php');

$variableINSERTAR = "INSERT INTO productos(nombre,existencias,descripcion,idunidad) VALUES ('$resultado[0]', $resultado[1],'$resultado[2]',$resultado[3])";

$conn -> query($variableINSERTAR);


?>