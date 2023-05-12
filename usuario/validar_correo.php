<?php 
	include '../conexion.php';

	$correo = $_POST['correo'] ?? null;
//buscar y validar en la base de datos si existe el correo, si ya se encuetnra registrado
	$sql = "SELECT * FROM usuario WHERE correo ='$correo' AND estado = 'A' ";

	$resultado = mysqli_query($conexion, $sql);

	if($resultado->num_rows > 0){
		echo json_encode(array('Existe'=>true));
	}else{
		echo json_encode(array('Existe'=>false));
	}
?>