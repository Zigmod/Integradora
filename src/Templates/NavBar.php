<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    
    <nav class="fixed bg-[#020726] text-[#fff]  shadow-md flex justify-between items-center z-50 w-full px-6">
      <div class="py-5 text-colorWhite font-bold text-3xl">
        <a href="<?php echo $home . '/home.php'; ?>">
          <span>PaOnde</span>
        </a>
      </div>
      <div>
        <ul class="hidden lg:flex items-center space-x-6 ">
          <li><a href="<?php echo $home . '/home.php'; ?>" class="hover:text-pink-300 ease-in duration-200">Home</a></li>
          <li><a href="#about" class="hover:text-pink-300 ease-in duration-200">About us</a></li>
          <li><a href="<?php  echo $dashboard ?>/DashboardPerfil.php" class="hover:text-pink-300 ease-in duration-200">Dashboard</a></li>
          <li><a href="<?php echo $login . '/login.php'; ?>" class="bg-[#FC87F9] px-9 py-3 rounded-md capitalize font-bold hover:opacity-80 ease-in duration-200">Login</a></li>
          <li><a href="<?php echo $registro . '/registro.php'; ?>" class="bg-[#FC87F9] px-9 py-3 rounded-md capitalize font-bold hover:opacity-80 ease-in duration-200">Register</a></li>
        </ul>

      </div>
      <!--Mobile screen-->
      <div id="hamburguer" class="lg:hidden cursor-pointer">
        <i class="fa-solid fa-bars pr-12"></i>
      </div>
      <div id="menu" class="hidden bg-colorPrimaryDark h-[100vh] absolute inset-0">
        <ul class="h-full grid place-items-center py-20">
          <li><a id="hlink" href="" class="hover:text-pink-300 ease-in duration-200">Home</a></li>
          <li><a id="hlink" href="" class="hover:text-pink-300 ease-in duration-200">About us</a></li>
          <li><a href="<?php  echo $dashboard ?>/DashboardPerfil.php" class="hover:text-pink-300 ease-in duration-200">Dashboard</a></li>
          <li><a href="<?php echo $login . '/login.php'; ?>" class="bg-[#FC87F9] px-9 py-3 rounded-md capitalize font-bold hover:opacity-80 ease-in duration-200">Login</a></li>
          <li><a href="<?php echo $registro . '/registro.php'; ?>" class="bg-[#FC87F9] px-9 py-3 rounded-md capitalize font-bold hover:opacity-80 ease-in duration-200">Register</a></li>
        </ul>
      </div>
    </nav>

    <script>
    // mobile menu
    const hamburguer = document.querySelector('#hamburguer');
    const menu = document.querySelector('#menu');
    const hlink = document.querySelector('#hlink');
    const faSolid = document.querySelector('.fa-solid');

    hamburguer.addEventListener("click", () => {
      menu.classList.toggle('hidden');
      faSolid.classList.toggle('fa-xmark')
    })
    hlink.forEach(link => {
      link.addEventListener('click', () => {
        menu.classList.toggle('hidden');
        faSolid.classList.toggle('fa-xmark');
      })

    });
    //carrusel
  </script>
</body>

</html>