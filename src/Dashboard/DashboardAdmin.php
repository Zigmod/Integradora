<?php
session_start();
require("../PHP/Conexion.php");

if (!isset($_SESSION['datos']) && $_SESSION['datos']['rol'] != 'admin') {
    header("Location: ../login/login.php");
}


$userId = $_SESSION['datos']['id'];



?>


<!-- component -->
<!DOCTYPE html>
<html x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <!-- Favicon -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


    <style>
        .swiper-container {
            max-width: 350px;
            max-height: 350px;
            overflow: hidden;
        }

        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            object-fit: cover;
        }

    </style>


</head>

<body>
    <?php include_once('../Templates/slideNav.php') ?>
    <div class="">
        <div class="grid mb-4 pb-10 px-8 mx-4 rounded-3xl bg-gray-100 border-4 border-[#f9a8d4]">
            <div class="grid grid-cols-12">
                <div class="grid grid-cols-12 col-span-12 xxl:col-span-9">
                    <div class="col-span-12 mt-8">
                        <div class="flex items-center h-10 intro-y">
                            <h2 class="mr-5 text-lg font-medium truncate">Todos los eventos</h2>
                        </div>
                    </div>
                    <!-- Datos extra en plano -->
                    <div class="col-span-12 mt-5">
                        <div class="flex justify-center items-center">
                            <div class="bg-white shadow-lg p-4 w-full rounded-md" id="chartline">
                                <div class="h-full w-full grid content-center justify-center grid-cols-1 lg:grid-cols-2 gap-4">
                                    <?php
                                    // Supongamos que ya tienes la conexión a la base de datos establecida.

                                    // Realizar la consulta SQL para obtener los eventos
                                    $sql = "SELECT * FROM eventos";
                                    $result = mysqli_query($conn, $sql);


                                    // Verificar si hay resultados
                                    if (mysqli_num_rows($result) > 0) {
                                        // Recorrer los resultados y generar las tarjetas HTML
                                        while ($row = mysqli_fetch_assoc($result)) {

                                            $eventId = $row['id'];

                                            $titulo = $row['titulo'];
                                            $descripcion = $row['descrip'];
                                            $ubicacion = $row['ubicacion'];
                                            $IdCreador = $row['id_creador'];

                                            $sqlCreador = "SELECT `usuario` FROM `usuarios` WHERE ID = '$IdCreador'";
                                            $creador = mysqli_query($conn, $sqlCreador);
                                            if ($creador) {
                                                $creador = mysqli_fetch_assoc($creador);
                                                $IdCreador = $creador['usuario'];
                                            }
                                            // ... Otros campos del evento que quieras mostrar en la tarjeta ...
                                            $sqlIMG = "SELECT * FROM `imageneseventos` where `id_evento` = '$eventId'";
                                            $img = mysqli_query($conn, $sqlIMG);
                                            $images = array();

                                            while ($imgRow = mysqli_fetch_assoc($img)) {
                                                $images[] = $imgRow['imagenDir_1'];
                                                $images[] = $imgRow['imagenDir_2'];
                                                $images[] = $imgRow['imagenDir_3'];
                                            }
                                            // Generar la tarjeta HTML con la información del evento

                                            echo '<div class="flex items-center justify-center">
                                            <div class="rounded overflow-hidden border w-[90%] md:w-[100%] bg-white">
                                            <a class="w-auto" href="../GestionEventos/GestionEventos.php?id=' . $eventId . '">
                                                <div class="w-full flex justify-between p-3">
                                                  <div class="flex">
                                                    <div class="rounded-full h-8 w-8 bg-white flex items-center justify-center overflow-hidden">
                                                        <img class="object-cover" src="./img/LogoBlack.png" alt="Imagen del evento"/>                                                
                                                    </div>
                                                    <span class="pt-1 ml-2 font-bold text-sm">' . $titulo . '</span>
                                                  </div>
                                                </div>';
                                            if ($images == NULL) {

                                                echo '<div class="h-[320px] rounded-md flex shadow-inner justify-center items-center">';
                                                echo '<img class="w-auto h-full object-cover" src="./img/LogoBlack.png" alt="Imagen del evento"/>';
                                                echo '</div>';
                                            } else {

                                                echo '<div class="h-[320px] grid content-center w-full justify-center">
                                                    <div class="swiper-container  cursor-pointer flex justify-center items-center rounded-md" id="swiper-container-' . $eventId . '">
                                                    <div class="swiper-wrapper">';
                                                foreach ($images as $imgSrc) {
                                                    echo '<div class="swiper-slide h-[320px]">
                                                            <img class="w-full h-full bg-cover no-select rounded-md px-1" src="' . $imgSrc . '" alt="Imagenes del evento"/>
                                                        </div>';
                                                }
                                                echo '</div>
                                                    </div>
                                                    </div>';
                                            }
                                            echo '<div class="px-3 pb-2">
                                                  <div class="pt-2">
                                                  </div>
                                                  <div class="pt-1">
                                                    <div class="mb-2 text-sm line-clamp-4">
                                                      <span class="font-bold mr-2 "> DESCRIPCION: </span> ' . $descripcion . '
                                                    </div>
                                                  </div>
                                                  <div class="mb-2">
                                                    <div class="mb-2 text-sm">
                                                      <span class="font-bold mr-2">UBICACION:</span> ' . $ubicacion . '
                                                    </div>
                                                  </div>
                                                </div>
                                                </a>
                                              </div>';
                                            echo '</div>';
                                        }
                                    } else {
                                        // Si no hay resultados, mostrar un mensaje o realizar alguna otra acción.
                                        echo 'No se encontraron eventos.';
                                    }

                                    // Cerrar la conexión a la base de datos
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Obtener todos los contenedores del slider y recorrerlos para inicializarlos individualmente
            var swiperContainers = document.querySelectorAll('[id^="swiper-container-"]');
            swiperContainers.forEach(function(container) {
                var eventId = container.id.replace('swiper-container-', ''); // Obtener el ID del evento a partir del atributo id
                var swiper = new Swiper("#" + container.id, {

                    loop: true, // Agregamos el loop (bucle)
                    autoplay: {
                        delay: 5000, // Autoplay con un delay de 5 segundos
                    },
                    // Configura las opciones del Swiper según tus necesidades
                    // Por ejemplo, puedes configurar la dirección del desplazamiento, la velocidad, la paginación, etc.
                    on: {
                        init: function() {
                            // Mostrar las imágenes iniciales
                            showImages(this.slides);
                        },
                        resize: function() {
                            // Recalcular y mostrar las imágenes cuando cambie el tamaño de la ventana
                            showImages(this.slides);
                        },
                    },
                });

            });

            function showImages(slides) {
                // Recorrer todos los slides y mostrar las imágenes dentro del viewport del slider
                slides.forEach(function(slide) {
                    var img = slide.querySelector("img");
                    if (isElementInViewport(slide)) {
                        img.style.opacity = 1;
                    }
                });
            }

            function isElementInViewport(element) {
                var rect = element.getBoundingClientRect();
                return rect.top >= 0 && rect.bottom <= (window.innerHeight || document.documentElement.clientHeight);
            }
        });
    </script>




</body>

</html>