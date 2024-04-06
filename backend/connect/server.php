<?php

// Incluir o ficheiro de conexão
include '../connect/cors.php';

// Conectar ao banco de dados
$servername = "us-cluster-east-01.k8s.cleardb.net";
$username = "b022ba9ba77c40";
$password = "90c1f4f6";
$dbname = "heroku_2c4225e1b3df742";



// CONEXÃO LOCAL:
// $servername = "localhost";
// $username = "root";
// $password = "19101989";
// $dbname = "happy_family";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Conexão falhou: " . $conn->connect_error);
} else{
  
}