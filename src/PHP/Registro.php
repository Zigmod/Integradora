<?php

require("Conexion.php");

    $User = $_POST['usuario'];
    $contra = $_POST['contra'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $Correo = $_POST['correo'];


    $sql = "INSERT INTO `login`(`usuario`, `contra`, `nombre`, `apellido`, `correo`, `balance`) VALUES ('$User', AES_ENCRYPT('$contra', 'contra2.0'),'$nombre','$apellido','$Correo', 500)";
    
    if (mysqli_query($conn, $sql)) {
        echo "Nuevo registro creado";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

// Cerrar la conexión
mysqli_close($conn);

?>