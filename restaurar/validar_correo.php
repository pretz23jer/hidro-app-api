<?php 

include '../conexion.php';

$correo = $_POST['correo'] ?? null;


$sql = "SELECT * FROM usuario WHERE correo ='$correo' AND estado = 'A' ";

	$resultado = mysqli_query($conexion, $sql);

	if($resultado->num_rows > 0){
		echo json_encode(array('Existe'=>true));
	}else{
		echo json_encode(array('Existe'=>false));
	}

?>