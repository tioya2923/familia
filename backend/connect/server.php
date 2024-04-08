<?php

// Incluir o ficheiro de conexão
include '../connect/cors.php';



// Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "19101989";
$dbname = "happy_family";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Conexão falhou: " . $conn->connect_error);
} else{
  
}