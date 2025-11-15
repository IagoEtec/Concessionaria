<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome  = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $senha = trim($_POST["senha"]);
    $tipo  = trim($_POST["tipo_conta"]);

    // Veirifica se todos os campos estao preenchidos
    if (empty($nome) || empty($email) || empty($senha) || empty($tipo)) {
        echo "<script>alert('Por favor, preencha todos os campos.'); window.history.back();</script>";
        exit;
    }

    // Criptografa a senha antes de salvar
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    try {
        // Verifica se o e-mail já existe
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Este e-mail já está cadastrado!'); window.history.back();</script>";
            exit;
        }

        // Insere os dados
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, tipo_conta) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $email, $senhaHash, $tipo]);

        $_SESSION['mensagem'] = "Cadastro realizado com sucesso!";
        header("Location: home.php");
        exit;

        exit;


   /*O PDOException é uma classe de exceção específica para erros relacionados ao PDO (PHP Data Objects) a extensão do PHP para acesso a bancos de dados. */
    } catch (PDOException $e) {
        echo "<script>alert('Erro ao cadastrar: " . $e->getMessage() . "'); window.history.back();</script>";
        exit;
    }
} else {
    echo "<script>alert('Acesso inválido!'); window.location.href='cadastro.php';</script>";
    exit;
}
?>



