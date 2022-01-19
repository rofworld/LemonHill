<body>
<h2 style="color:#85C1E9;">Lemon Hill</h2>
<div style="margin-top:10px;">Tu calle, 123</div>
<div style="margin-top:10px;">12345 Tu Ciudad, Provincia</div>
<div style="margin-top:10px; margin-bottom:50px;">34 000 000 000</div>
<h1 style="text-align:left; color:#21618C;">Factura</h1>
<p style="text-align:left; color:#F1948A;"><b>Fecha {{$date}}</b></p>
<div id="wrapper_encabezado" style="width:500px; height:200px;">
  <div style="position:absolute; left:0px; width:200px;">
    <p><b>A la atencion de</b></p>
    <p>{{$send_name}}</p>
    <p>{{$send_address}} {{$postal_code}} {{$city}}</p>
    <p>{{$country}}</p>
  </div>
  <div style="position: absolute; left:300px; width:200px;">
    <p><b>Nº de Factura</b></p>
    <p>{{$order_id}}</p>
  </div>
</div>
<table style=" margin-bottom:40px; width:100%;">
   ​<thead>
    <tr>
       <th>Producto</th>
       <th>Cantidad</th>
       <th>Precio unitario</th>
       <th>Precio total</th>

    </tr>
   ​</thead>
   ​<tbody>
   @foreach ($order_lines as $line)

   <tr>
     <td><strong>{{$line->product_name}} {{$line->size ? ' - Talla '.$line->size_name : '' }}</strong></td>
     <td><strong>{{$line->units}}</strong></td>
     <td><strong>{{$line->unit_price}}</strong></td>
     <td><strong>{{$line->total_line_price}}</strong></td>
   </tr>
   @endforeach
 </tbody>
</table>
<div id="wrapper_precio" style="width:100%; height:200px;">
  <div style="position:absolute; right:200px; width:150px; color:#21618C;">
    <p>Subtotal</p>
    <p>Gastos de envio</p>
    <p>Total</p>
  </div>
  <div style="position: absolute; right:50px; width:50px;">
    <p>{{$subtotal}}</p>
    <p>{{$gastos_envio}}</p>
    <p style="color:#F1948A;">{{$subtotal + $gastos_envio}}</p>
  </div>
</div>


</body>
<style>
    table,
    caption,
    thead,
    tbody,
    tfoot,
    tr,
    th,
    td {
      border: thin solid transparent;
      font-weight: 200;
      text-align: left;
      vertical-align: middle;
    }
    table {
      background-color: transparent;
      border: 1px solid currentColor;
      border-spacing: 0;
      line-height: 64px;
      margin: 7px 0;
      width: 100%;
    }
    tbody {}
    caption,
    col,
    colgroup,
    thead,
    tfoot {
      background-color: var(--color-translucentwhite);
    }
    td, th {
      border-bottom: 1px solid currentColor;
      padding: 0 15px;
    }
    th {
      background: var(--color-translucentwhite);
      font-weight: bold;
    }
</style>
