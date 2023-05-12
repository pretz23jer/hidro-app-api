<?php 
//incluir la conexion a la base de datos
	include '../conexion.php';

//recide la data del nuevo registro
	$correoIngresado = $_POST['correo'] ?? null;
	$password = $_POST['clave'] ?? null;

	$salt = rand(0,999999); //calcular un número aleatorio
	$hash_clave = hash('sha256', $password.$salt); //calcular el hash de clave + salt

	$sql = "SELECT * FROM usuario WHERE correo ='$correoIngresado' AND estado = 'A' ";
	$dbresultado = mysqli_query($conexion, $sql);

	if($dbresultado->num_rows > 0){
		$sql = "UPDATE usuario
			SET hash_clave = '$hash_clave', salt = '$salt'
			WHERE correo = '$correoIngresado' ";

		$dbresultado = mysqli_query($conexion, $sql);

		echo json_encode(array('Exitoso'=>true));
	}else{
		echo json_encode(array('Exitoso'=>false));
	}

?>