<?php
session_start();

require('./../PHP/Conexion.php');
$userID = $_SESSION['datos']['id'];

// Manejo de rutas
try {
  $sql = "SELECT `balance` FROM `usuarios` WHERE `ID` = '$userID'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  $balUser = $row['balance'];
} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}
$login = '../login';
$registro = '../registro';
$dashboard = '../dashboard';
$home = '..';
$eventoID = $_GET['id'];
$alertDonacion = "";


// Obtener los datos del evento
try {
  $query = "SELECT * FROM eventos WHERE id = '$eventoID'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);


  $titulo = $row['titulo'];
  $descripcion = $row['descrip'];
  $fechaInicio = $row['fecha_inicio'];
  $fechaFin = $row['fecha_cierre'];
  $ubicacion = $row['ubicacion'];
  $metaFondeo = $row['meta_fondeo'];
  $fondeado = $row['fondeado'];


  $progreso = ($fondeado / $metaFondeo) * 100;
  $progreso = min(100, max(0, $progreso));

  $sqlImages = "SELECT * FROM imageneseventos WHERE id_evento = '$eventoID'";
  $resultImages = mysqli_query($conn, $sqlImages);
  $images = array();
  while ($rowImages = mysqli_fetch_array($resultImages)) {
    $images[] = $rowImages['imagenDir_1'];
    $images[] = $rowImages['imagenDir_2'];
    $images[] = $rowImages['imagenDir_3'];
  }
} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}

// Obtener todas las donaciones echas a este evento
try {
  $sql = "SELECT * FROM `donacionusuario` WHERE `id_user` = '$userID'";
  $result = mysqli_query($conn, $sql);
  $infoDonacion = array();

  while ($row = mysqli_fetch_array($result)) {
    $cantidadDonada = $row['cantidad'];
    $user = $row['id_user'];
    $sql_user = "SELECT `usuario` FROM `usuarios` WHERE `ID` = '$user'";
    $result_user = mysqli_query($conn, $sql_user);
    $row_user = mysqli_fetch_array($result_user);
    $nombreDonante = $row_user['usuario'];

    // Almacenar la información en el arreglo $infoDonacion
    $infoDonacion[] = array('nombreDonante' => $nombreDonante, 'cantidadDonada' => $cantidadDonada);
  }

  // Ahora $infoDonacion es un arreglo asociativo con los nombres de usuario como clave
  // y las cantidades donadas como valor.
} catch (Exception $e) {
  // Manejo de excepciones, si es necesario
}


if (isset($_POST['submitDonacion']) && $_POST['submitDonacion'] == "submit") {
  // Obtener los datos enviados por AJAX
  $donacion = $_POST['DonacionUsuario'];

  if ($donacion > $balUser) {
    throw new Exception('No tienes suficiente saldo');
  } else {
    if ($donacion <= 0) {
      $alertDonacion = "No puedes donar 0 o menos";
    } else {
      try {
        $sql = "UPDATE `usuarios` SET `balance` = `balance` - '$donacion' WHERE `ID` = '$userID'";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
          throw new Exception('Error al actualizar el balance del usuario');
        } else {
          // Realizar la actualización en la base de datos
          // Aquí debes incluir tu lógica para actualizar los datos en la base de datos
          $sql = "UPDATE `eventos` SET `fondeado` = `fondeado` + '$donacion' WHERE `id` = '$eventoID'";
          $result = mysqli_query($conn, $sql);
          if ($result) {
            $sql = "INSERT INTO `donacionusuario`(`id`, `cantidad`, `id_user`, `id_evento`) VALUES (UUID(), '$donacion','$userID','$eventoID')";
            $result = mysqli_query($conn, $sql);


            $sql = "SELECT `balance` FROM `usuarios` WHERE `ID` = '$userID'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            $balUser = $row['balance'];
            header("Location: ?id=$eventoID");
            exit();
          }
        }

        // Envía una respuesta al cliente en formato JSON
        mysqli_close($conn);
      } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
      }
    }
    mysqli_close($conn);

  }
}
