<?php
$ruta = explode("/", $_GET['views']);
if (!isset($ruta[1]) || $ruta[1]=="") {
    header("location:".BASE_URL."movimientos");
}

 $curl = curl_init(); //inicia la sesión cURL
    curl_setopt_array($curl, array(
        CURLOPT_URL => BASE_URL_SERVER."src/control/Movimiento.php?tipo=buscar_movimento_id&sesion=".$_SESSION['sesion_id']."&token=".$_SESSION['sesion_token']."&data=".$ruta[1], //url a la que se conecta se envia por metodo GET
        CURLOPT_RETURNTRANSFER => true, //devuelve el resultado como una cadena del tipo curl_exec
        CURLOPT_FOLLOWLOCATION => true, //sigue el encabezado que le envíe el servidor
        CURLOPT_ENCODING => "", // permite decodificar la respuesta y puede ser"identity", "deflate", y "gzip", si está vacío recibe todos los disponibles.
        CURLOPT_MAXREDIRS => 10, // Si usamos CURLOPT_FOLLOWLOCATION le dice el máximo de encabezados a seguir
        CURLOPT_TIMEOUT => 30, // Tiempo máximo para ejecutar
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, // usa la versión declarada
        CURLOPT_CUSTOMREQUEST => "GET", // el tipo de petición, puede ser PUT, POST, GET o Delete dependiendo del servicio
        CURLOPT_HTTPHEADER => array(
            "x-rapidapi-host: ".BASE_URL_SERVER,
            "x-rapidapi-key: XXXX"
        ), //configura las cabeceras enviadas al servicio
    )); //curl_setopt_array configura las opciones para una transferencia cURL

    $response = curl_exec($curl); // respuesta generada
    $err = curl_error($curl); // muestra errores en caso de existir

    curl_close($curl); // termina la sesión 

    if ($err) {
        echo "cURL Error #:" . $err; // mostramos el error
    } else {
        $respuesta = json_decode($response); // en caso de funcionar correctamente
       //print_r($respuesta); para verificar si tiene una respuesta
       
    
    
        ?>
<!-- 
    <!DOCTYPE html>
    <html lang="es">
    <head>
    <meta charset="UTF-8">
    <title>Papeleta de Rotación de Bienes</title>
    <style>
        body {
        font-family: Arial, sans-serif;
        padding: 40px;
        background-color: #ffffff; /* fondo blanco */
        color: #000000;
        }
        h2 {
        text-align: center;
        text-transform: uppercase;
        margin-bottom: 30px;
        }
        .section {
        margin: 20px 0;
        }
        .label {
        font-weight: bold;
        margin-right: 10px;
        }
        table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        }
        th, td {
        border: 1px solid #000;
        padding: 8px;
        text-align: center;
        }
        .footer {
        margin-top: 60px;
        display: flex;
        justify-content: space-between;
        }
        .firma {
        text-align: center;
        width: 40%;
        }
        .firma-linea {
        margin-top: 40px;
        border-top: 1px solid #000;
        width: 100%;
        }
        .fecha {
        margin-top: 40px;
        text-align: right;
        }
    </style>
    </head>
    <body>

    <h2>PAPELETA DE ROTACIÓN DE BIENES</h2>

    <div class="section">
        <div><span class="label">ENTIDAD:</span> DIRECCIÓN REGIONAL DE EDUCACIÓN - AYACUCHO</div><br>
        <div><span class="label">ÁREA:</span> OFICINA DE ADMINISTRACIÓN</div><br>
        <div><span class="label">ORIGEN:</span><?php echo $respuesta->amb_origen->codigo.'-'.$respuesta->amb_origen->detalle;?> </div><br>
        <div><span class="label">DESTINO:</span><?php echo $respuesta->amb_destino->codigo.'-', $respuesta->amb_destino->detalle;?></div><br>
        <div><span class="label">MOTIVO (*):</span> <?php echo $respuesta->movimiento->descripcion;?></div>
    </div>
    </table>
    <table>
        <thead>
        <tr>
            <th>ITEM</th>
            <th>CÓDIGO PATRIMONIAL</th>
            <th>NOMBRE DEL BIEN</th>
            <th>MARCA</th>
            <th>COLOR</th>
            <th>MODELO</th>
            <th>ESTADO</th>
        </tr>
        </thead>
        <tbody>
        <?php 
    $contador = 1;
    foreach ($respuesta->detalle as $bien) {
        echo "<tr>";
        echo "<td>".$contador . "</td>";
        echo "<td>".$bien->cod_patrimonial . "</td>";
        echo "<td>".$bien->denominacion . "</td>";
        echo "<td>".$bien->marca . "</td>";
        echo "<td>".$bien->color . "</td>";
            echo "<td>".$bien->modelo . "</td>";
            echo "<td>".$bien->estado_conservacion . "</td>";
        echo "</tr>";
                $contador++;
    }
    ?>
        
        </tbody>
    </table>

  <?php

// Definir meses en español manualmente
$meses = [
  1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril',
  5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto',
  9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'
];

// Crear objeto DateTime con la fecha actual
$fecha = new DateTime();

// Obtener componentes
$dia = $fecha->format('d');
$mes = $meses[(int)$fecha->format('m')];
$anio = $fecha->format('Y');
?>

<div class="fecha">
  Ayacucho, <?php echo "$dia de $mes del $anio"; ?>
</div>


    <div class="footer">
        <div class="firma">
        <div class="firma-linea"></div>
        <strong>ENTREGUÉ CONFORME</strong>
        </div>
        <div class="firma">
        <div class="firma-linea"></div>
        <strong>RECIBÍ CONFORME</strong>
        </div>
    </div>

    </body>
    </html>
-->
        <?php
    require_once('./vendor/tecnickcom/tcpdf/tcpdf.php');

    $pdf = new TCPDF(); //si quieres cambiar algo de loque viene por defecto debes de cambiar desde el inicio hasta la informacion que deseas cambiar 
// eso es por defecto $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    
// Asignar informacion del documento
$pdf->SetCreator(DPW);
$pdf->SetAuthor('Jose Ramirez');
$pdf->SetTitle('Reporte de Movimiento');

// Asignar los margenes
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// Asignar salto de pagina automatico
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

}
        