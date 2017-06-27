<?php

require_once('../pdfs/fpdf/fpdf.php');
require_once('../pdfs/fpdi/fpdi.php');


//产生文字水印
$pdf = new FPDI();

// get the page count
$pageCount = $pdf->setSourceFile('22.pdf');

// iterate through all pages
for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++)
{
    // import a page
    $templateId = $pdf->importPage($pageNo);

    // get the size of the imported page
    $size = $pdf->getTemplateSize($templateId);

    // create a page (landscape or portrait depending on the imported page size)
    if ($size['w'] > $size['h']) $pdf->AddPage('L', array($size['w'], $size['h']));
    else $pdf->AddPage('P', array($size['w'], $size['h']));

    // use the imported page
    $pdf->useTemplate($templateId);

    // sign when last page

        // sign with your name
        $pdf->SetFont('Arial','B','12');
        // sign with current date
        $pdf->SetXY(0, 0); // you should keep testing untill you find out correct x,y values
        $pdf->Write(7, date('Y-m-d'));

}
$pdf->Output('success.pdf');


