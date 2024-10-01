//CAMBIA EL ESTADO EN LA BASE DE DATOS
$(document).on('click', '.agregarAlCarrito', function () {
  var agregarId = $(this).data('agregar-id');

  if (!clienteId) {
    window.location.href = "/login";
  }

  console.log(agregarId);
  $.ajax({
    url: rutaParaAgregar,
    type: 'POST',
    data: {
      _token: token,
      _id: agregarId
    },
    success: function (response) {
      // Maneja la respuesta exitosa, actualiza la interfaz de usuario, si es necesario.
      fetch(rutaContarItemsCarrito)
        .then(response => {
          // Verificar si la solicitud fue exitosa (código de respuesta 200)
          if (!response.ok) {
            throw new Error('Error al obtener los datos de la API');
          }
          // Parsear la respuesta JSON
          return response.json();
        })
        .then(data => {
          // Hacer algo con los datos obtenidos
          let cant_carrito = document.querySelector("#cant_carrito");
          cant_carrito.innerHTML = data;
          console.log('Items en carrito:', data);
        })
        .catch(error => {
          // Capturar errores durante el proceso
          console.error('Error:', error);
        });

      if (response.message == 'No hay mas stock del producto') {
        toastr.options = {
          "closeButton": true,
          "debug": true,
          "newestOnTop": false,
          "progressBar": true,
          "positionClass": "toast-bottom-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "2500",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut",

          onclick: function () {
            // La función que se ejecutará al hacer clic en la notificación
            window.location.href = "/carrito";// Me lleva al carrito
          }
        }

        toastr["warning"](response.message)

        
      } else {

        toastr.options = {
          "closeButton": true,
          "debug": false,
          "newestOnTop": false,
          "progressBar": true,
          "positionClass": "toast-bottom-right",
          "preventDuplicates": false,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "2500",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut",

          onclick: function () {
            // La función que se ejecutará al hacer clic en la notificación
            window.location.href = "/carrito";// Me lleva al carrito
          }
        }

        toastr["success"](response.message)
      }

      console.log(response.message);
    },
    error: function (xhr) {
      // Maneja errores, si es necesario.
      var errors = xhr.responseJSON;
      console.log(errors.error);
    }
  });
});
