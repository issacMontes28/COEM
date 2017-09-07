<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Nota de compra</title>
    <link rel="stylesheet" type="text/css"><style>
    .clearfix:after {
      content: "";
      display: table;
      clear: both;
    }

    a {
      color: #5D6975;
      text-decoration: underline;
    }

    body {
      position: relative;
      width: 16cm;
      height: 29.7cm;
      margin: 0 auto;
      color: #001028;
      background: #FFFFFF;
      font-family: Arial, sans-serif;
      font-size: 12px;
      font-family: Arial;
    }

    header {
      padding: 10px 0;
      margin-bottom: 30px;
    }

    #logo {
      text-align: center;
      margin-bottom: 10px;
    }

    #logo img {
      width: 90px;
    }

    h1 {
      border-top: 1px solid  #5D6975;
      border-bottom: 1px solid  #5D6975;
      color: #5D6975;
      font-size: 2.4em;
      line-height: 1.4em;
      font-weight: normal;
      text-align: center;
      margin: 0 0 20px 0;
      background-image: url("imagenes_menu/dimension.png");
    }

    #project {
      float: left;
    }

    #project span {
      color: #5D6975;
      text-align: right;
      width: 52px;
      margin-right: 10px;
      display: inline-block;
      font-size: 0.8em;
    }

    #company {
      float: right;
      text-align: right;
    }

    #project div,
    #company div {
      white-space: nowrap;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border-spacing: 0;
      margin-bottom: 20px;
    }

    table tr:nth-child(2n-1) td {
      background: #F5F5F5;
    }

    table th,
    table td {
      text-align: center;
    }

    table th {
      padding: 5px 20px;
      color: #5D6975;
      border-bottom: 1px solid #C1CED9;
      white-space: nowrap;
      font-weight: normal;
    }

    table .service,
    table .desc {
      text-align: left;
    }

    table td {
      padding: 20px;
      text-align: right;
    }

    table td.service,
    table td.desc {
      vertical-align: top;
    }

    table td.unit,
    table td.qty,
    table td.total {
      font-size: 1.2em;
    }

    table td.grand {
      border-top: 1px solid #5D6975;;
    }

    #notices .notice {
      color: #5D6975;
      font-size: 1.2em;
    }

    footer {
      color: #5D6975;
      width: 100%;
      height: 30px;
      position: absolute;
      bottom: 0;
      border-top: 1px solid #C1CED9;
      padding: 8px 0;
      text-align: center;
    }
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="imagenes_menu/coem.png">
      </div>
      <h1>Nota de pago</h1>
      <div id="company" class="clearfix">
        <div>Clínica COEM Cuernavaca</div>
        <div>Teopanzolco 408-102B | Col. Reforma |<br /> C.P 62260 Cuernavaca</div>
        <div>(01) 777 364 5008</div>
        <div><a href="mailto:coemcuernavaca@gmail.com">cemcuernavaca@gmail.com</a></div>
      </div>
      <div id="project">
        <div><span>CLIENTE</span><?php echo $cliente ; ?></div>
        <?php
        $fecha_1 = Date('d/m/Y');
        ?>
        <div><span>FECHA</span><?php echo $fecha_1 ?></div>
        <div><span>FACTURA</span><?php echo "N° ".$factura ?></div>
        <div><span>PAGÓ CON</span><?php echo $forma_pago ?></div>
        <?php if ($promocion!=1) {
          $mysqli = new mysqli("localhost", "root", "", "coem");
          if ($mysqli->connect_errno) {
              echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
          }
          $acentos = $mysqli->query("SET NAMES 'utf8'");
          $query = $mysqli->query("select * from promotions where id='$promocion'");
          $fila = $query->fetch_assoc();
          $nombre_promocion = $fila['nombre'];
        ?>
        <div><span>PROM.</span><?php echo $nombre_promocion ?></div>
        <?php } ?>
      </div>
    </header>
    <main>
      <table class="table">
        <thead>
          <tr>
  				<th>Producto</th>
          <th>Precio unitario</th>
  				<th>Cantidad</th>
  				<th>Subtotal</th>
        </tr>
  			</thead>
        <tbody>
        <?php
        $total = 0;
        foreach($ventas as $venta){
          $total += $venta["subtotal"];
         ?>
          <tr>
          <td class="service"><?php echo $venta["producto"] ?></td>
          <td class="unit"><?php echo $venta["precio_unitario"] ?></td>
          <td class="qty"><?php echo $venta["cantidad"] ?></td>
          <td class="total"><?php echo $venta["subtotal"] ?></td>
        </tr>
  		<?php
        }
       ?>
       <tr>
         <td colspan="3" class="grand total">TOTAL</td>
         <td class="grand total"><?php echo '$'.$total ?></td>
       </tr>
       </tbody>
  		</table>
      <div id="notices">
        <div>NOTA:</div>
        <div class="notice">A partir de 30 días se efectuará un cargo financiero del 1,5% sobre los saldos pendientes de pago.</div>
        <?php if ($promocion!=1) { ?>
            <div class="notice">Algunos productos pueden NO entrar en la promoción especificada. Consulte términos y condiciones.</div>
        <?php } ?>
      </div>
    </main>
    <footer>
      Ésta factura fue creada en computadora y es válida sin firma y sello.
    </footer>
  </body>
</html>
