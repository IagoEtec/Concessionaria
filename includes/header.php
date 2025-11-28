<?php
// Arquivo de cabeçalho compartilhado em todas as páginas
// Inicia a sessão apenas se não estiver ativa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Configurações básicas do HTML -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoDrive - Sistema de Test Drive</title>
    <!-- Link para o CSS compartilhado do header e footer -->
    <link rel="stylesheet" href="../assets/css/header_footer.css">
</head>
<body>

<!-- Cabeçalho da página com logo e navegação -->
<header class="header">
    <div class="logo">AutoDrive</div>

    <nav>
        <?php if (isset($_SESSION['tipo'])): ?>
            <!-- Se usuário está logado, mostra menu personalizado -->
            <?php if ($_SESSION['tipo'] === 'admin'): ?>
                <!-- Links exclusivos para administradores -->
                <a href="../adicionar_veiculo.php" class="btn-admin">Adicionar Veículo</a>
                <a href="../ver_agendamentos.php" class="btn-admin">Ver Agendamentos</a>
            <?php else: ?>
                <!-- Link para clientes verem seus agendamentos -->
                <a href="../ver_agendamentos.php?meus=true" class="btn-admin">Meus Agendamentos</a>
            <?php endif; ?>

            <!-- Link para logout (sair do sistema) -->
            <a href="../logout.php" class="btn-sair">Sair</a>
        <?php else: ?>
            <!-- Se usuário não está logado, mostra links de acesso -->
            <a href="../login.php" class="btn-admin">Login</a>
            <a href="../cadastro.php" class="btn-admin">Cadastrar</a>
        <?php endif; ?>
    </nav>
</header>