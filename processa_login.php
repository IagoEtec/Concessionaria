<?php
// Remove session_start() daqui e deixa apenas no header
require_once 'conexao.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

// Usando prepared statements para evitar SQL injection
$sql = "SELECT * FROM usuarios WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->execute([':email' => $email]);

$usuario = $stmt->fetch();

if ($usuario && password_verify($senha, $usuario['senha'])) {
    // A sessão já foi iniciada pelo header, então podemos usar $_SESSION diretamente
    // Mas precisamos iniciar a sessão aqui também para garantir
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['id'] = $usuario['id'];
    $_SESSION['nome'] = $usuario['nome'];
    $_SESSION['email'] = $usuario['email'];
    $_SESSION['tipo'] = $usuario['tipo_conta'];
    
    header("Location: home.php");
} else {
    echo "<script>alert('E-mail ou senha incorretos!'); window.history.back();</script>";
}
?>