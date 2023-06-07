<?php

namespace App\Http\Controllers;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Picqer\Barcode\BarcodeGeneratorPNG;

class BarcodeController extends Controller
{
    public function generate($code)
    {
        // Crear una instancia del generador de código de barras
        $generator = new BarcodeGeneratorPNG();
        
        // Generar el código de barras con los datos proporcionados
        $barcode = $generator->getBarcode($code, $generator::TYPE_CODE_128);
        
        
        // Devolver el código de barras generado como una imagen PNG
        return response($barcode)->header('Content-Type', 'image/png');
    }
    public function generateQrCode($data)
    {
        $result = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data($data)//link de reeubicacion
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(300)
            ->margin(10)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->labelText($data)
            ->labelFont(new NotoSans(20))
            ->labelAlignment(new LabelAlignmentCenter())
            ->validateResult(false)
            ->build();
    
        // Retorna la imagen o haz lo que desees con los datos de la imagen
        return response($result->getString())->header('Content-Type', 'image/png');
    }
 
    
    
    
    


}
