<?php
// Incluir o ficheiro de conexão
require_once '../connect/server.php';
require_once '../connect/cors.php';

// Obter o código de aprovação do URL
$approvalCode = filter_input(INPUT_GET, "code", FILTER_SANITIZE_ADD_SLASHES);

// Verificar se o código de aprovação é válido e não está vazio
if (!empty ($approvalCode)) {
    $sql = "SELECT * FROM usuarios WHERE approval_code = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $approvalCode);
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // O código de aprovação é válido, atualizar o status do usuário para "aprovado"
                $sql = "UPDATE usuarios SET status = 'aprovado' WHERE approval_code = ?";
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param("s", $approvalCode);
                    if ($stmt->execute()) {
                        // Obter o email do usuário
                        $user = $result->fetch_assoc();
                        $userEmail = $user['email'];

                        // Enviar um email ao usuário com um link para a página de início de sessão
                        $subject = "Sua conta foi aprovada!";
                        $message = "Parabéns, sua conta foi aprovada! Você pode iniciar sessão aqui: http://localhost:3000/login";
                        $messagecod = "Insira o seguinte código: FAMILIAGOUVEIA7916!";
                        $headers = "From: noreply@seusite.com";

                        if (mail($userEmail, $subject, $messagecod, $message, $headers)) {
                            echo "Usuário aprovado com sucesso!";
                        } else {
                            echo "Falha ao enviar o e-mail.";
                        }
                    } else {
                        echo "Falha ao atualizar o status do usuário.";
                    }
                }
            } else {
                // O código de aprovação não é válido
                echo "Código de aprovação inválido.";
            }
        } else {
            echo "Falha ao executar a consulta SQL.";
        }
        $stmt->close();
    }
} else {
    echo "Código de aprovação não fornecido.";
}

// Fechar a conexão
$conn->close();
?>