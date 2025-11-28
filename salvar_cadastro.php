<?php
// Remove session_start() daqui
require_once 'conexao.php';

if ($_POST) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo_conta'];

    // Usando prepared statements para evitar SQL injection
    $sql = "SELECT id FROM usuarios WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    
    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Este e-mail já está cadastrado!'); window.history.back();</script>";
        exit;
    }

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Usando prepared statements para inserção
    $sql = "INSERT INTO usuarios (nome, email, senha, tipo_conta) 
            VALUES (:nome, :email, :senha, :tipo)";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':senha' => $senhaHash,
        ':tipo' => $tipo
    ])) {
        // Inicia sessão apenas para armazenar a mensagem
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['mensagem'] = "Cadastro realizado com sucesso!";
        header("Location: login.php");
    } else {
        echo "<script>alert('Erro ao cadastrar!'); window.history.back();</script>";
    }
}
?>