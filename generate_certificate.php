<?php

include("config.php");

//retreiving data from tge DB
$check_database_query = mysqli_query($con, "SELECT * FROM users");
$row = mysqli_fetch_array($check_database_query);
$f_name = $row['first_name'];
$l_name = $row['last_name'];



//get the current date
$dtt=date("d");
$yy=date("Y");
$mon_num =date("m"); 
$mon_name = date("F", mktime(0, 0, 0, $mon_num, 10));  




require("pdflib.php");



function certificate_print_text($pdf, $x, $y, $align, $font='freeserif', $style, $size = 10, $text, $width = 0) {
    $pdf->setFont($font, $style, $size);
    $pdf->SetXY($x, $y);
    $pdf->writeHTMLCell($width, 0, '', '', $text, 0, 0, 0, true, $align);
}

$pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle("My Awesome Certificate");
$pdf->SetProtection(array('modify'));
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetAutoPageBreak(false, 0);
$pdf->AddPage();

    $x = 10;
    $y = 40;


    $medalx = 82;
    $medaly = 62;
    $medal = realpath("./assets/images/medal_1.png");


    $sealx = 138;
    $sealy = 231;
    $seal = realpath("./assets/images/side_logo_1.png");

    $sigx = 30;
    $sigy = 230;
    $sig = realpath("./sig_small_2.jpg");

    $custx = 30;
    $custy = 230;

    // $wmarkx = 26;
    // $wmarky = 58;
    // $wmarkw = 158;
    // $wmarkh = 170;
    // $wmark = realpath("./assets/images/logo.png");

    $brdrx = 0;
    $brdry = 0;
    $brdrw = 210;
    $brdrh = 297;
    $codey = 250;


$fontsans = 'helvetica';
$fontserif = 'times';

// border
$pdf->SetLineStyle(array('width' => 1.5, 'color' => array(0,0,0)));
$pdf->Rect(10, 10, 190, 277);
// create middle line border
$pdf->SetLineStyle(array('width' => 0.2, 'color' => array(64,64,64)));
$pdf->Rect(13, 13, 184, 271);
// create inner line border
$pdf->SetLineStyle(array('width' => 1.0, 'color' => array(128,128,128)));
$pdf->Rect(16, 16, 178, 265);


// Set alpha to semi-transparency
// if (file_exists($wmark)) {
//     $pdf->SetAlpha(0.2);
//     $pdf->Image($wmark, $wmarkx, $wmarky, $wmarkw, $wmarkh);
// }

$pdf->SetAlpha(1);
if (file_exists($seal)) {
    $pdf->Image($seal, $sealx, $sealy, '', '');
}
if (file_exists($sig)) {
    $pdf->Image($sig, $sigx, $sigy, '', '');
}
if (file_exists($medal)) {
    $pdf->Image($medal, $medalx, $medaly, '', '');
}

// Add text
$pdf->SetTextColor(0, 0, 120);
certificate_print_text($pdf, $x, $y, 'C', $fontsans, '', 35, "Certificate of Appreciation");
$pdf->SetTextColor(0, 0, 0);
certificate_print_text($pdf, $x, $y + 70, 'C', $fontserif, '', 20, "This is to certify that");
certificate_print_text($pdf, $x, $y + 86, 'C', $fontsans, '', 38, "$f_name"." "."$l_name");
certificate_print_text($pdf, $x, $y + 105, 'C', $fontsans, '', 20, "has successfully been Inducted into the");
certificate_print_text($pdf, $x, $y + 122, 'C', $fontsans, '', 30, "Hall of Fame of Creators");
certificate_print_text($pdf, $x, $y + 142, 'C', $fontsans, '', 18,  "$dtt"." "."$mon_name"." "."$yy");
//certificate_print_text($pdf, $x, $y + 102, 'C', $fontserif, '', 10, "With a grade of 12%");
// certificate_print_text($pdf, $x, $y + 112, 'C', $fontserif, '', 10, "Earning him a E- :(");
// certificate_print_text($pdf, $x, $y + 122, 'C', $fontserif, '', 10, "In only 206 hours. Yep. 206.");
certificate_print_text($pdf, $x + 16, $y + 220, 'L', $fontserif, '', 22, "Signature of CEO.");

header ("Content-Type: application/pdf");
echo $pdf->Output('certificate.pdf', 'S');
// echo $pdf->Output('certificate.pdf', 'I');