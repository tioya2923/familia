<?php
// Substitua o valor abaixo com a sua URL de conexão real
$clearDbUrl = getenv('CLEARDB_DATABASE_URL') ?: 'mysql://b9be19dd73d363:f1497694@us-cluster-east-01.k8s.cleardb.net/heroku_1100169a60b63f3';

// Parse the URL and extract the connection details
$url = parse_url($clearDbUrl);

// Verifique se todas as partes necessárias estão presentes
if (!isset($url["host"]) || !isset($url["user"]) || !isset($url["pass"]) || !isset($url["path"])) {
    die("URL de conexão com o banco de dados está incompleta ou incorreta.");
}
$host = $url["host"];
$user = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

// Definir as variáveis de conexão
define('DB_HOST', $host);
define('DB_USER', $user);
define('DB_PASSWORD', $password);
define('DB_NAME', $db);

// Conexão com a base de dados
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

?>
