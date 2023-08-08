<?php
// Supongamos que ya tienes la conexión a la base de datos establecida.
require("../PHP/Conexion.php");

// Realizar la consulta SQL para obtener los eventos
$sql = "SELECT * FROM eventos WHERE id_creador = '$userId'";
$result = mysqli_query($conn, $sql);


// Verificar si hay resultados
if (mysqli_num_rows($result) > 0) {
    // Recorrer los resultados y generar las tarjetas HTML

    while ($row = mysqli_fetch_assoc($result)) {

        $eventId = $row['id'];

        $titulo = $row['titulo'];
        $descripcion = $row['descrip'];
        $ubicacion = $row['ubicacion'];
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
    echo '<div class="flex flex-col jusity-center items-center w-full h-full  bg-transparent rounded-md p-4 gap-4">';
    echo '<img src="./img/LogoBlack.png" alt="Logo" class="w-[400px] h-auto"/>';
    echo 'No se encontraron eventos.';
    echo '</div>';
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
