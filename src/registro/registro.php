<?php
require("../PHP/Conexion.php");
$errors = "";

if (isset($_POST['submit'])) {
    $User = $_POST['usuario'];
    $contra = $_POST['contra'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $Correo = $_POST['correo'];

    $imageDestination = '';

    $contra = md5($contra);

    // Verificar si el usuario ya existe
    $sqlCheckUser = "SELECT * FROM `usuarios` WHERE `usuario` = ?";
    $stmtCheckUser = mysqli_prepare($conn, $sqlCheckUser);
    mysqli_stmt_bind_param($stmtCheckUser, "s", $User);
    mysqli_stmt_execute($stmtCheckUser);
    mysqli_stmt_store_result($stmtCheckUser);

    if (mysqli_stmt_num_rows($stmtCheckUser) > 0) {
        $errors = "El usuario ya existe. Por favor, elige otro nombre de usuario.";
    } else {
        // Manejar la carga de la imagen
        $image = $_FILES['imagen'];
        if ($image === NULL) {
            exit;
        } else {
            $imageName = $image['name'];
            $imageTmpName = $image['tmp_name'];
            $imageError = $image['error'];

            if ($imageError === 0) {
                $imageDestination = './../../Public/Images/Usuarios/' . $imageName;
                move_uploaded_file($imageTmpName, $imageDestination);
            } else {
                echo "Error al cargar la imagen.";
            }
        }
        // Insertar nuevo usuario
        $sqlInsertUser = "INSERT INTO `usuarios`(`ID`, `usuario`, `contra`, `nombre`, `apellido`, `correo`, `rol`, `balance`) VALUES (UUID(), ?, ?, ?, ?, ?, 'USER', 500)";
        $stmtInsertUser = mysqli_prepare($conn, $sqlInsertUser);
        mysqli_stmt_bind_param($stmtInsertUser, "sssss", $User, $contra, $nombre, $apellido, $Correo);

        if (mysqli_stmt_execute($stmtInsertUser)) {
            // Obtener el UUID generado para el ID del usuario
            $sqlUUID = "SELECT * FROM `usuarios` WHERE `usuario` = '$User'";
            $resultUUID = mysqli_query($conn, $sqlUUID);
            $rowUUID = mysqli_fetch_assoc($resultUUID);
            $userID = $rowUUID['ID'];

            // Insertar registro en la tabla imagenesusuario
            $sqlImagen = "INSERT INTO `imagenesusuario` (`id`, `imagenDir`, `id_user`) VALUES (UUID(), ?, ?)";

            $stmtImagen = mysqli_prepare($conn, $sqlImagen);
            mysqli_stmt_bind_param($stmtImagen, "ss", $imageDestination, $userID);

            if (mysqli_stmt_execute($stmtImagen)) {
                header("Location: ../login/login.php");
            } else {
                echo "Error al insertar la imagen: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmtInsertImage);
        } else {
            echo "Error al insertar el usuario: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmtInsertUser);
    }

    mysqli_stmt_close($stmtCheckUser);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="./registro.css" rel="stylesheet">
    <script src="../script.js" type="text/javascript"></script>
</head>

<body>

    <form method="post" enctype="multipart/form-data">
        <h1 class="title">Registro</h1>
        <label>Usuario</label>
        <input type="text" name="usuario" required>
        <label>Contraseña</label>
        <input type="password" name="contra" required>
        <label>Nombre(S)</label>
        <input type="text" name="nombre" required>
        <label>Apellido(s)</label>
        <input type="text" name="apellido" required>
        <label>Correo</label>
        <input type="email" name="correo" required>
        <label>Foto de perfil</label>
        <input type="file" name="imagen">
        <div class="error">
            <?php echo $errors; ?>
        </div>
        <div>
            <button type="submit" class="btn" name="submit">Registrarse</button>
        </div>
    </form>

</body>

</html>