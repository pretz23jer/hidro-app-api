<?php 
	//incluir la conexion a la base de datos
	include '../conexion.php';

//recide la data del nuevo registro
	$nombre = $_POST['nombre'] ?? null;
	$apellido = $_POST['apellido'] ?? null;
	$correo = $_POST['correo'] ?? null;
	$telefono = $_POST['telefono'] ?? null;
	$password = $_POST['password'] ?? null;
	$salt = rand(0,999999); //calcular un número aleatorio
	$hash_clave = hash('sha256', $password.$salt); //calcular el hash de clave + salt
	$estado = "A";
	$rol = "Plomero";

	if (!$conexion) {
    // Cannot mix mysql with mysqli (changed out mysql_error())
    // Also, mysqli has "mysqli_connect_error()" for connecting errors
    die('could not connect: '.mysqli_connect_error());
	}

	$sql = "INSERT INTO usuario(nombre, apellido, correo, telefono, hash_clave, salt, estado, rol)
			VALUES ('$nombre', '$apellido', '$correo', '$telefono', '$hash_clave', '$salt', '$estado', '$rol') ";

	$dbresultado = mysqli_query($conexion, $sql);

	if($dbresultado){
		echo json_encode(array('Exitoso'=>true));
	}else{
		echo json_encode(array('Exitoso'=>false));
	}
?>