<?php
// Fluxo de recuperação de senha via código
session_start();
include('conexao.php');

// Garante existência da tabela de resets
$createTable = "CREATE TABLE IF NOT EXISTS password_resets (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    code VARCHAR(20) NOT NULL,
    expires_at DATETIME NOT NULL,
    used TINYINT(1) DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
mysqli_query($conexao, $createTable);

// helper para retornar JSON
function respond($ok, $msg = '', $data = []){
    header('Content-Type: application/json');
    echo json_encode(array_merge(['success' => $ok, 'message' => $msg], $data));
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, 'Método inválido');
}

$action = isset($_POST['action']) ? $_POST['action'] : '';

// caminho relativo para PHPMailer (usa mail() por padrão)
require_once __DIR__ . '/../bibliotecas/PHPMailer.php';
require_once __DIR__ . '/../bibliotecas/SMTP.php';
require_once __DIR__ . '/../bibliotecas/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($action === 'request') {
    // Recebe email e envia código
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conexao, trim($_POST['email'])) : '';
    if (empty($email)) respond(false, 'E-mail é obrigatório');

    // Verifica se usuário existe
    $q = "SELECT id_usuario FROM users WHERE login = '".mysqli_real_escape_string($conexao, $email)."' LIMIT 1";
    $r = mysqli_query($conexao, $q);
    if (!$r || mysqli_num_rows($r) == 0) {
        // Para não vazar informações, retornamos sucesso genérico
        respond(true, 'Se o e-mail existir, um código foi enviado.');
    }

    // Gera código de 6 dígitos
    $code = strval(mt_rand(100000, 999999));
    $expires_at = date('Y-m-d H:i:s', time() + 15 * 60); // 15 minutos

    // Insere no banco
    $ins = "INSERT INTO password_resets (email, code, expires_at) VALUES ('".mysqli_real_escape_string($conexao, $email)."', '".$code."', '".$expires_at."')";
    mysqli_query($conexao, $ins);

    // Envia e-mail com PHPMailer (usa mail() por padrão)
    try {
        $mail = new PHPMailer(true);
        // usa função mail() do PHP
        $mail->isMail();
        $mail->setFrom('no-reply@rotacerta.local', 'Rota Certa');
        $mail->addAddress($email);
        $mail->Subject = 'Código para redefinição de senha - Rota Certa';
        $mail->Body = "Seu código para redefinir a senha é: $code\n\nEsse código expira em 15 minutos.";
        $mail->send();
    } catch (Exception $e) {
        // se falhar no envio, ainda retornamos sucesso por segurança, mas avisamos no log
        error_log('Falha ao enviar e-mail de reset: ' . $e->getMessage());
    }

    respond(true, 'Se o e-mail existir, um código foi enviado.');
}

if ($action === 'verify') {
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conexao, trim($_POST['email'])) : '';
    $code = isset($_POST['code']) ? trim($_POST['code']) : '';
    if (empty($email) || empty($code)) respond(false, 'E-mail e código são necessários');

    $q = "SELECT id, expires_at, used FROM password_resets WHERE email='".mysqli_real_escape_string($conexao, $email)."' AND code='".mysqli_real_escape_string($conexao, $code)."' ORDER BY id DESC LIMIT 1";
    $r = mysqli_query($conexao, $q);
    if (!$r || mysqli_num_rows($r) == 0) respond(false, 'Código inválido');

    $row = mysqli_fetch_assoc($r);
    if ($row['used']) respond(false, 'Código já utilizado');
    if (strtotime($row['expires_at']) < time()) respond(false, 'Código expirado');

    // Marca como verificado na sessão para permitir reset
    $_SESSION['reset_email'] = $email;
    $_SESSION['reset_code'] = $code;
    $_SESSION['reset_allowed_until'] = time() + 15 * 60;

    respond(true, 'Código verificado. Você pode criar uma nova senha.');
}

if ($action === 'reset') {
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conexao, trim($_POST['email'])) : '';
    $newpass = isset($_POST['newpass']) ? $_POST['newpass'] : '';
    if (empty($email) || empty($newpass)) respond(false, 'E-mail e nova senha são necessários');

    // Verifica sessão
    if (!isset($_SESSION['reset_email']) || $_SESSION['reset_email'] !== $email) respond(false, 'Fluxo de verificação inválido');
    if (!isset($_SESSION['reset_allowed_until']) || time() > $_SESSION['reset_allowed_until']) respond(false, 'Tempo expirado, solicite um novo código');

    $code = $_SESSION['reset_code'];

    // Revalida no DB
    $q = "SELECT id, expires_at, used FROM password_resets WHERE email='".mysqli_real_escape_string($conexao, $email)."' AND code='".mysqli_real_escape_string($conexao, $code)."' ORDER BY id DESC LIMIT 1";
    $r = mysqli_query($conexao, $q);
    if (!$r || mysqli_num_rows($r) == 0) respond(false, 'Código inválido');
    $row = mysqli_fetch_assoc($r);
    if ($row['used']) respond(false, 'Código já utilizado');
    if (strtotime($row['expires_at']) < time()) respond(false, 'Código expirado');

    // Atualiza senha (compatível com o sistema atual que usa MD5)
    $senha_md5 = md5($newpass);
    $upd = "UPDATE users SET senha='".$senha_md5."' WHERE login='".mysqli_real_escape_string($conexao, $email)."'";
    if (!mysqli_query($conexao, $upd)) respond(false, 'Falha ao atualizar a senha');

    // marca código como usado
    $mark = "UPDATE password_resets SET used=1 WHERE id='".intval($row['id'])."'";
    mysqli_query($conexao, $mark);

    // limpa sessão
    unset($_SESSION['reset_email'], $_SESSION['reset_code'], $_SESSION['reset_allowed_until']);

    respond(true, 'Senha alterada com sucesso');
}

respond(false, 'Ação desconhecida');

?>