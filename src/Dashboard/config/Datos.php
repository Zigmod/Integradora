<?php
session_start();
require("../PHP/Conexion.php");


if (!isset($_SESSION['datos'])) {
    header("Location: ../login/login.php");
}

$userId = $_SESSION['datos']['id'];


// accediendo a la base de datos para obtener el nombre
$query = "SELECT `nombre` FROM `usuarios` WHERE id = '$userId'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
if ($row['nombre'] == null) {
    $nombre = "No hay nombre";
} else {
    $nombre = $row['nombre'];
}

// accediendo a la base de datos para obtener el apellido
$query = "SELECT `apellido` FROM `usuarios` WHERE id = '$userId'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
if ($row['apellido'] == null) {
    $apellido = "No hay apellido";
} else {
    $apellido = $row['apellido'];
}

// accediendo a la base de datos para obtener la imagen
$query = "SELECT `imagenDir` FROM `imagenesusuario` WHERE id_user = '$userId'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
if ($row['imagenDir'] == null) {
    $ubicacion = "./../../Public/Images/Usuarios/default.png";
} else {
    $ubicacion = $row['imagenDir'];
}

// accediendo a la base de datos para obtener el correo
$query = "SELECT `Correo` FROM `usuarios` WHERE id = '$userId'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
if ($row['Correo'] == null) {
    $correo = "No hay correo";
} else {
    $correo = $row['Correo'];
}

// accediendo a la base de datos para obtener el rol
$query = "SELECT `rol` FROM `usuarios` WHERE id = '$userId'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
if ($row['rol'] == true) {
    $rol = $row['rol'];
}

// accediendo a la base de datos para obtener el balance
$query = "SELECT `balance` FROM `usuarios` WHERE id = '$userId'";
$result = mysqli_query($conn, $query);

if ($result === 0) {
    $balance = 0;
} else {
    $row = mysqli_fetch_assoc($result);
    $balance = $row['balance'];
}
try {
    $sql = "SELECT * FROM `donacionusuario` WHERE `id_user` = '$userId'";
    $result = mysqli_query($conn, $sql);
    $infoDonacion = array();

    $condicion = false;

    // ? Si el usuario ha donado, entonces se almacena la información en el arreglo $infoDonacion
    
    if ($row = mysqli_fetch_array($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $cantidadDonada = $row['cantidad'];
            $idEvento = $row['id_evento'];
            try {
                $sqlEvent = "SELECT `titulo` FROM `eventos` WHERE `id` = '$idEvento'";
                $resultEvent = mysqli_query($conn, $sqlEvent);
                $rowEve = mysqli_fetch_assoc($resultEvent);
                $nombreEvento = $rowEve['titulo'];
            } catch (Exception $e) {
                exit;
            }


            // Almacenar la información en el arreglo $infoDonacion
            $infoDonacion[] = array('nombreEvento' => $nombreEvento, 'cantidadDonada' => $cantidadDonada, 'idEvento' => $idEvento);
        }
    } else {
        $condicion = true;
    }

    // Ahora $infoDonacion es un arreglo asociativo con los nombres de usuario como clave
    // y las cantidades donadas como valor.
} catch (Exception $e) {
    // Manejo de excepciones, si es necesario
}
