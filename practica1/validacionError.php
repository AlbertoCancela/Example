<?php
include ('connection.php');
$usuario = $_POST['usuario'];

$consultarUsuario = "SELECT * FROM usuarios WHERE usuario = '$usuario'";

$resultado = $conn->query($consultarUsuario); 

if ($resultado->num_rows > 0){
    echo 1;
}else{
    echo 2;
}

?>