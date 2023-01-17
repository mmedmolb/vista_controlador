<?php
/* FPDF Table with MySQL
 * Author: Olivier
 * License: FPDF 
 * http://www.fpdf.org/en/script/script14.php
 *
 * IES Virgen del Carmen de Jaén
 * Desarrollo Web en Entorno Servidor 2º DAW
 * Rafael García Cabrera
 */

require_once 'Database.php';
require('mysql_table.php');

class PDF extends PDF_MySQL_Table
{
    function Header()
    {
        // Title
        $this->SetFont('Arial', '', 18);
        $this->Cell(0, 6, 'Books', 0, 1, 'C');
        $this->Ln(10);
        // Ensure table header is printed
        parent::Header();
    }

    function Footer()
    {
        // Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Print centered page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}


function generatePDF(){

$link = $pdo = Database::connect();

$pdf = new PDF();
$pdf->AddPage();
// First table: output all columns
$pdf->Table($link, 'select isbn, title, author, country from books');

// Second table: specify 4 columns
$pdf->AddCol('isbn', 40, 'ISBN', 'C');
$pdf->AddCol('title', 40, 'Title');
$pdf->AddCol('author', 40, 'Author', 'R');
$pdf->AddCol('country', 20, 'Country', 'R');
$prop = array('HeaderColor' => array(255, 150, 100),
    'color1' => array(210, 245, 255),
    'color2' => array(255, 255, 210),
    'padding' => 2);

$pdf->Output();
}
?>
