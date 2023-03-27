<?php
    session_start();
    include('phpqrcode/qrlib.php');
    require('fpdf/fpdf.php');
    // include('config.php');

    // how to save PNG codes to server
    $tempDir = "qrcodes";
    $codeContents = "afagroup4.azurewebsites.net/view_access_features.php?id=".$_SESSION["businessID"];
    
    // we need to generate filename somehow, 
    // with md5 or with database ID used to obtains $codeContents...
    $fileName = '005_file_'.md5($codeContents).'.png';
    
    $pngAbsoluteFilePath = $tempDir.$fileName;
    $urlRelativeFilePath = $tempDir.$fileName;
    
    // generating
    if (!file_exists($pngAbsoluteFilePath)) {
        QRcode::png($codeContents, $pngAbsoluteFilePath);
    }

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->Image($urlRelativeFilePath,1,1,-20,0,'png');

    $pdf->Output();
