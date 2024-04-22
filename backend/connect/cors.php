<?php
// Certifique-se de que este código seja executado antes de qualquer saída
$dominioPermitido = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
$dominioPermitido = filter_var($dominioPermitido, FILTER_SANITIZE_URL);
$origensPermitidas = ['http://localhost:3000', 'https://familia-gouveia-0f628f261ee1.herokuapp.com'];

if (in_array($dominioPermitido, $origensPermitidas)) {
    header("Access-Control-Allow-Origin: $dominioPermitido");
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
    header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS");
    header("Content-Type: application/json");
} else {
    header('HTTP/1.1 403 Forbidden');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Responder à requisição preflight
    header("Access-Control-Allow-Origin: $dominioPermitido");
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
    header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS");
    http_response_code(200);
    exit;
}
?>