<?php

require_once('./vendor/tecnickcom/tcpdf/tcpdf.php');

// CONSULTA A LA API
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => BASE_URL_SERVER . "src/control/Ambiente.php?tipo=listar_todos_ambientes&sesion=" . $_SESSION['sesion_id'] . "&token=" . $_SESSION['sesion_token'],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_CUSTOMREQUEST => "GET"
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    echo "Error cURL: $err";
    exit;
}

// Limpiar la respuesta de warnings y notices de PHP
$json_start = strpos($response, '{');
if ($json_start !== false) {
    $clean_response = substr($response, $json_start);
} else {
    echo "No se encontró JSON válido en la respuesta";
    exit;
}

$data = json_decode($clean_response);

// Verificar si la decodificación JSON fue exitosa
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "Error al decodificar JSON: " . json_last_error_msg();
    exit;
}

if (!$data || !isset($data->status) || !$data->status) {
    echo "No se encontraron ambientes o error en la respuesta.";
    if ($data && isset($data->msg)) {
        echo " Mensaje: " . $data->msg;
    }
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
$pdf->AddPage('P'); // Orientación vertical para ambientes

// TÍTULO Y FECHA
$html = "<h2 style='text-align:center; font-family:Helvetica;'>LISTADO DE AMBIENTES DE INSTITUCIONES</h2>";
$html .= "<p style='text-align:right; font-size:9px;'>Ayacucho, $dia de $mes del $anio</p>";

// ESTILO Y TABLA MEJORADA
$html .= '
<style>
    th {
        background-color: #004080;
        color: #ffffff;
        font-weight: bold;
        border: 1px solid #ccc;
        text-align: center;
        vertical-align: middle;
        font-size: 9px;
        padding: 5px;
    }
    td {
        border: 1px solid #ccc;
        font-size: 8px;
        padding: 4px;
        vertical-align: middle;
    }
    .left-align {
        text-align: left;
    }
    .even {
        background-color: #f9f9f9;
    }
</style>

<table cellspacing="0" cellpadding="3">
    <thead>
        <tr>
            <th width="6%">N°</th>
            <th width="34%">Institución Educativa</th>
            <th width="12%">Código</th>
            <th width="48%">Detalle del Ambiente</th>
        </tr>
    </thead>
    <tbody>';

// LLENADO DE FILAS
$contador = 1;
foreach ($data->data as $ambiente) {
    $rowClass = ($contador % 2 == 0) ? 'even' : '';
    $html .= '<tr class="' . $rowClass . '">';
    $html .= '<td width="6%" align="center">' . $contador . '</td>';
    $html .= '<td width="34%" class="left-align">' . htmlspecialchars($ambiente->institucion_nombre ?: 'Sin institución') . '</td>';
    $html .= '<td width="12%" align="center">' . ($ambiente->codigo ?: 'S/C') . '</td>';
    $html .= '<td width="48%" class="left-align">' . htmlspecialchars($ambiente->detalle ?: 'Sin detalle') . '</td>';
    $html .= '</tr>';
    $contador++;
}

$html .= '
    </tbody>
</table>';

// AGREGAR RESUMEN
$total_ambientes = count($data->data);
$html .= "<br><br>";
$html .= "<p style='text-align:right; font-size:9px;'><strong>Total de Ambientes: $total_ambientes</strong></p>";


// ESCRIBIR HTML EN EL PDF
$pdf->writeHTML($html, true, false, true, false, '');
ob_clean();

$pdf->Output("listado-ambientes-educativos.pdf", "I");
?>