<?php
session_start();
require("../PHP/Conexion.php");

if (!isset($_SESSION['datos'])) {
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
                            <h2 class="mr-5 text-lg font-medium truncate">TUS EVENTOS</h2>
                        </div>
                    </div>
                    <!-- Datos extra en plano -->
                    <div class="col-span-12 mt-5">
                        <div class="flex justify-center items-center">
                            <div class="bg-white shadow-lg p-4 w-full rounded-md" id="chartline">
                                <div class="h-full w-full grid content-center justify-center grid-cols-1 lg:grid-cols-2 gap-4">
                                    <?php
                                    include('./config/VizualEventos.php')
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
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

</html>