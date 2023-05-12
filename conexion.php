
<?php
    $servername = "localhost";
    $database = "hidroapp";
    $username = "root";
    $password = "";
    // crear connection
    $conexion = mysqli_connect($servername, $username, $password, $database);
    // verificar connection
    if (!$conexion) {
        die("Falla de conexión: " . mysqli_connect_error());
    }
    //echo "Conexión Exitosa";
    //mysqli_close($conn);

?>