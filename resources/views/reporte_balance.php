<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Balance de gastos e ingresos</title>
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

    h2 {
      border-top: 1px solid  #5D6975;
      border-bottom: 1px solid  #5D6975;
      color: #5D6975;
      font-size: 1.5em;
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
      width: 150px;
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
      text-align: center;
    }
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="imagenes_menu/coem.png">
      </div>
      <h2><?php echo "Balance de gastos e ingresos entre las fechas ".$fecha_inicial." y ".$fecha_final ?></h2>
      <div id="company" class="clearfix">
        <div>Clínica COEM Cuernavaca</div>
        <div>Teopanzolco 408-102B | Col. Reforma |<br /> C.P 62260 Cuernavaca</div>
        <div>(01) 777 364 5008</div>
        <div><a href="mailto:coemcuernavaca@gmail.com">cemcuernavaca@gmail.com</a></div>
      </div>
      <div id="project">
        <?php
        $bandera = 0;
        $fecha_1 = Date('d/m/Y');
        ?>
        <div><span>FECHA DE REPORTE</span><?php echo $fecha_1 ?></div>
        <div><span>INGRESOS ÁREA IMAGEN</span><?php echo "$ ".$suma_imagen; ?></div>
        <div><span>INGRESOS ÁREA SALUD</span><?php echo "$ ".$suma_salud; ?></div>
        <div><span>INGRESOS GLOBAL</span><?php echo "$ ".$suma_ganancias; ?></div>
        <div><span>GASTOS</span><?php echo "$ ".$suma_gastos; ?></div>
        <div><span>BALANCE</span><?php echo "$ ".$diferencia; ?></div>
      </div>
    </header>
    <?php for ($i=0; $i < count($fechas); $i++) { $bandera=0;?>
      <table>
        <thead>
          <tr><th colspan="3"><strong><h3><?php echo $fechasLetra[$i]['fechaLetra']; ?>
          </h3></strong></th></tr>
        </thead>
      </table>
      <?php foreach ($gastos as $gasto) {
        if($gasto["fecha"] == $fechas[$i]['fecha']) {$bandera=1;}
      }?>
      <?php
        if($bandera==1) {
          $totalGastos=0;
      ?>
   <table>
      <thead>
            <tr><th colspan="3"><strong><h4>Descripción de Gastos</strong></h4></th></tr>
            <tr><th>Fecha YY-MM-DD</th><th>Concepto</th><th>Cantidad ($)</th></tr>
      </thead>
		<tbody>
    <?php foreach ($gastos as $gasto) {?>
    <?php if($gasto["fecha"] == $fechas[$i]['fecha']) { $totalGastos = $totalGastos + $gasto["cantidad"];?>
		 <tr>
				 <td><?php echo $gasto["fecha"]; ?></td>
				 <td><?php echo $gasto["concepto"]; ?></td>
				 <td><?php echo $gasto["cantidad"]; ?></td>
		 </tr>
     <?php }}?>
    <tr>
        <td colspan="3"><strong><h4><?php echo 'Total de gastos en esta fecha $'.$totalGastos; ?></strong></h4></td>
    </tr>
    </tbody>
	</table>
  <?php } $bandera=0;?>
  <?php foreach ($ingresos as $ingreso) {
    if($ingreso["fecha"] == $fechas[$i]['fecha']) {$bandera=1;}
  }?>
  <?php
    if($bandera==1) {
      $bandera2=0;
      $bandera3=0;
      foreach ($ingresos as $ingreso) {
        if($ingreso["area"] == 'Área Imagen'){$bandera2=1;}
        if($ingreso["area"] == 'Área Salud'){$bandera3=1;}
      }
  ?>
  <?php if ($bandera2==1) { $totalIngresosImagen=0;?>
  <table>
    <thead>
          <tr><th colspan="3">
            <strong><h4>Descripción de ingresos del área de imagen</h4></strong></th></tr>
          <tr><th>Fecha YY-MM-DD</th><th>Concepto</th><th>Cantidad ($)</th></tr>
    </thead>
  		<tbody>
      <?php foreach ($ingresos as $ingreso) {?>
      <?php if($ingreso["fecha"] == $fechas[$i]['fecha'] && $ingreso["area"] == 'Área Imagen') {
        $totalIngresosImagen = $totalIngresosImagen + $ingreso["cantidad"];?>
  		 <tr>
  				 <td><?php echo $ingreso["fecha"]; ?></td>
  				 <td><?php echo $ingreso["concepto"]; ?></td>
  				 <td><?php echo $ingreso["cantidad"]; ?></td>
  		 </tr>
       <?php }}?>
       <tr>
           <td colspan="3"><strong><h4><?php echo 'Total de ingresos en esta fecha $'.
           $totalIngresosImagen; ?></strong></h4></td>
       </tr>
  		</tbody>
  	</table>
    <?php } ?>

    <?php if ($bandera3==1) { $totalIngresosSalud=0;?>
    <table>
      <thead>
            <tr><th colspan="3">
              <strong><h4>Descripción de ingresos del área de salud</h4></strong></th></tr>
            <tr><th>Fecha YY-MM-DD</th><th>Concepto</th><th>Cantidad ($)</th></tr>
      </thead>
        <tbody>
        <?php foreach ($ingresos as $ingreso) {?>
        <?php if($ingreso["fecha"] == $fechas[$i]['fecha'] && $ingreso["area"] == 'Área Salud') {
          $totalIngresosSalud = $totalIngresosSalud + $ingreso["cantidad"];?>
         <tr>
             <td><?php echo $ingreso["fecha"]; ?></td>
             <td><?php echo $ingreso["concepto"]; ?></td>
             <td><?php echo $ingreso["cantidad"]; ?></td>
         </tr>
         <?php }}?>
         <tr>
             <td colspan="3"><strong><h4><?php echo 'Total de ingresos en esta fecha $'.
             $totalIngresosSalud; ?></strong></h4></td>
         </tr>
        </tbody>
      </table>
      <?php } ?>

    <?php } $bandera=0;$bandera2=0;$bandera3=0;?>
  <?php }?>
    <table class="table">
      <tr><td>Se incluyen tanto ganancias por ventas de medicamentos así como por citas.</td></tr>
      <tr><td>Éste documento fue creado en computadora y es válida sin firma y sello.</td></tr>
    </table>
  </body>
</html>
