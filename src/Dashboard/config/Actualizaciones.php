<?php
require("Conexion.php");
session_start();

$alert = "";
$alertX = "";
$userId = $_SESSION['datos']['id'];

if (!isset($_SESSION['datos'])) {
    header("Location: ../login/login.php");
    exit(); // Agrega esta línea para detener la ejecución del código después de redirigir
}

if (isset($_POST['submit']) && $_POST['submit'] == "Actualizar") { // Corrige la condición del if


    $usuario = $_POST['usuario'];
    $contra = $_POST['contra'];
    $correo = $_POST['correo'];

    // Verificar si el usuario ya existe
    $sqlCheckUser = "SELECT * FROM `usuarios` WHERE `usuario` = ?";
    $stmtCheckUser = mysqli_prepare($conn, $sqlCheckUser);
    mysqli_stmt_bind_param($stmtCheckUser, "s", $usuario);
    mysqli_stmt_execute($stmtCheckUser);
    mysqli_stmt_store_result($stmtCheckUser);

    if (mysqli_stmt_num_rows($stmtCheckUser) > 0) {
        $alertX = "El usuario ya existe. Por favor, elige otro nombre de usuario.";
    } else {
        // Verifica qué campos se actualizarán
        $updates = array();
        if (!empty($usuario)) {
            $updates[] = "`usuario` = '$usuario'";
        }
        if (!empty($contra)) {
            $contra = md5($contra);
            $updates[] = "`contra` = '$contra'";
        }
        if (!empty($correo)) {
            $updates[] = "`correo` = '$correo'";
        }

        // Verifica si hay campos para actualizar
        if (!empty($updates)) {
            $updatesStr = implode(", ", $updates);
            $sql = "UPDATE `usuarios` SET $updatesStr WHERE `ID` = '$userId'";
            $res = mysqli_query($conn, $sql);
            if ($res) {
                $alert = "Se actualizaron los datos correctamente";
            } else {
                $alert = "Error al actualizar los datos";
            }
        } else {
            $alertX = "No se proporcionaron campos para actualizar";
        }
    }
}
