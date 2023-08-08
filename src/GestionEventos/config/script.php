<script>

const metaFondeo = <?php echo $metaFondeo; ?>;
const fondeado = <?php echo $fondeado; ?>;

// Función para actualizar el ancho de la barra de carga
function actualizarBarraDeCarga() {
    const filler = document.getElementById('progreso');

    // Obtén el valor de progreso desde PHP
    const porcentajeRellenado = <?php echo $progreso; ?>;

    // Establece el ancho del rellenado en función del porcentaje
    filler.style.width = porcentajeRellenado + '%';

    // Puedes agregar aquí otras actualizaciones o animaciones según sea necesario.
}

// Llama a la función una vez al cargar la página
actualizarBarraDeCarga();


function enviarValor() {
      const inputValue = document.getElementById('DonacionUsuario').value;

      // Realizar aquí la lógica para enviar el valor (por ejemplo, a través de una solicitud AJAX o una redirección de página)
      // ...

      // Limpiar el campo de entrada después del envío
      document.getElementById('DonacionUsuario').value = '';
    }

</script>