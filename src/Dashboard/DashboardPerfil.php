<?php
include("./config/Datos.php");


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
</head>

<body>
    <?php include_once('../Templates/slideNav.php') ?>
    <main class="">
        <div class="grid mb-4 pb-10 px-8 mx-4 rounded-3xl bg-gray-100 border-4 border-[#f9a8d4]">

            <div class="grid grid-cols-12">
                <div class="grid grid-cols-12 col-span-12 xxl:col-span-9">
                    <div class="col-span-12 mt-8">
                        <div class="flex items-center h-10 w-full text-center intro-y">
                            <h2 class="mr-5 text-lg font-medium truncate">TUS DATOS</h2>
                        </div>
                        <div class="flex flex-col sm:flex-row justify-center sm:items-center mt-5">
                            <!-- Etiqueta de datos USUARIO -->
                            <div class=" transform w-full sm:mr-2 sm:w-[50%] hover:scale-[1.01] transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white">
                                <div class="p-5">
                                    <div class="flex justify-between">
                                        <img src="../../Public/assets/default.png" class="ml-2 h-[30px] w-auto" />
                                        <p class="font-bold sm:text-xl text-md">Usuario</p>
                                        <div class="bg-[#f9a8d4] rounded-full h-6 px-2 flex justify-items-center text-black font-semibold text-sm">
                                            <span class="flex items-center"><?php echo $rol ?></span>
                                        </div>
                                    </div>
                                    <div class="ml-2 w-full flex-1">
                                        <div>
                                            <div class="mt-3 sm:text-2xl text-xl font-bold leading-8"><?php echo $_SESSION['datos']['usuario'] ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Etiqueta de datos BALANCE -->
                            <div class=" transform w-full mt-4 sm:mt-0 sm:ml-2 sm:w-[50%] hover:scale-[1.01] transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white">
                                <div class="p-5">
                                    <div class="flex justify-between">
                                        <img src="../../Public/assets/default.png" class="ml-2 h-[30px] w-auto" />
                                        <p class="font-bold sm:text-xl text-md">Balance</p>
                                        <div class="bg-[#f9a8d4] rounded-full h-6 px-2 flex justify-items-center text-black font-semibold text-sm">
                                            <span class="flex items-center">(MXN)</span>
                                        </div>
                                    </div>
                                    <div class="ml-2 w-full flex-1">
                                        <div>
                                            <div class="mt-3 sm:text-2xl text-xl font-bold leading-8"><?php echo "$" . $balance ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Datos extra en plano -->
                    <div class="col-span-12 mt-5">
                        <div class="flex justify-center items-center w-full">
                            <div class="flex flex-col justify-center items-center gap-4 bg-white shadow-lg h-1/2 p-4 w-full rounded-md" id="chartline">
                                <!-- Datos 1er cuadro plano -->
                                <div class="w-[100%] h-auto rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 bg-white">
                                    <div class="sm:px-8 h-full">
                                        <div class="flex justify-between relative w-auto">
                                            <img src="../../Public/assets/LogoBlack.png" class="h-[25px] sm:h-[50px] w-auto" />
                                            <p class="font-bold sm:text-2xl text-md w-full text-center">Datos generales</p>
                                            <div class="bg-[#f9a8d4] rounded-full h-6 px-2 flex justify-items-center text-black font-semibold text-sm">
                                                <span class="flex items-center"><?php echo $_SESSION['datos']['usuario']; ?></span>
                                            </div>
                                        </div>
                                        <p class="font-bold sm:text-lg text-md w-full text-center mt-2">Nombre(s)</p>
                                        <div class="sm:text-base text-sm h-full truncate font-tiny py-4 px-6">
                                            <div class="w-full shadow-inner bg-gray-100 rounded-full py-[5px] px-6">
                                                <?php echo $nombre ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 2do -->
                                    <div class="sm:px-8 h-full">
                                        <div class="flex justify-between relative w-auto">
                                            <p class="font-bold sm:text-lg text-md w-full text-center">Apellido(s)</p>
                                        </div>
                                        <div class="sm:text-base text-sm h-full truncate font-tiny py-4 px-6">
                                            <div class="w-full shadow-inner bg-gray-100 rounded-full py-[5px] px-6">
                                                <?php echo $apellido ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 3era parte -->
                                    <div class="w-[100%] h-auto rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 bg-white">
                                        <div class="sm:px-8 h-full">
                                            <div class="flex justify-between relative w-auto">
                                                <p class="font-bold sm:text-lg text-md w-full text-center">Correo</p>
                                                <div class="w-full absolute flex justify-end">

                                                </div>
                                            </div>
                                            <div class="sm:text-base text-sm h-full font-tiny py-4 px-6">
                                                <div class="w-full shadow-inner truncate bg-gray-100 rounded-full py-[5px] px-6">
                                                    <?php echo $correo ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- tercera -->
                                    </div>

                                    <!-- Datos 2do cuadro -->
                                    <div class="flex justify-center flex-raw items-center w-[100%] h-auto rounded-lg bg-white">
                                        <div class="flex flex-col w-full sm:flex-row justify-center justify-bete sm:items-center p-6">
                                            <!-- Datos -->

                                            <div class=" w-full rounded-lg flex items-center justify-center">
                                                <div class="w-full md:w-[80%] lg-[70%]">
                                                    <div class="flex justify-between">
                                                        <p class="font-bold sm:text-lg text-md w-full text-center">Tus contribuciones</p>
                                                        <div class="bg-transparent rounded-full h-6 px-2 flex justify-items-center text-black font-semibold text-sm">
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <?php
                                                        if ($condicion === true) {
                                                            echo '<div class="w-full">';
                                                            echo "<div class=' sm:text-xl text-lg font-tiny leading-8 w-full text-center border rounded-md'>Sin Contribuciones</div>";
                                                        } else {
                                                        ?>
                                                            <table class="w-full mt-4">
                                                                <tr class="font-semibold shadow-inner rounded bg-[#f9a8d4]">
                                                                    <th class="w-1/2 rounded-tl-lg p-2">
                                                                        <p class="font-semibold">Evento(s) apoyado</p>
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
                                                                        $nombreEvento = $donacion['nombreEvento'];
                                                                        $cantidadDonada = $donacion['cantidadDonada'];
                                                                        $eventId = $donacion['idEvento'];

                                                                        echo '<tr class="border">';
                                                                        echo '<td class="w-1/2">';
                                                                        echo '<div class="h-full flex w-full h-full text-sm md:text-bases">';
                                                                        echo '<a class="flex-1 p-2 hover:bg-[#cbd5e1]" href="../GestionEventos/GestionEventos.php?id=' . $eventId . '">';
                                                                        echo  $nombreEvento;
                                                                        echo '</a>';
                                                                        echo '</div>';
                                                                        echo '</td>';
                                                                        echo '<td class="w-1/2 border-l text-sm md:text-bases truncate">';
                                                                        echo '<p class="p-2"> $' . $cantidadDonada . '</p>';
                                                                        echo '</td>';
                                                                        echo '</tr>';
                                                                    }
                                                                    ?>
                                                                </table>
                                                            <?php
                                                        }
                                                            ?>
                                                            </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <!-- <div class=" w-full sm:w-1/2 rounded-lg ">
                                                <div class="p-5">
                                                    <div class="flex justify-between">
                                                        <img src="../../Public/assets/LogoBlack.png" class="ml-2 h-[30px] w-auto" />
                                                        <p class="font-bold sm:text-lg text-md w-full text-center">Balance</p>
                                                        
                                                        <div class="bg-[#f9a8d4] rounded-full h-6 px-2 hidden md:flex justify-items-center text-black font-semibold text-sm">
                                                            <span class="flex items-center">(MXN)</span>
                                                        </div>

                                                    </div>
                                                    <div class="ml-2 w-full flex-1">
                                                        <div>
                                                            <div class="mt-3 sm:text-2xl text-xl font-bold leading-8"><?php echo "$" . $balance ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    </div>
    </div>

</body>

</html>