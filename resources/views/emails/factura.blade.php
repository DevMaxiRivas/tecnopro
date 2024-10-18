<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura de Compra</title>
</head>

<body>
    <img src="https://drive.google.com/uc?export=view&id=1UhbyPkozJj0lFaqesOu78WN8q0SEnnaT" alt="Logo-TecnoPro"
        width="200px">

    <h2 style="margin: 10px auto">Estimado/a {{ $user['name'] }}</h2>
    <h3>Esperamos se encuentre bien.</h3>

    <p>Le agradecemos por su reciente compra en TecnoPro. Adjunto a este correo,
        la factura correspondiente a su compra #{{ $user['num_venta'] }}.
    </p>

    <h4 style="margin-top: 10px">Detalles de su Compra</h4>
    <p style="margin: 5px auto"><b>Fecha de pago:</b> {{ $user['fecha_pago']->format('Y-m-d') }}.</p>
    <p style="margin: 5px auto"><b>Hora de pago:</b> {{ $user['fecha_pago']->format('H:i:s') }}.</p>
    <p style="margin: 5px auto"><b>Método de pago:</b> {{ $user['metodo_pago'] }}.</p>
    <p style="margin: 5px auto"><b>Total:</b> ${{ number_format($user['total'], 2) }}.</p>

    <p>Si tiene alguna duda o necesita asistencia adicional no dude en contactarnos</p>
    <p>Gracias por confiar en nosotros.</p>

    <footer style="margin-top: 20px; font-size: small; color: #929292; ">
        <div style="display: flex; align-items: center">
            <img src="https://cdn-icons-png.flaticon.com/512/484/484167.png" alt="logo-address" width="16px">
            Dirección <b>Florida 219, Salta, Agentlna</b>
        </div>
        <div style="display: flex; align-items: center">
            <img src="https://i.pinimg.com/474x/88/a9/d0/88a9d0c252977e827f7f3862e8de6714.jpg" alt="logo-phone"
                width="16px">
            Teléfono: <b>0810-444-7025</b>
        </div>
        <div style="display: flex; align-items: center">
            <img src="https://png.pngtree.com/png-vector/20190927/ourmid/pngtree-email-icon-png-image_1757854.jpg"
                alt="logo-mail" width="16px">
            Correo electrónico: <b>consultas@tecnopro.com</b>
        </div>
    </footer>
</body>

</html>
