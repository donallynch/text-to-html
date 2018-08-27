<?php

namespace App;

include '../App/Config/config.php';

/* Sample input text */
$input = $_POST['text'];

/** @var \App\Services\TextToHtml $htmlifier Retrieve service from Pimple service container */
$htmlifier = $container['textToHtml'];
$htmlifier->setInput($input);
$result = $htmlifier->go();

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

