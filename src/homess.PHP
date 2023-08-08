<?php 
session_start(); 

$login = './login';
$registro = './registro';
$dashboard = './dashboard';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Paonde</title>
  <link rel="stylesheet" href="./style.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <?php 
      require_once('./Templates/NavBar.php');
    ?>


  <div class="WorkArea">


    <?php
    if (isset($_SESSION['datos'])) {
      echo $_SESSION['datos']['id'];
    }
    ?>

  </div>


  <footer>

  </footer>

</body>

</html>