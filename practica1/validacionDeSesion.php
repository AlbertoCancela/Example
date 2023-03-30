<?php
include('connection.php');

$usuario = $_POST['usuario'];
$password = $_POST['pass'];


$querySelectUser = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND pass = '$password'";

$resultado = $conn->query($querySelectUser); 

if ($resultado->num_rows > 0)
{
    echo 1;
}else{
    echo 0;
}
?>