<?php require_once 'vendor/autoload.php'; 

#$idhn = "dtjhdrjhdrpokhmoprsmpohmpspomh"; // $_GET['get']
$renderer = new \BaconQrCode\Renderer\Image\Png();
$renderer->setHeight(256);
$renderer->setWidth(256);
$writer = new \BaconQrCode\Writer($renderer);
$writer->writeFile('test', '../../images/qrcode.png');