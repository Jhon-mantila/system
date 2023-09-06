<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCPDF; 
use App\Models\Certificate;

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'cabecera-conolmeci.png';
        $this->Image($image_file, 0, 0, 210, '', 'PNG', '', 'C', false, 500, '', false, false, 0, false, false, false);
        // Set font
        
        
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 0, 'Verificar la información en la página de CONSOMECI con el número de cedula.', 0, 1, 'C', 0, '', 0);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

class PdfController extends Controller
{
    //
    public function generarPDF(Certificate $certificate){
    
    $certificate = Certificate::with(['user', 'program', 'student', 'employee', 'company'])
    ->get()
    ->where('id', '=', $certificate->id);

    //dd($certificate);
     foreach ($certificate as $certificates) {
         //echo $certificates->company->name . ' ' . $certificates->company->nit . ' ' . $certificates->company->web . ' ' . $certificates->company->direction . ' ' . $certificates->active . ' ' . $certificates->user->name;
       
        // create new PDF document
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('CONSOLMECI');
        $pdf->SetTitle('TCPDF Example 003');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        // set header and footer fonts
        // $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        // $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set font
        $pdf->SetFont('times', 'BI', 12);

        // add a page
        $pdf->AddPage();

        // set some text to print
        $pdf->SetY(80);

        // Set font
        $pdf->SetFont('helvetica', 'B', 12);
        // Title
        $pdf->Cell(0, 0, 'Instituto técnico "'.$certificates->company->name.'" NIT '.$certificates->company->nit.' Barrancabermeja', 0, 1, 'C', 0, '', 0);
        $pdf->Cell(0, 0, 'RESOLUCION 0721 LICENCIA 0720 DE LA SECRETARIA DE EDUCACION', 0, 1, 'C', 0, '', 1);
        $pdf->Cell(0, 0, 'Cra 44 # 52-17 Barrio el progreso Cel: '.$certificates->company->mobile.' página: '.$certificates->company->web.'', 0, 1, 'C', 0, '', 2);
        $pdf->ln(15);

        $pdf->SetFont('helvetica', 'B', 20);
        $pdf->Cell(0, 0, 'CONSTANCIA DE MATRICULA', 0, 1, 'C', 0, '', 3);

        // Set font
        $pdf->SetFont('helvetica', '', 12);
        $tecnico = "Prueba";
        $pdf->ln(15);

        $name_student = $certificates->student->first_name . ' ' . $certificates->student->second_name . ' ' . $certificates->student->last_name . ' ' . $certificates->student->second_last_name;
        $document = $certificates->student->document;
        $program = $certificates->program->name;
        $dia = date('d', strtotime($certificates->date_start));
        setlocale(LC_TIME, 'es_ES.UTF-8');
        $mes = date('M', strtotime($certificates->date_start));
        $mes_espanol = str_replace(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'], $mes);
        $year = date('Y', strtotime($certificates->date_start));

        // set some text to print
        $txt = <<<EOD
        El instituto técnico de formación para el trabajo y el desarrollo humano CONSOLMECI aprobado mediante resolución 0721 de la secretaria de educación de Barrancabermeja hace constar que el estudiante, $name_student CC $document DE BUCARAMANGA, se encuentra actualmente matriculado en nuestra institución en el programa de: $program, en la jornada de formación los fines de semana, con fecha de inicio el día $dia de $mes_espanol del año $year y fecha de terminación una vez el candidato supere todas las evidencias de aprendizaje exigidas en el programa de formación, y cumpla con su etapa productiva, las jornadas de formación pueden ser presenciales, semi presenciales, o virtuales según la situación lo amerite.

        EOD;

        // print a block of text using Write()
        $pdf->MultiCell(0, 0, $txt, 0, 'J', false);
        //$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
        $pdf->ln(15);
        $pdf->Cell(0, 0, 'En constancia se firma en Barrancabermeja el día 01 de julio del año 2022.', 0, 1, 'L', 0, '', 0);
        
        $pdf->ln(40);

        $pdf->SetFont('helvetica', 'B', 12);

        // Logo
        $image_file = public_path('storage/' . $certificates->employee->signature);
        $pdf->Image($image_file, 100, 230, 15, '', '', '', 'C', false, 300, '', false, false, 0, false, false, false);
        //$pdf->ln(2);
        $name_employe = $certificates->employee->first_name . ' ' . $certificates->employee->second_name . ' ' . $certificates->employee->last_name . ' ' . $certificates->employee->second_last_name;
        $pdf->Cell(0, 0, $name_employe, 0, 1, 'C', 0, '', 0);
        $pdf->Cell(0, 0, 'Director General', 0, 1, 'C', 0, '', 1);
        // ---------------------------------------------------------

        //Close and output PDF document
        $pdf->Output('example_003.pdf', 'I');

        //============================================================+
        // END OF FILE
        //============================================================+
    }
    
    }
}
