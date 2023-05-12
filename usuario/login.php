<?php
include '../conexion.php';

$correo = $_POST['correo'] ?? null;
$password = $_POST['password'] ?? null;
/*
$correo = 'pretz23jer@gmail.com';
$password = 'Walter123@';
*/
//SECCION DE AUTENTICACION DE USUARIO REGISTRADO EN LA BASE DE DATOS HIDROAPP
	$sql = "SELECT 	id_usuario, correo, hash_clave,  salt
			FROM 	usuario
			WHERE 	correo = '$correo' AND estado = 'A'
			LIMIT 	1;";

	$datos = mysqli_query($conexion, $sql);
	
	$arrayDatos = array();

	$id = '';
	$salt = '';
	$hash_claveReg = '';

	while($row = $datos->fetch_assoc()){
	    $id = $row['id_usuario'];
	    $salt = $row['salt'];
	    $hash_claveReg = $row['hash_clave'];
	}

	$hashClave = hash('sha256', $password.$salt); // Calcular sha512 de clave + salt

	$sql = "SELECT id_usuario, CONCAT(nombre,' ',apellido) as nombre, apellido, correo, CONCAT('Cel: ', telefono) as telefono,  rol as password
	FROM usuario
	WHERE 	id_usuario = '$id' AND hash_clave = '$hashClave' AND estado = 'A'
	LIMIT 	1;";

	//$datos2 = mysqli_query($conexion, $sql);
	$datos2 = $conexion->query($sql);
	
	if($datos2->num_rows > 0){

		$dataUsuario = array();

		while($rows = $datos2->fetch_assoc()){
		    $dataUsuario[] = $rows;
		}

		echo json_encode(
			array(
			"success"=>true,
			"usuarioData"=>$dataUsuario[0],
			)
		);
	}else{
		echo json_encode(array('success'=>false));
	}
?>