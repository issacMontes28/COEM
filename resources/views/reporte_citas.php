<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Reporte de citas</title>
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
      <h2><?php echo "Ganancias generadas por citas entre las fechas ".$fecha_inicial." y ".$fecha_final ?></h2>
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
        <div><span>INGRESOS POR CITAS</span><?php echo "$ ".$suma_ganancias; ?></div>
      </div>
    </header>
    <?php for ($i=0; $i < count($fechas); $i++) { $bandera=0;?>
      <table>
        <thead>
          <tr><th colspan="3"><strong><h3><?php echo $fechasLetra[$i]['fechaLetra']; ?>
          </h3></strong></th></tr>
        </thead>
      </table>
   <table>
      <thead>
            <tr><th colspan="6"><strong><h4>Ingresos por citas</strong></h4></th></tr>
            <tr><th>Paciente</th><th>Hora</th><th>Doctor</th>
            <th>Tipo cita</th><th>Área</th><th>Precio cita ($)</th></tr>
      </thead>
		<tbody>
    <?php $totalcita=0; foreach ($citas as $cita) {?>
    <?php if($cita["fecha"] == $fechas[$i]['fecha']) { $totalcita = $totalcita + $cita["cantidad"];?>
		 <tr>
				 <td><?php echo $cita["paciente"]; ?></td>
				 <td><?php echo $cita["hora"]; ?></td>
				 <td><?php echo $cita["doctor"]; ?></td>
         <td><?php echo $cita["tipo_cita"]; ?></td>
				 <td><?php echo $cita["division"]; ?></td>
				 <td><?php echo $cita["cantidad"]; ?></td>
		 </tr>
     <?php }}?>
    <tr>
        <td colspan="6"><strong><h4><?php echo 'Total de ingresos en esta fecha $'.$totalcita; $totalcita=0; ?></strong></h4></td>
    </tr>
    </tbody>
	</table>
  <?php }?>
    <table class="table">
      <tr><td>Se incluyen tanto ganancias por ventas de medicamentos así como por citas.</td></tr>
      <tr><td>Éste documento fue creado en computadora y es válida sin firma y sello.</td></tr>
    </table>
  </body>
</html>
