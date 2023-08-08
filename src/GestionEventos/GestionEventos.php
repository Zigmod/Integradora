<?php
require('./config/DatosEvento.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PaOnde</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="./config/script.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        colorPrimary: '#01051e',
                        colorPrimaryLight: '#020726',
                        colorPrimaryDark: '#010417',
                        colorSecondary: '#FC87F9',
                        colorGray: '#333',
                        colorWhite: '#fff',
                        colorBlob: '#A427DF',
                        colorBg: '#F8850B'
                    },
                }
            }
        }
    </script>
    <style>
        @import url(https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css);

        .swiper-container {
            max-width: 500px;
            max-height: 500px;
            overflow: hidden;
            border: #F8850B 5px solid;
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

        .swiper-pagination {
            font: bold;
            color: #fff;
        }

        #barra-progreso {
            width: 100%;
            background-color: #f1f1f1;
            text-align: center;
            color: black;
        }

        #barra-progreso .progreso {
            width: <?php echo $progreso; ?>;
            height: 10px;
            background-color: #F8850B;
            text-align: center;
            line-height: 30px;
        }
    </style>
</head>

<body>
    <?php
    require_once('../Templates/NavBar.php');
    ?>

    <!-- component -->
    <!-- <div class="w-full rounded bg-white shadow-xl p-10 pt-15 text-gray-800 md:text-left"> -->

    <div class=" flex flex-col md:flex-row items-center justify-center">

        <div class="bg-[#01051e] w-full py-12 h-auto md:h-screen flex flex-col md:flex-row items-center justify-center">

            <div class="z-0 w-80 h-80 bg-colorBlob absolute top-0 -left-5 blur-2xl opacity-30 overflow-hidden rounded-full"></div>
            <div class="z-0 w-80 h-80 bg-colorBg absolute bottom-10 right-0 blur-2xl opacity-30 overflow-hidden rounded-full"></div>

            <div class="w-full flex items-center justify-center">
                <div class="relative w-full">

                    <?php
                    if ($images == NULL) {

                        echo '<div class=" rounded-md flex shadow-inner justify-center items-center">';
                        echo '<img class="w-auto h-full object-cover" src="./../../Public/assets/LogoBlack.png" alt="Imagen del evento"/>';
                        echo '</div>';
                    } else {
                        echo '<div class=" grid content-center w-full justify-center pt-14 px-4">
                            <div class="swiper-container cursor-pointer flex justify-center items-center rounded-md" id="swiper-container-' . $eventoID . '">
                            <div class="swiper-wrapper">';
                        foreach ($images as $imgSrc) {
                            echo '<div class="swiper-slide ">
                                    <img class="w-full h-full bg-cover no-select rounded-md" src="' . $imgSrc . '" alt="Imagenes del evento"/>
                                </div>';
                        }
                        echo '  </div>
                                    </div>
                                    </div>';
                    }
                    ?>
                </div>
            </div>

            <div class="w-full h-full px-4 lg:px-10 lg:mr-4 text-[#fff] flex flex-col justify-center z-10">
                <h1 class="font-bold uppercase text-lg md:text-xl lg:text-2xl my-5 text-center"><?php echo $titulo; ?></h1>
                <div>
                    <!-- Barra de carga -->
                    <div id="barra-progreso" class="inline-block w-full align-bottom rounded">
                        <div id="progreso" class="progreso rounded" style="width: <?php echo $progreso; ?>%;">
                        </div>
                    </div>
                </div>

                <div class="mb-10 ">
                    <div class="w-full flex flex-col justify-items-start place-items-start mt-4">
                        <div class="">
                            <p class="md:text-xl lg:text-2xl font-bold text-colorBg"><?php echo  $fondeado . '$' ?></p>
                        </div>
                        <div class="text-slate-500">
                            <p>contribuido de <?php echo $metaFondeo . '$' ?></p>
                        </div>


                    </div>
                </div>

                <div>
                    <!-- Donaciones -->
                    <form class="" method="POST">
                        <div class="w-full flex justify-center items-center">
                            <input id="DonacionUsuario" name="DonacionUsuario" type="number" min="0" max="<?php echo $balUser; ?>" placeholder="Tu balance: <?php echo $balUser; ?>" class="w-[35%] rounded-md border py-2 text-center text-black" />
                        </div>
                        <div class="font-tiny text-rose-600">
                            <?php echo $alertDonacion; ?>
                        </div>
                        <div class="w-full flex justify-center p-2 mt-4">
                            <button name="submitDonacion" value="submit" type="submit" class=" bg-yellow-300 hover:bg-yellow-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center w-full">
                                <span class="w-full text-center">Donar</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Segunda -->
    <div class="mt-10 w-full flex gap-4 md:flex-row flex-col-reverse p-8">
        <div class="shadow-inner w-full md:w-1/2 p-4">
            <div>
                <h1 class="font-semibold text-2xl mb-5">Descripcion</h1>
            </div>
            <div>
                <p class="text-justify">
                    <?php echo $descripcion; ?>
                </p>
            </div>
        </div>
        <div class="w-full md:w-1/2">
            <div class="py-4 px-2 flex h-auto w-full border border-gray justify-center items-center rounded">
                <div class="w-[10%] mx-2">
                    <img class=" h-[35px] w-auto" src="../../Public/assets/ubi.svg" />
                </div>
                <p class="ml-6 w-[90%]">
                    <?php echo $ubicacion; ?>
                </p>
            </div>
            <div class="py-4 mt-4 px-2 flex h-auto w-full border border-gray justify-center items-center rounded">
                <div class="w-[10%] mx-2">
                    <img class=" h-[35px] w-auto" src="../../Public/assets/calendar.svg" />
                </div>
                <p class="ml-6 w-[90%]">
                    Fecha inicio del evento: <?php echo $fechaInicio; ?>
                </p>
            </div>
            <div class="py-4 mt-4 px-2 flex flex-col h-auto w-full border justify-center items-center rounded">
                <table class="w-full text-center">
                    <tr class="font-semibold shadow-inner rounded bg-colorBg">
                        <th class="w-1/2 rounded-tl-lg p-2">
                            <p class="font-semibold">Donante</p>
                        </th>
                        <th class="w-1/2 rounded-tr-lg p-2">
                            <p class="font-semibold">Cantidad (MXN)</p>
                        </th>
                    </tr>
                </table>
                <div class="w-full h-[350px] overflow-y-scroll">
                    <table class="w-full text-center">
                        <?php
                        foreach ($infoDonacion as $donacion) {
                            $nombreDonante = $donacion['nombreDonante'];
                            $cantidadDonada = $donacion['cantidadDonada'];
                            echo '<tr class="border-b">';
                            echo '<td class="w-1/2">';
                            echo '<p>' . $nombreDonante . '</p>';
                            echo '</td>';
                            echo '<td class="w-1/2">';
                            echo '<p>' . $cantidadDonada . '</p>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <!-- </div> -->

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
            var paginationElement = document.createElement("div");
            paginationElement.classList.add("swiper-pagination");
            container.appendChild(paginationElement);
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