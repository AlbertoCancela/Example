<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demoinventario";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Error al conectarse a la base de datos: " . $conn->connect_error);
}else{
}

?>