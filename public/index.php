<?php

namespace App;

include '../App/Config/config.php';
require '../vendor/autoload.php';

/* Sample input text */
$input = $_POST['text'];

/** @var \App\Services\TextToHtml $htmlifier */
$htmlifier = new \App\Services\TextToHtml();
$htmlifier->setInput($input);
$result = $htmlifier->go();

/* Set json header */
header('Content-Type: application/json');

/* Ensure there were no errors */
if ($result['status'] !== 200) {
    echo json_encode($result);
    exit();
}

/* Return output to client */
echo json_encode([
    'status' => 200,
    'payload' => [
        'html' => $htmlifier->getOutput()
    ]
]);

