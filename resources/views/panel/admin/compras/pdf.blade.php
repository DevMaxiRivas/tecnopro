<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Orden de Compra - {{ $compra->id }}</title>
    <link rel="stylesheet" href="css/detalles.css" media="all" />
</head>
<body>
  <header class="clearfix">
    <div id="logo">
        <img src="imagenes/logoc.png" alt="Logo" height="4000">
    </div>
    <div id="company">
        <h2 class="name">TecnoPro</h2>
        <div>Florida 219, Salta, Argentina</div>
        <div>0810-444-7025</div>
        <div><a href="mailto:company@example.com">consultas@tecnopro.com</a></div>
    </div>
  </header>
  <main>
    <div id="details" class="clearfix">
      <div id="proveedor">
        <div class="to">DIRIGIDA A :</div>
        <h2 class="name">{{ $compra->proveedor->razon_social }}</h2>
        <div class="address">{{ $compra->proveedor->direccion }}</div>
        <div class="email">
            <a href="mailto:{{ $compra->proveedor->email }}">{{ $compra->proveedor->email }}</a>
        </div>
      </div>
      <div id="invoice">
        <h1>PEDIDO # {{ $compra->id }}</h1>
        <div class="date">Fecha de Emisión:
            {{ $compra->created_at ? $compra->created_at->format('d/m/Y') : 'N/A' }}</div>
        <div class="date">Fecha de Vencimiento: {{ $fecha_vencimiento->format('d/m/Y') }}</div>
      </div>
    </div>
    <table>
        <thead>
            <tr>
                <th class="no">#</th>
                <th class="desc">CATEGORIA</th>
                <th class="desc">PRODUCTO</th>
                {{-- <th class="unit">PRECIO UNITARIO</th> --}}
                <th class="qty">CANTIDAD </th>
                {{-- <th class="total">SUBTOTAL</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($detalle_compras as $detalle)
                <tr>
                    <td class="no">{{ $loop->iteration }}</td>
                    <td class="desc">
                        <h3>{{ $detalle->producto->categoria->nombre }}</h3>
                    </td>
                    <td class="desc">
                        <h3>{{ $detalle->producto->nombre }}</h3>
                    </td>
                    {{-- <td class="unit">$ {{ number_format($detalle->precio, 2) }}</td> --}}
                    <td class="qty">{{ $detalle->cantidad }}</td>
                   {{--  <td class="total">$ {{ number_format($detalle->subtotal, 2) }}</td> --}}
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            {{-- <tr>
                <td colspan="2"></td>
                <td colspan="2">SUBTOTAL</td>
                <td>$ {{ number_format($subtotal, 2) }}</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2">IVA 21%</td>
                <td>$ {{ number_format($iva, 2) }}</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2">TOTAL</td>
                <td>$ {{ number_format($total, 2) }}</td>
            </tr> --}}
        </tfoot>
    </table>
    <div id="thanks">Gracias!</div>
    <div id="notices">
        <div>NOTA:</div>
        <div class="notice">Por favor, confirme la recepción de esta orden de compra.</div>
    </div>
  </main>
  <footer>
      Esta orden de compra fue creada en una computadora y es válida sin la firma y el sello.
  </footer>
</body>
</html>
