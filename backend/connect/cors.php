<?php
// Define o domínio que pode acessar o seu recurso
$dominioPermitido = "http://localhost:3000";

// Sanitize $dominioPermitido
$dominioPermitido = filter_var($dominioPermitido, FILTER_SANITIZE_URL);

// Define os cabeçalhos que permitem o CORS
header("Access-Control-Allow-Origin: $dominioPermitido");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS"); // Ajuste para os métodos que você está usando
// Permitir o tipo de conteúdo application/json
header("Content-Type: application/json");
//header('Access-Control-Allow-Headers: Content-Type');
// Saber o que fazem
//header('Access-Control-Max-Age: 1728000');
//header('Content-Length: 0');
header('Content-Type: text/plain');
?>
