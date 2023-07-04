<?php 

require("Conexion.php");

    $User = $_POST['usuario'];
    $contra = $_POST['contra'];

    

    $sql = "SELECT * FROM `login` WHERE `usuario` = '$User' AND `contra` = AES_DECRYPT('$contra', 'contra2.0')";
    $res = mysqli_query($conn, $sql);

    $fila = mysqli_num_rows($res);

    if($fila){
        header("location: ../home.html");
    } else {
        include("../login/login.html");
        ?>
        <script>
            alert("Usuario o contraseña incorrectos");
        </script>
        <?php 
    }

    mysqli_free_result($res);
    mysqli_close($conexion);

?>