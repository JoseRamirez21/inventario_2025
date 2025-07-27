<?php
session_start();
require_once('./vendor/tecnickcom/tcpdf/tcpdf.php');

// CONSULTA A LA API
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => BASE_URL_SERVER . "src/control/Movimiento.php?tipo=listar_todos_movimientos&sesion=" . $_SESSION['sesion_id'] . "&token=" . $_SESSION['sesion_token'] . "&ies=1",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_CUSTOMREQUEST => "GET"
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    echo "Error: $err";
    exit;
}
$data = json_decode($response);
if (!$data->status) {
    echo "No se encontraron movimientos.";
    exit;
}

// FECHA ACTUAL
$meses = [1=>'enero',2=>'febrero',3=>'marzo',4=>'abril',5=>'mayo',6=>'junio',7=>'julio',8=>'agosto',9=>'septiembre',10=>'octubre',11=>'noviembre',12=>'diciembre'];
$fecha = new DateTime();
$dia = $fecha->format('d');
$mes = $meses[(int)$fecha->format('m')];
$anio = $fecha->format('Y');

// TCPDF PERSONALIZADO
class MYPDF extends TCPDF {
    public function Header() {
        $logo_izq = 'https://oportunidadeslaborales.uladech.edu.pe/wp-content/uploads/2021/09/GOBIERNO-REGIONAL-DE-AYACUCHO.jpg';
        $logo_der = 'https://gra.regionayacucho.gob.pe/_next/image?url=%2Flogos%2Fdrea.png&w=640&q=75';
        $html = '
        <table style="width:100%;border-bottom:2px solid #333;">
            <tr>
                <td width="15%" align="center"><img src="' . $logo_izq . '" width="60"/></td>
                <td width="70%" align="center">
                    <div style="font-size:10px;"><strong>GOBIERNO REGIONAL DE AYACUCHO</strong></div>
                    <div style="font-size:12px;"><strong>DIRECCIÓN REGIONAL DE EDUCACIÓN DE AYACUCHO</strong></div>
                    <div style="font-size:8px;">DIRECCIÓN DE ADMINISTRACIÓN</div>
                </td>
                <td width="15%" align="center"><img src="' . $logo_der . '" width="60"/></td>
            </tr>
        </table>';
        $this->writeHTML($html, true, false, true, false, '');
    }
}

$pdf = new MYPDF();
$pdf->SetMargins(10, 40, 10);
$pdf->SetHeaderMargin(5);
$pdf->SetAutoPageBreak(true, 15);
$pdf->SetFont('helvetica', '', 9);
$pdf->AddPage('L'); // 'L' para orientación horizontal (Landscape)

// TÍTULO Y FECHA
$html = "<h2 style='text-align:center; font-family:Helvetica;'>REPORTE GENERAL DE MOVIMIENTOS DE BIENES</h2>";
$html .= "<p style='text-align:right; font-size:9px;'>Ayacucho, $dia de $mes del $anio</p>";

// ESTILO Y TABLA MEJORADA
$html .= '
<style>
    th {
        background-color: #004080;
        color: #ffffff;
        font-weight: bold;
        border: 0.5px solid #ccc;
        text-align: center;
        vertical-align: middle;
        font-size: 8px;
        padding: 4px;
    }
    td {
        border: 0.5px solid #ccc;
        font-size: 7.5px;
        padding: 3px;
        vertical-align: middle;
    }
    .left-align {
        text-align: left;
    }
    .even {
        background-color: #f2f7fb;
    }
</style>

<table cellspacing="0" cellpadding="2">
    <thead>
        <tr>
            <th width="3%">#</th>
            <th width="10%">Fecha</th>
            <th width="13%">Origen</th>
            <th width="13%">Destino</th>
            <th width="12%">Responsable</th>
            <th width="14%">Descripción</th>
            <th width="10%">Cod. Patrimonial</th>
            <th width="15%">Bien</th>
            <th width="5%">Marca</th>
            <th width="5%">Estado</th>
        </tr>
    </thead>
    <tbody>';

// LLENADO DE FILAS CON ALTERNANCIA
$contador = 1;
foreach ($data->data as $mov) {
    foreach ($mov->detalle as $bien) {
        $rowClass = ($contador % 2 === 0) ? 'even' : '';
        $html .= '<tr class="' . $rowClass . '">';
        $html .= '<td width="3%" align="center">' . $contador . '</td>';
        $html .= '<td width="10%" align="center">' . htmlspecialchars($mov->movimiento->fecha_registro) . '</td>';
        $html .= '<td width="13%" class="left-align">' . htmlspecialchars($mov->origen->codigo . ' - ' . $mov->origen->detalle) . '</td>';
        $html .= '<td width="13%" class="left-align">' . htmlspecialchars($mov->destino->codigo . ' - ' . $mov->destino->detalle) . '</td>';
        $html .= '<td width="12%" class="left-align">' . htmlspecialchars($mov->usuario->nombres_apellidos) . '</td>';
        $html .= '<td width="14%" class="left-align">' . htmlspecialchars($mov->movimiento->descripcion) . '</td>';
        $html .= '<td width="10%" align="center">' . htmlspecialchars($bien->cod_patrimonial) . '</td>';
        $html .= '<td width="15%" class="left-align">' . htmlspecialchars($bien->denominacion) . '</td>';
        $html .= '<td width="5%" align="center">' . htmlspecialchars($bien->marca) . '</td>';
        $html .= '<td width="5%" align="center">' . htmlspecialchars($bien->estado_conservacion) . '</td>';
        $html .= '</tr>';
        $contador++;
    }
}

$html .= '
    </tbody>
</table>';


// ESCRIBIR HTML EN EL PDF
$pdf->writeHTML($html, true, false, true, false, '');
ob_clean();

$pdf->Output("imprimir todos los movimientos.pdf", "I");