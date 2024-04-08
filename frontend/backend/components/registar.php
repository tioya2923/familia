<?php

// Incluir o ficheiro de conexão
require_once '../connect/server.php';
require_once '../connect/cors.php';

// Obter os dados do formulário
$name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_ADD_SLASHES);
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_ADD_SLASHES);
$newRegistration = filter_input(INPUT_POST, "newRegistration", FILTER_VALIDATE_BOOLEAN);

// Validar os dados do formulário
if (empty ($name) || empty ($email) || empty ($password)) {
    // Considerar retornar uma mensagem de erro para o usuário
    exit ('Dados inválidos.');
}

// Criar uma hash da senha
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Verificar se o email já está registrado na base de dados
$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "O email já está registado";
    exit();
}

// Gerar um código de aprovação aleatório
$approvalCode = bin2hex(random_bytes(16));

// Preparar a consulta SQL para inserir o novo usuário
$sql = "INSERT INTO usuarios (name, email, password, status, approval_code) VALUES (?, ?, ?, 'pendente', ?)";
$stmt = $conn->prepare($sql);

// Vincular os parâmetros
$stmt->bind_param("ssss", $name, $email, $passwordHash, $approvalCode);

// Executar a consulta
if ($stmt->execute()) {
    // Se este é um novo registro, envie um e-mail para o administrador
    if ($newRegistration) {
        $to = "yolandaita@hotmail.com";
        $subject = "Novo registro";

        // Substitua isso pelo URL do seu script PHP
        $approvalUrl = "http://localhost:8000/components/linkAprovacao.php?code=$approvalCode";

        $message = "O usuário $name se registrou. Aprovar? $approvalUrl";
        $headers = 'From: webmaster@example.com' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
    }

    // Mostrar uma mensagem de sucesso
    echo "Registo feito com sucesso. Aguardando aprovação do administrador.";
    exit();
} else {
    // Logar o erro e retornar uma mensagem genérica para o usuário
    error_log("Erro ao inserir usuário: " . $stmt->error);
    exit ('Erro ao processar seu pedido.');
}

// Fechar a conexão
if ($stmt) {
    $stmt->close();
}

$conn->close();
?>