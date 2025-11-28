<?php
session_start();
require_once 'conexao.php';

if ($_POST) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo_conta'];

    // Verifica se email já existe
    $sql = "SELECT id FROM usuarios WHERE email = '$email'";
    $resultado = $pdo->query($sql);
    
// Verifica se a consulta encontrou algum registro com o mesmo e-mail.
// rowCount() retorna o número de linhas retornadas pela query.
// O query verifica se já existe um usuário com o e-mail fornecido.
// Se for maior que 0, significa que o e-mail já existe no banco.
    if ($resultado->rowCount() > 0) {
        echo "<script>alert('Este e-mail já está cadastrado!'); window.history.back();</script>";
        exit;
    }

    // Criptografa a senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Insere no banco
    $sql = "INSERT INTO usuarios (nome, email, senha, tipo_conta) 
            VALUES ('$nome', '$email', '$senhaHash', '$tipo')";
    
    if ($pdo->query($sql)) {
        $_SESSION['mensagem'] = "Cadastro realizado com sucesso!";
        header("Location: login.php");
    } else {
        echo "<script>alert('Erro ao cadastrar!'); window.history.back();</script>";
    }
}
?>