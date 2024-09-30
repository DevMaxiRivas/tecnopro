// Obtén una lista de todas las referencias a los interruptores
const interruptores = document.querySelectorAll('.miInterruptor');
// Cambia el estado del interruptor dependiendo de su estado
interruptores.forEach(interruptor => {
  if (interruptor.value == 1) {
    interruptor.checked = true;
  } else {
    interruptor.checked = false;
  }
}); 


//CAMBIA EL ESTADO EN LA BASE DE DATOS
$(document).on('click', '.miInterruptor', function (e) {
  // Evitar que el checkbox se marque o desmarque
  e.preventDefault();
  var changeId = $(this).data('change-id');
  let switchClickeado = $(this);

  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-primary mx-2',
      cancelButton: 'btn btn-danger mx-2'
    },
    buttonsStyling: false
  })

  swalWithBootstrapButtons.fire({
    title: '¿Cambiar Estado?',
    /* text: "¿Seguro? ¡Esta accion no se puede revertir!", */
    type: 'question',
    showCancelButton: true,
    confirmButtonText: 'Cambiar estado!',
    cancelButtonText: 'Cerrar',
    reverseButtons: false
  }).then((result) => {
    if (result.value) {

      $.ajax({
        url: cambiarEstadoUrl,
        type: 'POST',
        data: {
          _token: token,
          _id: changeId
        },
        success: function (response) {
          // Maneja la respuesta exitosa, actualiza la interfaz de usuario, si es necesario.
          // Alternar el estado del checkbox
          switchClickeado.prop('checked', !switchClickeado.prop('checked'));
          console.log(response.message);
        },
        error: function (xhr) {
          // Maneja errores, si es necesario.
          var errors = xhr.responseJSON;
          console.log(errors.error);
        }
      })

      /* .then(response => {
       swalWithBootstrapButtons.fire(
         'Actualizado',
         'El estado fue cambiado con exito! ',
         'success'
       )
       
     })  */


    } else (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    )

  })
});

