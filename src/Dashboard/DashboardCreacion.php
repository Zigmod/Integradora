<?php


include("./config/creacionEvento.php");

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
                        <div class="flex items-center h-10 intro-y">
                            <h2 class="mr-5 text-lg font-medium truncate">CREA TU PROPUESTA</h2>
                        </div>
                    </div>
                    <!-- Datos extra en plano -->
                    <div class="col-span-12 mt-5">
                        <div class="flex justify-center items-center">
                            <div class="bg-white shadow-lg p-4 w-full rounded-md flex justify-center items-center" id="chartline">
                                <div class="h-full w-[400px] flex justify-center items-center">

                                    <form method="post" enctype="multipart/form-data">
                                        <label class="font-semibold">Nombra tu evento</label>
                                        <input type="text" name="titulo" placeholder="Nombre del evento (TITULO)" class="w-full border-2 border-gray-300 p-2 rounded-xl mb-3" required>
                                        <label class="font-semibold">Descripción</label>
                                        <textarea name="descripcion" placeholder="Descripción del evento" class="w-full border-2 border-gray-300 p-2 rounded-xl mb-3" required></textarea>
                                        <label class="font-semibold">Ubicación</label>
                                        <input type="text" name="ubicacion" placeholder="Ubicación del evento" class="w-full border-2 border-gray-300 p-2 rounded-xl mb-3" required>
                                        <label class="font-semibold">Fecha de inicio</label>
                                        <input type="date" name="fechaInicio" placeholder="Fecha de inicio" class="w-full border-2 border-gray-300 p-2 rounded-xl mb-3" required>
                                        <label class="font-semibold">Fecha de finalización</label>
                                        <input type="date" name="fechaFin" placeholder="Fecha de finalización" class="w-full border-2 border-gray-300 p-2 rounded-xl mb-3" required>
                                        <label class="font-semibold">Primera Imagen</label>
                                        <input type="file" name="imagen1" placeholder="Imagen 1" class="w-full border-2 border-gray-300 p-2 rounded-xl mb-3" required>
                                        <label class="font-semibold">Segunda Imagen</label>
                                        <input type="file" name="imagen2" placeholder="Imagen 2" class="w-full border-2 border-gray-300 p-2 rounded-xl mb-3" required>
                                        <label class="font-semibold">Tercera Imagen</label>
                                        <input type="file" name="imagen3" placeholder="Imagen 3" class="w-full border-2 border-gray-300 p-2 rounded-xl mb-3" required>

                                        <label class="font-semibold">Meta de fondeo</label>
                                        <input type="number" name="meta" placeholder="Meta de fondeo" class="w-full border-2 border-gray-300 p-2 rounded-xl mb-3" required>

                                        <button type="submit" value="crearEvento" name="submit" class="bg-[#f9a8d4] hover:bg-rose-300 text-white p-2 rounded-xl w-full">Crear</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 mt-5">
                        <div class="grid gap-2 grid-cols-1 lg:grid-cols-1">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


</body>

</html>