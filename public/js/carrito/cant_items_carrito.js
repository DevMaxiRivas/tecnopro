// Utilizar la función fetch para hacer la solicitud GET a la API
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