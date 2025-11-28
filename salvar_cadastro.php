<?php
// Remove session_start() daqui
require_once 'conexao.php';

if ($_POST) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo_conta'];

    $sql = "SELECT id FROM usuarios WHERE email = '$email'";
    $resultado = $pdo->query($sql);
    
    if ($resultado->rowCount() > 0) {
        echo "<script>alert('Este e-mail já está cadastrado!'); window.history.back();</script>";
        exit;
    }

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, senha, tipo_conta) 
            VALUES ('$nome', '$email', '$senhaHash', '$tipo')";
    
    if ($pdo->query($sql)) {
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