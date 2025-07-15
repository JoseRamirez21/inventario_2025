<?php
$ruta = explode("/", $_GET['views']);
if (!isset($ruta[1]) || $ruta[1] == "") {
    header("location:" . BASE_URL . "movimientos");
}

// =================== INICIA cURL ===================
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => BASE_URL_SERVER . "src/control/Movimiento.php?tipo=buscar_movimento_id&sesion=" . $_SESSION['sesion_id'] . "&token=" . $_SESSION['sesion_token'] . "&data=" . $ruta[1],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "x-rapidapi-host: " . BASE_URL_SERVER,
        "x-rapidapi-key: XXXX"
    ),
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
// =================== FIN cURL ===================

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    require_once('./vendor/tecnickcom/tcpdf/tcpdf.php');

    // ========= Clase personalizada con header + footer =========
    class MYPDF extends TCPDF {
        public function Header() {
            // Logos desde URL
            $logoIzq = __DIR__ . '/../../public/assets/img/gra.png';
$logoDer = __DIR__ . '/../../public/assets/img/drea.png';

            // Imágenes
            $this->Image($logoIzq, 10, 10, 30, '', '', '', '', false, 300);
            $this->Image($logoDer, 175, 10, 30, '', '', '', '', false, 300);

            // Texto centrado
            $this->SetY(20);
           $this->SetFont('helvetica', 'B', 10);
$this->Cell(0, 5, 'GOBIERNO REGIONAL DE AYACUCHO', 0, 1, 'C');

$this->SetFont('helvetica', 'B', 12); // más grande
$this->Cell(0, 5, 'DIRECCIÓN REGIONAL DE EDUCACIÓN DE AYACUCHO', 0, 1, 'C');

$this->SetFont('helvetica', 'B', 10); // volver al tamaño normal
$this->Cell(0, 5, 'DIRECCIÓN DE ADMINISTRACIÓN', 0, 1, 'C');

        }

        public function Footer() {
            $this->SetY(-15);
            $this->SetFont('helvetica', 'I', 8);
            $this->Cell(0, 0, '', 'T', 1, 'C');
            $this->Cell(0, 5, 'Instituto de Educación Superior Tecnológico Publico Huanta ', 0, 1, 'C');
            $this->Cell(0, 5, 'Página ' . $this->getAliasNumPage() . ' de ' . $this->getAliasNbPages(), 0, 0, 'C');
        }
    }
    // ==========================================================

    $respuesta = json_decode($response);

    // Fecha en español
    $meses = [
        1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril',
        5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto',
        9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'
    ];
    $fecha = new DateTime();
    $dia = $fecha->format('d');
    $mes = $meses[(int)$fecha->format('m')];
    $anio = $fecha->format('Y');

    // Contenido HTML para el PDF
    $contenido_pdf = '
    <style>
        body { font-family: Arial, sans-serif; background-color: #ffffff; color: #000000; }
         .titulo-principal { 
        text-align: center; 
        font-size: 16pt; 
        font-weight: bold; 
        margin-bottom: 20px;
    }
        .section { margin: 20px 0; }
        .label { font-weight: bold; margin-right: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        .fecha { margin-top: 40px; text-align: right; }
        .firma { margin-top: 60px; display: flex; justify-content: space-between; padding: 0 60px; }
        .firma div { text-align: center; }
    </style>
<div class="titulo-principal">
    PAPELETA DE ROTACIÓN DE BIENES
</div>
    <div class="section">
        <div><span class="label">ENTIDAD:</span> DIRECCIÓN REGIONAL DE EDUCACIÓN - AYACUCHO</div><br>
        <div><span class="label">ÁREA:</span> OFICINA DE ADMINISTRACIÓN</div><br>
        <div><span class="label">ORIGEN:</span>' . $respuesta->amb_origen->codigo . '-' . $respuesta->amb_origen->detalle . '</div><br>
        <div><span class="label">DESTINO:</span>' . $respuesta->amb_destino->codigo . '-' . $respuesta->amb_destino->detalle . '</div><br>
        <div><span class="label">MOTIVO (*):</span> ' . $respuesta->movimiento->descripcion . '</div>
    </div>
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
    ';

    $contador = 1;
    foreach ($respuesta->detalle as $bien) {
        $contenido_pdf .= "<tr>";
        $contenido_pdf .= "<td>" . $contador . "</td>";
        $contenido_pdf .= "<td>" . $bien->cod_patrimonial . "</td>";
        $contenido_pdf .= "<td>" . $bien->denominacion . "</td>";
        $contenido_pdf .= "<td>" . $bien->marca . "</td>";
        $contenido_pdf .= "<td>" . $bien->color . "</td>";
        $contenido_pdf .= "<td>" . $bien->modelo . "</td>";
        $contenido_pdf .= "<td>" . $bien->estado_conservacion . "</td>";
        $contenido_pdf .= "</tr>";
        $contador++;
    }

    $contenido_pdf .= '
        </tbody>
    </table>
    <div class="fecha">
        Ayacucho, ' . "$dia de $mes del $anio" . '
    </div>

    <div class="firma">
        <div>
            ------------------------------<br>
            ENTREGUE CONFORME
        </div>
        <div>
            ------------------------------<br>
            RECIBÍ CONFORME
        </div>
    </div>
    ';

    // Crear el PDF
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator('DPW');
    $pdf->SetAuthor('Jose Ramirez');
    $pdf->SetTitle('Reporte de Movimiento');
    $pdf->SetMargins(PDF_MARGIN_LEFT, 55, PDF_MARGIN_RIGHT); // margen superior alto por el header
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $pdf->SetFont('helvetica', '', 10);
    $pdf->AddPage();
    $pdf->writeHTML($contenido_pdf, true, false, true, false, '');

    ob_clean();
    $pdf->Output('reporte_movimiento.pdf', 'I');
}
?>