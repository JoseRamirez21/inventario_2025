<?php
session_start();
require_once('./vendor/tecnickcom/tcpdf/tcpdf.php');
require_once('./src/config/config.php');

// Validar sesión
if (!isset($_SESSION['sesion_id']) || !isset($_SESSION['sesion_token'])) {
    die('Sesión no válida');
}

// Obtener parámetros desde GET
$ies = $_GET['ies'] ?? '';
$codigo = $_GET['codigo'] ?? '';
$ambiente = $_GET['ambiente'] ?? '';

// Llamada al backend para obtener los ambientes filtrados
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => BASE_URL_SERVER . "src/control/Ambiente.php",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query([
        'tipo' => 'listar',
        'id_sesion' => $_SESSION['sesion_id'],
        'token' => $_SESSION['sesion_token'],
        'ies' => $ies,
        'busqueda_tabla_codigo' => $codigo,
        'busqueda_tabla_ambiente' => $ambiente
    ])
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    die("Error al obtener datos: $err");
}

$data = json_decode($response);
if (!$data->status) {
    die("No se encontraron ambientes");
}

// Clase TCPDF personalizada
class MYPDF extends TCPDF {
    public function Header() {
        $logoIzq = __DIR__ . '/public/assets/img/gra.png';
        $logoDer = __DIR__ . '/public/assets/img/drea.png';
        $this->Image($logoIzq, 10, 10, 30);
        $this->Image($logoDer, 175, 10, 30);
        $this->SetY(20);
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell(0, 5, 'GOBIERNO REGIONAL DE AYACUCHO', 0, 1, 'C');
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 5, 'DIRECCIÓN REGIONAL DE EDUCACIÓN DE AYACUCHO', 0, 1, 'C');
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell(0, 5, 'DIRECCIÓN DE ADMINISTRACIÓN', 0, 1, 'C');
    }

    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 0, '', 'T', 1, 'C');
        $this->Cell(0, 5, 'Instituto de Educación Superior Tecnológico Público Huanta', 0, 1, 'C');
        $this->Cell(0, 5, 'Página ' . $this->getAliasNumPage() . ' de ' . $this->getAliasNbPages(), 0, 0, 'C');
    }
}

// Fecha en español
$meses = [1=>'enero',2=>'febrero',3=>'marzo',4=>'abril',5=>'mayo',6=>'junio',7=>'julio',8=>'agosto',9=>'septiembre',10=>'octubre',11=>'noviembre',12=>'diciembre'];
$fecha = new DateTime();
$dia = $fecha->format('d');
$mes = $meses[(int)$fecha->format('m')];
$anio = $fecha->format('Y');

// Contenido HTML para el PDF
$html = '
<style>
    .titulo { text-align: center; font-size: 14pt; font-weight: bold; margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; margin-top: 15px; }
    th, td { border: 1px solid #000; padding: 5px; text-align: center; font-size: 9pt; }
    .fecha { text-align: right; margin-top: 30px; font-size: 10pt; }
</style>

<div class="titulo">REPORTE DE AMBIENTES</div>

<table>

<thead>
    <tr>
        <th>ITEM</th>
        <th>CÓDIGO</th>
        <th>DETALLE</th>
    </tr>
</thead>
<tbody>
';

$i = 1;
foreach ($data->contenido as $ambiente) {
    $html .= '<tr>';
    $html .= '<td>' . $i++ . '</td>';
    $html .= '<td>' . htmlspecialchars($ambiente->id) . '</td>';
    $html .= '<td>' . htmlspecialchars($ambiente->detalle) . '</td>';
    $html .= '</tr>';
}

$html .= '
</tbody>
</table>

<div class="fecha">Ayacucho, ' . $dia . ' de ' . $mes . ' del ' . $anio . '</div>
';

// Crear y mostrar PDF
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator('Sistema');
$pdf->SetTitle('Reporte de Ambientes');
$pdf->SetMargins(15, 55, 15);
$pdf->SetAutoPageBreak(TRUE, 20);
$pdf->SetFont('helvetica', '', 10);
$pdf->AddPage();
$pdf->writeHTML($html, true, false, true, false, '');

ob_clean();
$pdf->Output('reporte_ambientes.pdf', 'I');
