<?php
require("../PHP/Conexion.php");


if (!isset($_SESSION['datos'])) {
    header("Location: ../login/login.php");
}

$userId = $_SESSION['datos']['id'];
$query = "SELECT `imagenDir` FROM `imagenesusuario` WHERE id_user = '$userId'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
if ($row['imagenDir'] == null) {
    $ubicacion = "./../../Public/Images/Usuarios/default.png";
} else {
    $ubicacion = $row['imagenDir'];
}


// Logout logica
if (isset($_POST['submit']) && $_POST['submit'] === 'Cerrar-sesion') {
    session_destroy();
    header("Location: ../home.php");
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>

<body>
    <div class="flex h-screen bg-gray-800 " :class="{ 'overflow-hidden': isSideMenuOpen }">

        <!-- Desktop sidebar -->
        <aside class="z-20 flex-shrink-0 hidden w-60 pl-2 overflow-y-auto bg-gray-800 md:block">
            <div>
                <div class="text-white">
                    <div class="flex p-2  bg-gray-800">
                        <div class="flex py-3 px-2 items-center">
                            <a href="../home.PHP" class="flex flex-row items-center">
                                <img class="h-[35px]" src="../../Public/assets/LogoRyBpaOnde.png">
                                <p class="ml-2 font-semibold italic">
                                    PaOnde</p>
                            </a>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <div class="">
                            <img class="h-24 w-24 rounded-full sm:block object-cover border-4 border-[#f9a8d4]" src="<?php echo $ubicacion ?>" alt="Imagen Usuario" />
                            <p class="font-bold text-base  text-gray-400 pt-2 text-center w-24"><?php echo $_SESSION['datos']['usuario'] ?></p>
                        </div>
                    </div>
                    <!-- botonoes perfil, eventos etc... desktop -->
                    <div>
                        <ul class="mt-6 leading-10">
                            <li class="relative px-2 py-1 ">
                                <a class="mt-4 inline-flex items-center w-full delay-100 hover:border-[#f9a8d4] hover:bg-gray-900 border-2 p-1 rounded-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-[#f9a8d4]" href="./DashboardPerfil.php">
                                    <span class="ml-2">PERFIL</span>
                                </a>
                                <a class="mt-4 inline-flex items-center w-full delay-100 hover:border-[#f9a8d4] hover:bg-gray-900 border-2 p-1 rounded-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-[#f9a8d4]" href="./DashboardActualizacion.php">
                                    <span class="ml-2">ACTUALIZAR INFORMACIÓN</span>
                                </a>
                                <?php
                                if ($_SESSION['datos']['rol'] == 'ADMIN' || $_SESSION['datos']['rol'] == 'CREATOR') {
                                    echo '<a id="CE" class="mt-4 inline-flex items-center w-full delay-100 hover:border-[#f9a8d4] hover:bg-gray-900 border-2 p-1 rounded-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-[#f9a8d4]" href="./DashboardCreacion.php">
                                        <span class="ml-2">CREAR EVENTO</span>
                                    </a>';
                                }
                                ?>
                                <?php
                                if ($_SESSION['datos']['rol'] == 'ADMIN' || $_SESSION['datos']['rol'] == 'CREATOR') {
                                    echo '<a id="CE" class="mt-4 inline-flex items-center w-full delay-100 hover:border-[#f9a8d4] hover:bg-gray-900 border-2 p-1 rounded-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-[#f9a8d4]" href="./DashboardTusEventos.php">
                                        <span class="ml-2">TUS EVENTOS</span>
                                    </a>';
                                }
                                ?>
                                <?php
                                if ($_SESSION['datos']['rol'] == 'ADMIN') {
                                    echo '<a id="CE" class="mt-4 inline-flex items-center w-full delay-100 hover:border-[#f9a8d4] hover:bg-gray-900 border-2 p-1 rounded-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-[#f9a8d4]" href="./DashboardAdmin.php">
                                        <span class="ml-2">ADMIN</span>
                                    </a>';
                                }
                                ?>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </aside>




        <!-- Mobile sidebar -->
        <!-- Backdrop -->
        <div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>

        <aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto  bg-gray-900 dark:bg-gray-800 md:hidden" x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150" x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu" @keydown.escape="closeSideMenu">
            <div>
                <div class="text-white">
                    <div class="flex p-2  bg-gray-800">
                        <div class="flex py-3 px-2 items-center">
                            <p class="ml-2 font-semibold italic">
                                PaOnde</p>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <div class="">
                            <img class="h-24 w-24 rounded-full sm:block object-cover border-4 border-[#f9a8d4]" src="<?php echo $ubicacion ?>" alt="Imagen Usuario" />
                            <p class="font-bold text-base  text-gray-400 pt-2 text-center w-24"><?php echo $_SESSION['datos']['usuario'] ?></p>
                        </div>
                    </div>
                    <!-- botonoes perfil, eventos etc... mobile -->
                    <div>
                        <ul class="mt-6 leading-10">
                        <li class="relative px-2 py-1 ">
                                <a class="mt-4 inline-flex items-center w-full delay-100 hover:border-[#f9a8d4] hover:bg-gray-900 border-2 p-1 rounded-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-[#f9a8d4]" href="./DashboardPerfil.php">
                                    <span class="ml-2">PERFIL</span>
                                </a>
                                <a class="mt-4 inline-flex items-center w-full delay-100 hover:border-[#f9a8d4] hover:bg-gray-900 border-2 p-1 rounded-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-[#f9a8d4]" href="./DashboardActualizacion.php">
                                    <span class="ml-2">ACTUALIZAR INFORMACIÓN</span>
                                </a>
                                <?php
                                if ($_SESSION['datos']['rol'] == 'ADMIN' || $_SESSION['datos']['rol'] == 'CREATOR') {
                                    echo '<a id="CE" class="mt-4 inline-flex items-center w-full delay-100 hover:border-[#f9a8d4] hover:bg-gray-900 border-2 p-1 rounded-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-[#f9a8d4]" href="./DashboardCreacion.php">
                                        <span class="ml-2">CREAR EVENTO</span>
                                    </a>';
                                }
                                ?>
                                <?php
                                if ($_SESSION['datos']['rol'] == 'ADMIN' || $_SESSION['datos']['rol'] == 'CREATOR') {
                                    echo '<a id="CE" class="mt-4 inline-flex items-center w-full delay-100 hover:border-[#f9a8d4] hover:bg-gray-900 border-2 p-1 rounded-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-[#f9a8d4]" href="./DashboardTusEventos.php">
                                        <span class="ml-2">TUS EVENTOS</span>
                                    </a>';
                                }
                                ?>
                                <?php
                                if ($_SESSION['datos']['rol'] == 'ADMIN') {
                                    echo '<a id="CE" class="mt-4 inline-flex items-center w-full delay-100 hover:border-[#f9a8d4] hover:bg-gray-900 border-2 p-1 rounded-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-[#f9a8d4]" href="./DashboardAdmin.php">
                                        <span class="ml-2">ADMIN</span>
                                    </a>';
                                }
                                ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>

        <div class="flex flex-col flex-1 w-full overflow-y-auto">
            <header class="z-40 py-4 bg-gray-800  ">
                <div class="flex items-center justify-between h-8 px-6 mx-auto">
                    <!-- Mobile hamburger -->
                    <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple" @click="toggleSideMenu" aria-label="Menu">
                        <x-heroicon-o-menu class="w-6 h-6 text-white" />
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </button>

                    <!-- Separacion -->
                    <div class="flex justify-center  mt-2 mr-4">
                        <div class="relative flex w-full flex-wrap items-stretch mb-3">

                        </div>
                    </div>

                    <ul class="flex items-center flex-shrink-0 space-x-6">

                        <!-- Profile menu -->
                        <!-- Cerrado de sesion -->
                        <li class="relative">
                            <button class="p-2 bg-white text-green-400 align-middle rounded-full hover:text-white hover:bg-[#f9a8d4] focus:outline-none " @click="toggleProfileMenu" @keydown.escape="closeProfileMenu" aria-label="Account" aria-haspopup="true">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#131313">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            </button>
                            <template x-if="isProfileMenuOpen">
                                <ul x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.away="closeProfileMenu" @keydown.escape="closeProfileMenu" class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-black bg-[#f9a8d4] rounded-md shadow-md" aria-label="submenu">
                                    <li class="flex">
                                        <form method="POST" class="w-full">
                                            <button type="submit" name="submit" value="Cerrar-sesion" class="text-black inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                </svg>
                                                <span>Log out</span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </template>
                        </li>
                    </ul>

                </div>
            </header>
</body>

</html>

<script>
    function data() {

        return {

            isSideMenuOpen: false,
            toggleSideMenu() {
                this.isSideMenuOpen = !this.isSideMenuOpen
            },
            closeSideMenu() {
                this.isSideMenuOpen = false
            },
            isNotificationsMenuOpen: false,
            toggleNotificationsMenu() {
                this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen
            },
            closeNotificationsMenu() {
                this.isNotificationsMenuOpen = false
            },
            isProfileMenuOpen: false,
            toggleProfileMenu() {
                this.isProfileMenuOpen = !this.isProfileMenuOpen
            },
            closeProfileMenu() {
                this.isProfileMenuOpen = false
            },
            isPagesMenuOpen: false,
            togglePagesMenu() {
                this.isPagesMenuOpen = !this.isPagesMenuOpen
            },

        }
    }
</script>