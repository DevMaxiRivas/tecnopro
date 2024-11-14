<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cuenta de usuario</title>
</head>
<body>
    <img src="https://drive.google.com/uc?export=view&id=1UhbyPkozJj0lFaqesOu78WN8q0SEnnaT" alt="Logo-TecnoPro" width="200px">

    <h2 style="margin: 10px auto">Estimado/a {{ $user->name }}</h2>
    <p>Su cuenta fue creada exitosamente y deberá acceder con los siguientes datos: </p>

    <ul>
        <li>Email: {{ $user->email }}</li>
        <li>Contraseña: {{ $passwordTextPlain }}</li>
    </ul>

    <p>Deberá acceder a la página de <a href="{{ env('APP_URL') }}">TecnoPro</a></p>
    <p>Saludos cordiales.</p>

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
