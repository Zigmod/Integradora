<?php
                                    // Supongamos que ya tienes la conexión a la base de datos establecida.

                                    // Realizar la consulta SQL para obtener los eventos
                                    $sql = "SELECT * FROM eventos";
                                    $result = mysqli_query($conn, $sql);
                                    $images = array();


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

                                            while ($imgRow = mysqli_fetch_assoc($img)) {
                                                $images[$eventId][] = $imgRow['imagenDir_1'];
                                                $images[$eventId][] = $imgRow['imagenDir_2'];
                                                $images[$eventId][] = $imgRow['imagenDir_3'];
                                            }
                                            // Generar la tarjeta HTML con la información del evento
                                            echo '<div class="flex flex-col jusity-center items-center w-[65%] md:w-[45%] shadow bg-transparent hover:bg-gray-100 transition duration-300 rounded-md p-12 gap-8">';
                                            echo '<h2 class="w-full font-bold text-xl text-center">' . $titulo . '</h2>';

                                            echo '<div class="relative h-auto w-full">';

                                            // Recorrer el array de imágenes y mostrarlas en la tarjeta
                                            if ($images == NULL) {
                                                echo '<div class=" rounded-md">';
                                                echo '<img class="w-auto h-full" src="./img/LogoBlack.png" alt="Imagen del evento"/>';
                                                echo '</div>';
                                            } else {
                                                //Esto tengo que tener dentro del slider CHATTTT
                                                ?>
                                                <div x-data="imageSlider" class="w-[100%] relative mx-auto max-w-2xl overflow-hidden rounded-md p-2 sm:p-4">;
                                                <?php
                                                echo '<button @click="previous()" class="absolute text-gray-600  hover:text-gray-200 transition duration-300 left-0 top-1/2 z-10 flex h-full w-10 -translate-y-1/2 items-center justify-center rounded-full">';
                                                echo ' <i class="fas fa-chevron-left text-xl font-bold "></i>';
                                                echo ' </button>';

                                                echo ' <button @click="forward()" class="absolute text-gray-600  hover:text-gray-200 transition duration-300 right-0 top-1/2 z-10 flex h-full w-10 -translate-y-1/2 items-center justify-center rounded-full">';
                                                echo ' <i class="fas fa-chevron-right text-xl font-bold "></i>';
                                                echo ' </button>';

                                                echo '<div class="w-full flex items-center justify-center h-60">';
                                                echo ' <template x-for="(image, index) in images[' . $eventId . ']">';
                                                echo '  <div x-show="currentIndex == index + 1" x-transition:enter="transition transform duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition transform duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute">';
                                                echo '    <img :src="image" alt="image" class="rounded-sm w-[250px] h-auto" />';
                                                echo '  </div>';

                                                echo '  </template>';
                                                echo '  </div>';
                                                echo '</div>';
                                            }
                                            echo '</div>';

                                            echo '<p class="w-full truncate">' . $descripcion . '</p>';
                                            echo '<p class="w-full">Ubicación: ' . $ubicacion . '</p>';
                                            // ... Agregar más información del evento en la tarjeta si es necesario ...
                                            echo '</div>';
                                        }
                                    } else {
                                        // Si no hay resultados, mostrar un mensaje o realizar alguna otra acción.
                                        echo 'No se encontraron eventos.';
                                    }
                                    // Cerrar la conexión a la base de datos
                                    ?>