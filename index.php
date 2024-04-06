<?php
// Defina o caminho para o arquivo index.html na pasta build
$index_file_path = 'frontend/build/';

// Verifique se o arquivo existe
if (file_exists($index_file_path)) {
    // Leia o conteúdo do arquivo
    $content = file_get_contents($index_file_path);

    // Imprima o conteúdo do arquivo
    echo $content;
} else {
    echo "O arquivo $index_file_path não existe";
}
?>
