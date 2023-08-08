<?php
session_start();
require("../PHP/Conexion.php");

if (!isset($_SESSION['datos'])) {
    header("Location: ../login/login.php");
}

$userId = $_SESSION['datos']['id'];

if (isset($_POST['submit'])) {

    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $ubicacion = $_POST['ubicacion'];
    $meta = $_POST['meta'];
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];

    // Directorio donde se almacenaran las imagenes
    $imageDestination = '';

    // Manejar la carga de la imagen
    $image1 = $_FILES['imagen1'];
    $image2 = $_FILES['imagen2'];
    $image3 = $_FILES['imagen3'];
    if ($image1 === NULL && $image2 === NULL && $image3 === NULL) {
        exit;
    } else {
        $imageName = $image1['name'];
        $imageTmpName = $image1['tmp_name'];
        $imageError = $image1['error'];

        $imageName2 = $image2['name'];
        $imageTmpName2 = $image2['tmp_name'];
        $imageError2 = $image2['error'];

        $imageName3 = $image3['name'];
        $imageTmpName3 = $image3['tmp_name'];
        $imageError3 = $image3['error'];

        if ($imageError === 0 && $imageError2 === 0 && $imageError3 === 0) {
            $imageDestination = './../../Public/Images/Eventos/' . $imageName;
            $imageDestination2 = './../../Public/Images/Eventos/' . $imageName2;
            $imageDestination3 = './../../Public/Images/Eventos/' . $imageName3;
            move_uploaded_file($imageTmpName, $imageDestination);
            move_uploaded_file($imageTmpName2, $imageDestination2);
            move_uploaded_file($imageTmpName3, $imageDestination3);
        } else {
            echo "Error al cargar la imagen.";
        }

        try {
            $sql = "INSERT INTO `eventos` (`id`, `titulo`, `descrip`, `ubicacion`, `meta_fondeo`, `fondeado`, `fecha_inicio`, `fecha_cierre`, `finalizado`, `id_creador`) VALUES (UUID(), ?, ?, ?, ?, 0, ?, ?, false, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssssss", $titulo, $descripcion, $ubicacion, $meta, $fechaInicio, $fechaFin, $userId);
        } catch (Exception $e) {
            echo $e;
        }
    }




    // Obtener el UUID generado para el ID del evento
    try {
        if (mysqli_stmt_execute($stmt)) {
            $sqlUUID = "SELECT `id` FROM `eventos` WHERE `titulo` = '$titulo' AND `id_creador` = '$userId'";
            $resultUUID = mysqli_query($conn, $sqlUUID);
            $eventId = mysqli_fetch_assoc($resultUUID);
            $eventId = $eventId['id'];

            $sqlUUID = "INSERT INTO `imageneseventos` (`id`, `imagenDir_1`, `imagenDir_2`, `imagenDir_3`, `id_evento`) VALUES (UUID(), ?, ?, ?, ?)";
            $stmtUUID = mysqli_prepare($conn, $sqlUUID);
            mysqli_stmt_bind_param($stmtUUID, "ssss", $imageDestination, $imageDestination2, $imageDestination3, $eventId);

            mysqli_stmt_execute($stmtUUID);
        }
    } catch (Exception $e) {
        echo $e;
    }
    mysqli_stmt_close($stmtUUID);
}

mysqli_close($conn);
