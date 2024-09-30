$(document).on('click', '.btnEliminar', function() {
    let pedidoId = $(this).val();

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-danger mx-2',
          cancelButton: 'btn btn-secondary mx-2'
        },
        buttonsStyling: false
      })
      
      swalWithBootstrapButtons.fire({
        title: '¿Cancelar Pedido?',
        text: "¿Seguro? ¡Esta accion no se puede revertir!",
        type: 'question',
        showCancelButton: true,
        confirmButtonText: 'Si, cancelar pedido!',
        cancelButtonText: 'Cerrar',
        reverseButtons: false
      }).then((result) => {
        let urlDeCancelarPedido = rutaParaCancelarPedido + "/" + pedidoId;
        if (result.value) {
            console.log(urlDeCancelarPedido);
            fetch(urlDeCancelarPedido, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },

            })
                .then(response => {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'El pedido fue cancelado con exito! ',
                        'success'
                      )
                        location.reload()
                })

                .catch(error => {
                    console.error('Error:', error);
                });
            
        } else  (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        )
      })

            //$.post(base_url + 'deleteUser.php', data, function(response) {
                /* alert(response.message);  */
        //Swal.fire(
                   // 'Eliminado!',
                    //response.message,
                   // 'success'
                  //) 
               // user_id = null; // reseteamos la variable que guardaba el id
                //table.ajax.reload(null, false); // actualizamos la tabla
           // }) 

    
});