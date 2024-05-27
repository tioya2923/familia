<?php
ini_set('display_errors', 0); // Desativa a exibição de erros
function handleUncaughtException($e) {
    error_log($e->getMessage()); // Loga o erro
    exit('Olá! Estaremos juntos brevemente!'); // Mensagem amigável para o usuário
}

set_exception_handler('handleUncaughtException'); // Define o manipulador de exceções

require_once '../connect/server.php';
require_once '../connect/cors.php';
require_once '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$name = filter_input(INPUT_POST, "name", FILTER_UNSAFE_RAW);
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, "password", FILTER_UNSAFE_RAW);
$newRegistration = filter_input(INPUT_POST, "newRegistration", FILTER_VALIDATE_BOOLEAN);

if (empty($name) || empty($email) || empty($password)) {
    exit('Dados inválidos.');
}

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$sql = "SELECT * FROM usuarios WHERE email = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if ($result->num_rows > 0) {
        echo "O email já está registado";
        exit();
    }
}

$approvalCode = bin2hex(random_bytes(16));
$approvalUrl = "http://localhost:8000/components/linkAprovacao.php?code=$approvalCode";
//$approvalUrl = "https://familia-gouveia-0f628f261ee1.herokuapp.com/linkAprovacao.php?code=$approvalCode";


$adminEmail = 'familia16gouveia@gmail.com';
$sql = "INSERT INTO usuarios (name, email, password, status, approval_code) VALUES (?, ?, ?, 'pendente', ?)";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("ssss", $name, $email, $passwordHash, $approvalCode);
    if ($stmt->execute()) {
        if ($newRegistration) {
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'familia16gouveia@gmail.com';
                $mail->Password = 'yapmmohabliiqyny';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465;

                $mail->setFrom('familia16gouveia@gmail.com', 'Administrador');
                $mail->addAddress($adminEmail);

                $mail->isHTML(true);
                $mail->Subject = 'Novo registro';
                $mail->Body    = "O usuário $name se registrou. Aprovar? <a href='$approvalUrl'>$approvalUrl</a>";
                $mail->AltBody = "O usuário $name se registrou. Aprovar? $approvalUrl";

                $mail->send();
                echo 'Registo feito com sucesso. Aguardando aprovação do administrador.';
            } catch (Exception $e) {
                handleUncaughtException($e); // Chama o manipulador de exceções personalizado
            }
        }
    }
    $stmt->close();
}
$conn->close();
?>
