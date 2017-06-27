<?php

require_once('./fpdf/fpdf.php');
require_once('./fpdi/fpdi.php');


//word_watermark
$pdf = new FPDI();

// get the page count
$pageCount = $pdf->setSourceFile('more.pdf');

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


    $pdf->SetFont('Arial','B','12');
    // sign with current date
    $pdf->SetXY(0, 0); // you should keep testing untill you find out correct x,y values
    $pdf->Write(7, date('Y-m-d'));

}
$pdf->Output('word.pdf');


