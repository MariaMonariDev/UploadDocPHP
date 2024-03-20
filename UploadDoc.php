<?php

$apiUrl = 'YOURURL'; //check this
$filePath = 'C:/Users/HP/Documents/trial.txt'; //document path
$process = 2;
$apiKey = 'YOURAPIKEY';
$curl = curl_init($apiUrl);
curl_setopt_array($curl, [
    CURLOPT_URL => $apiUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => [
        'Process' => $process,
        'DocumentFile' => new CURLFile($filePath)
    ],
    CURLOPT_HTTPHEADER => array(
        'Content-Type: multipart/form-data', // applicable if uploading more than one thing. In this case it is process and Document
        'X-API-KEY: YourAPIKEY' // edit accordingly
    )
]);
$response = curl_exec($curl);
if ($response === false) {
    echo 'Error: ' . curl_error($curl);
} else {
    $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    switch ($statusCode) {
        case 200:
            echo 'Document uploaded successfully.';
            break;
        case 400:
            echo 'Bad Request: ' . $response;
            break;
        case 401:
            echo 'Unauthorized: ' . $response;
            break;
        case 404:
            echo 'Not Found: ' . $response;
            break;
        default:
            echo 'Unexpected response: ' . $response;
            break;
    }
}
curl_close($curl);

?>
