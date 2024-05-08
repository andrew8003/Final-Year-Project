<?php
// Include the TCPDF library
require_once('barcode_generation_library/TCPDF-main/tcpdf.php');


// Get the asset ID from the URL parameter
$asset_id = $_GET['asset_id'];

// Create new TCPDF instance
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('QR Code');
$pdf->SetAuthor('QR Code');
$pdf->SetTitle('QR Code ');
$pdf->SetSubject('QR Code ');
$pdf->SetKeywords('QR Code, ');

$pdf->AddPage();

// Set content
$content = $asset_id; // Asset ID as for QR code

// Generate QR code
$pdf->write2DBarcode($content, 'QRCODE,H', '', '', 100, 100); // width=100, height=100

// Display asset ID text below the QR code
$pdf->SetXY(15, 120); // position for asset ID text
$pdf->SetFont('helvetica', '', 10); // font for asset ID text
$pdf->Cell(0, 0, 'Asset ID: ' . $asset_id, 0, 1, 'L'); // Display asset ID text
// Close and output PDF
$pdf->Output('qr_code.pdf', 'I');

//<!--refrence to the barcode generation library - https://github.com/tecnickcom/tcpdf?tab=License-1-ov-file -->