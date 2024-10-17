<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Document</title>

</head>
<body>

 <h2>Pedido confirmado</h2>
 <h3>Sus productos fueron reservados</h3>

 <p>Estimado/a {{ $user['name'] }} su pedido fue creado con éxito. </p>
 <p>Fue guardado con el N°{{ $user['num_pedido'] }}, recuerde que tiene 3 dias para realizar el pago, de lo contrario se cancelara el pedido automaticamente.  </p>
 <p>Fecha de creación del pedido {{ $user['fecha'] }}.</p>

 <footer style="font-size: small;
 color: #929292; "> Este correo fue generado automaticamente. No conteste este correo. </footer> 
</body>
</html>
