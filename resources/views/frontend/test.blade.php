<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @if (session('alert'))
        <div class="containter-fluid mb-3 p-0">

            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('alert') }}
                </div>
            </div>

        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Test Compra</h1>
                <form action="{{ route('carrito.comprar') }}" method="post" id="miFormulario"></form>
                @csrf
                <div class="form-group">
                    <label for="id_venta"></label>
                    <input type="numbre" name="id_venta" id="id_venta">
                </div>
                <input type="submit" value="Comprar">
            </div>
        </div>
    </div>

    <script>
        // Verificar si hay una URL de redirección adicional
        var redirectUrl = '{{ session('redirectUrl') }}';

        if (redirectUrl) {
            // Redirigir al usuario a la URL adicional
            window.location.href = redirectUrl;
            //window.open(redirectUrl, '_blank'); Por si quiero abrirlo en otra pestaña
        }
        // Display an info toast with no title
    </script>

    <script>
        document.getElementById("miFormulario").addEventListener("submit", function(event) {
            event.preventDefault();

            // Captura los datos del formulario
            const datosFormulario = {
                id_venta: document.getElementById("id_venta").value,
            };

            // Realiza la solicitud POST al endpoint en Laravel
            fetch("{{ route('carrito.comprar') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify(datosFormulario)
                })
                .then(response => {
                    if (!response.ok) throw new Error("Error en la solicitud");
                    return response.json();

                })
                .then(data => {
                    console.log("Respuesta del servidor:", data);
                    alert("Formulario enviado con éxito");
                })
                .catch(error => {
                    console.error("Hubo un problema con la solicitud:", error);
                    alert("Hubo un error al enviar el formulario");
                });

        });
    </script>

</body>


</html>
