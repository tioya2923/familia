<?php

// Incluir o ficheiro de conexão
include 'cors.php';

// Obter variáveis de ambiente do Heroku
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

// Conectar ao banco de dados
parse_str(parse_url($url)['query'], $params);
$servername = $params['server'];
$username = $params['user'];
$password = $params['pass'];
$dbname = substr($params['db'], 1); // Remove a barra inicial do nome do banco de dados

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
  die("Conexão falhou: " . $conn->connect_error);
}

// Resto do código...


// // Incluir o ficheiro de conexão
// include 'cors.php';

// // Obter variáveis de ambiente do Heroku
// CLEARDB_DATABASE_URL: mysql://b9be19dd73d363:f1497694@us-cluster-east-01.k8s.cleardb.net/heroku_1100169a60b63f3?reconnect=true
// $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

// // // Conectar ao banco de dados

// $servername = $url["us-cluster-east-01.k8s.cleardb.net"];
// $username = $url["b9be19dd73d363"];
// $password = $url["f1497694"];
// $dbname = substr($url["heroku_1100169a60b63f3"], 1);
// // $servername = "localhost";
// // $username = "root";
// // $password = "19101989";
// // $dbname = "happy_family";

// $conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//   die("Conexão falhou: " . $conn->connect_error);
// } else{
  
// }
// CONEXÃO LOCAL:

?>

