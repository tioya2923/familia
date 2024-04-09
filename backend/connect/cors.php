<?php
// Define o domínio que pode acessar o seu recurso
//$dominioPermitido = "http://localhost:3000";
//https://familia-gouveia-0f628f261ee1.herokuapp.com
// Sanitize $dominioPermitido
//$dominioPermitido = filter_var($dominioPermitido, FILTER_SANITIZE_URL);

// Define os cabeçalhos que permitem o CORS
header("Access-Control-Allow-Origin: * ");
//header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS"); // Ajuste para os métodos que você está usando

// Definir o tipo de conteúdo como JSON
header("Content-Type: application/json");
?>
