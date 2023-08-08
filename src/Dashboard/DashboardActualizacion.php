<?php
include("./config/Actualizaciones.php");

if (!isset($_SESSION['datos'])) {
    header("Location: ../login/login.php");
}

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
                            <h2 class="mr-5 text-lg font-medium truncate">ACTUALIZA TU INFORMACIÓN</h2>
                        </div>
                    </div>
                    <!-- Datos extra en plano -->
                    <div class="col-span-12 mt-5">
                        <div class="flex justify-center items-center">
                            <div class="bg-white shadow-lg p-4 w-full rounded-md flex justify-center items-center" id="chartline">
                                <div class="h-auto w-[400px] flex flex-col justify-center items-center">
                                    <p class="font-bold">Ingresa solo los valores que deseas cambiar</p>
                                    

                                    <form class="shadow-md rounded-md py-8 px-8" method="post" enctype="multipart/form-data">

                                        <h1 class="title w-full text-center font-bold">Actualizar</h1>
                                        <label>Usuario</label>
                                        <input type="text" placeholder="Actualiza tu nuevo usuario" name="usuario" class="w-full border-2 border-gray-300 p-2 rounded-md mb-1">

                                        <label>Contraseña</label>
                                        <input type="password" placeholder="Actualiza tu nueva contraseña" name="contra" class="w-full border-2 border-gray-300 p-2 rounded-md mb-1">

                                        <label>Correo</label>
                                        <input type="email" name="correo" placeholder="Actualiza tu correo" class="w-full border-2 border-gray-300 p-2 rounded-md mb-1">

                                        <div class="font-bold text-center text-green-500">
                                            <?php echo $alert ?>
                                        </div>
                                        <div class="font-bold text-center text-rose-600">
                                            <?php echo $alertX ?>
                                        </div>

                                        <div class="w-full flex justify-center py-2">
                                            <button type="submit" class="rounded-full shadow-md cursor-pointer hover:scale-[1.1] transition duration-300 px-4 py-2" name="submit" value="Actualizar">Actualizar</button>
                                        </div>

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