<?php
include '../conexion.php';

$sql = "SELECT a.id_promocion as idProm, p.id_producto as idProd, p.codigo codigo, p.nombreProducto nombreProd, CONCAT(p.nombreProducto,', ',p.descripcion) as descripcion, p.precio_venta precioVenta, p.existencia existencia, a.precio_promocion promocion, a.descripcion as motivo, p.imagen as imagen
			FROM 	producto_promocion a
			JOIN	producto p on p.id_producto = a.prod_id_producto
			WHERE  	a.estado = 'A' 
			ORDER BY a.id_promocion ASC
			LIMIT 	250";

	$resultado = mysqli_query($conexion, $sql);

	if($resultado->num_rows > 0){
		$dataProducto = array();

		while($rows = $resultado->fetch_assoc()){
		    $dataProducto[] = $rows;
		}

		echo json_encode($dataProducto);
	}else{
		echo json_encode('[{}]');
	}

 ?>