<?php
session_start();
if (isset($_SESSION['mensagem'])) {
    echo "<script>alert('" . $_SESSION['mensagem'] . "');</script>";
    unset($_SESSION['mensagem']);
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - AutoDrive</title>
  <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
  <div class="login-container">
    <h1>Entrar na AutoDrive</h1>

    <form action="processa_login.php" method="POST">
      <input type="email" name="email" placeholder="E-mail" required>
      <input type="password" name="senha" placeholder="Senha" required>
      <button type="submit">Entrar</button>
    </form>

    <p class="cadastro-link">
      Ainda não tem conta? <a href="cadastro.php">Cadastre-se aqui</a>
    </p>

    <a href="index.php" class="btn-voltar">⬅ Voltar ao Início</a>
  </div>
</body>
</html>
