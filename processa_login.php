<?php
session_start();
require_once 'conexao.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$resultado = $pdo->query($sql);
$usuario = $resultado->fetch();

if ($usuario && password_verify($senha, $usuario['senha'])) {
    $_SESSION['id'] = $usuario['id'];
    $_SESSION['nome'] = $usuario['nome'];
    $_SESSION['email'] = $usuario['email'];
    $_SESSION['tipo'] = $usuario['tipo_conta'];
    
    header("Location: home.php");
} else {
    echo "<script>alert('E-mail ou senha incorretos!'); window.history.back();</script>";
}
?>