<?php
// Include the TCPDF library
require_once('barcode_generation_library/TCPDF-main/tcpdf.php');

// Get the asset ID from the URL parameter
$asset_id = $_GET['asset_id'];

// Create new TCPDF instance
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('Barcode');
$pdf->SetAuthor('Barcode');
$pdf->SetTitle('Barcode ');
$pdf->SetSubject('Barcode');
$pdf->SetKeywords('Barcode');

// Add a page
$pdf->AddPage();

// Set content
$content = $asset_id; // Asset ID as content for barcode

// Generate barcode
// Adjust the size of the barcode
$pdf->write1DBarcode($content, 'C128', '', '', 100, 30); // width=100, height=30

// Display asset ID text below the barcode
$pdf->SetXY(15, 40); // Set position for asset ID text
$pdf->SetFont('helvetica', '', 10); // Set font for asset ID text
$pdf->Cell(0, 0, 'Asset ID: ' . $asset_id, 0, 1, 'L'); // Display asset ID text

// Close and output PDF
$pdf->Output('barcode.pdf', 'I');


//<!--refrence to the barcode generation library - https://github.com/tecnickcom/tcpdf?tab=License-1-ov-file -->