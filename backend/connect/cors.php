<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET,OPTIONS,PATCH,DELETE,POST,PUT");
header("Access-Control-Allow-Headers: Content-Type");








/* // Certifique-se de que este código seja executado antes de qualquer saída
$dominioPermitido = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
$dominioPermitido = filter_var($dominioPermitido, FILTER_SANITIZE_URL);
$origensPermitidas = ['http://localhost:3000', 'https://familia-gouveia-0f628f261ee1.herokuapp.com'];

// Configuração dos cabeçalhos para todas as rotas da API
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS' || in_array($dominioPermitido, $origensPermitidas)) {
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Origin: ' . $dominioPermitido);
    header('Access-Control-Allow-Methods: GET,OPTIONS,PATCH,DELETE,POST,PUT');
    header('Access-Control-Allow-Headers: X-CSRF-Token, X-Requested-With, Accept, Accept-Version, Content-Length, Content-MD5, Content-Type, Date, X-Api-Version, Authorization');
    header('Content-Type: application/json');
    
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        // Responder à requisição preflight
        http_response_code(200);
        exit;
    }
} else {
    header('HTTP/1.1 403 Forbidden');
    exit;
}

 */
?>
