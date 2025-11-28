<?php
// Inicia a sessão apenas se não estiver ativa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica se existe uma mensagem armazenada na sessão (usada após cadastro)
if (isset($_SESSION['mensagem'])) {
    // Exibe a mensagem em um alerta JavaScript
    echo "<script>alert('" . $_SESSION['mensagem'] . "');</script>";

    // Remove a mensagem da sessão para não exibir novamente
    unset($_SESSION['mensagem']);
}
?>

<!-- Link para o arquivo CSS específico desta página -->
<link rel="stylesheet" href="assets/css/login.css">

<!-- Container principal do formulário de login -->
<div class="login-container">
    <h1>Entrar na AutoDrive</h1>

    <!-- Formulário de login que envia dados para processa_login.php -->
    <form action="processa_login.php" method="POST">
        <!-- Campo de email com tipo email para validação nativa -->
        <input type="email" name="email" placeholder="E-mail" required>
        <!-- Campo de senha com tipo password para ocultar caracteres -->
        <input type="password" name="senha" placeholder="Senha" required>
        <!-- Botão de submit para enviar o formulário -->
        <button type="submit">Entrar</button>
    </form>

    <!-- Link para página de cadastro para usuários novos -->
    <p class="cadastro-link">
        Ainda não tem conta? <a href="cadastro.php">Cadastre-se aqui</a>
    </p>

    <!-- Link para voltar à página inicial -->
    <a href="index.php" class="btn-voltar">⬅ Voltar ao Início</a>
</div>
