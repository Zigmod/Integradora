<?php
session_start();

$login = './login';
$registro = './registro';
$dashboard = './dashboard';
$home = '.';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../Landing/landing.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="../Landing/landing.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>

  <!--Colores predeterminados-->
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
        },
        //*La propiedades del container de la nav estan aqui
        container: {
          center: true,
          padding: {
            DEFAULT: '20px',
            md: "50px",
          }
        }
      }
    }
  </script>
  <title>PAONDE</title>
</head>

<body class="bg-colorPrimary text-colorWhite tracking-wider">
  <header>
    <?php require_once('./Templates/NavBar.php'); ?>
  </header>

  <main>
    <section id="home" class="">
      <div class="w-80 h-80 bg-colorBlob absolute top-0 -left-5 -z-10 blur-2xl opacity-30 overflow-hidden rounded-full"></div>
      <div class="w-80 h-80 bg-colorBg absolute bottom-10 right-0 -z-10 blur-2xl opacity-30 overflow-hidden rounded-full"></div>
      <div class="container py-20">
        <div class="flex flex-col items-center md:flex-row">
          <div class="text-center mb-12 md:text-left md:w-1/2 md:pr-10">
            <h1 class="text-3xl md:text-4xl font-bold leading-snug mb-4">Make Your Dream Event a Reality with Our Crowdfunding Platform!</h1>
            <p class="leading-relaxed mb-10">Fund, Create, and Attend Extraordinary Events.</p>
            <button class="bg-colorSecondary px-9 py-3 rounded-md capitalize font-bold hover:opacity-80 ease-in duration-200">Get Started</button>
          </div>
          <div class="md:w-1/2 pointer-events-none">
            <img src="./../Public/assets/pigyBank.svg" alt="">
          </div>
        </div>
      </div>
    </section>

    <section id="benefits" class="bg-colorPrimaryLight">
      <div class="container py-20">
        <div class="text-center m-auto mb-20 md:w-1/2">
          <h1 class="text-3xl md:text-4xl font-bold leading-snug mb-4">Benefits with Our Platform</h1>
        </div>

        <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-12 lg:gap-8 px-4 sm:px-6 lg:px-8">
          <!--cartas-->
          <div class="border-2 border-solid border-colorGray text-center py-20 px-5 rounded-2xl cursor-default hover:bg-colorPrimaryDark ease-in duration-200">
            <div class=" inline-block rounded-2xl py-5 px-6">
              <i class="fa-solid fa-money-bill-wave text-4xl"></i>
            </div>
            <h3 class="text-colorBg text-xl font-bold py-4">Financial support</h3>
            <p class="leading-relaxed ">Get the necessary financial support for your event.</p>
          </div>
          <div class="border-2 border-solid border-colorGray text-center py-20 px-5 rounded-2xl cursor-default hover:bg-colorPrimaryDark ease-in duration-200">
            <div class=" inline-block rounded-2xl py-5 px-6">
              <i class="fa-solid fa-gear text-4xl"></i>
            </div>
            <h3 class="text-colorBg text-xl font-bold py-4">Events your way</h3>
            <p class="leading-relaxed ">Create personalized events and manage all the details.</p>
          </div>
          <div class="border-2 border-solid border-colorGray text-center py-20 px-5 rounded-2xl cursor-default hover:bg-colorPrimaryDark ease-in duration-200">
            <div class=" inline-block rounded-2xl py-5 px-6">
              <i class="fa-solid fa-magnifying-glass text-4xl"></i>
            </div>
            <h3 class="text-colorBg text-xl font-bold py-4">Discover magical events</h3>
            <p class="leading-relaxed ">Discover and attend incredible events organized by others</p>
          </div>
        </div>
      </div>
    </section>






  </main>







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