<?php
// Defina o caminho para o arquivo index.html na pasta build
$index_file_path = 'frontend/build/index.html';

// Verifique se o arquivo existe
if (file_exists($index_file_path)) {
    // Leia o conteúdo do arquivo e imprima
    echo file_get_contents($index_file_path);
} else {
    // Se o arquivo não existir, exiba uma mensagem de erro
    echo "O arquivo $index_file_path não existe";
}

// Adicione um manipulador para todas as rotas não encontradas
// Isso irá capturar qualquer rota não definida e servir o index.html do React
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($uri !== '/' && file_exists($_SERVER['DOCUMENT_ROOT'].$uri)) {
    return false;
} else {
    echo file_get_contents($index_file_path);
}
?>
