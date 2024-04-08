<?php
// Defina o caminho para o arquivo index.html na pasta build
$index_file_path = 'frontend/build/';

// Verifique se o arquivo existe
if (!file_exists($index_file_path)) {
    // Se o arquivo não existir, exiba uma mensagem de erro
    die("O arquivo $index_file_path não existe");
}

// Adicione um manipulador para todas as rotas não encontradas
// Isso irá capturar qualquer rota não definida e servir o index.html do React
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Verifique se a solicitação é para um arquivo estático ou para uma rota API
if ($uri !== '/' && !preg_match('/^\/api/', $uri) && file_exists($_SERVER['DOCUMENT_ROOT'].$uri)) {
    return false; // Serve o arquivo estático
}

// Para todas as outras rotas, sirva o index.html do React
echo file_get_contents($index_file_path);
?>
