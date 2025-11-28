<?php
// Inicia a sessão em todas as páginas que incluem este header
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoDrive - Concessionária</title>
    <!-- Tag link para conectar arquivo CSS do header e footer -->
    <link rel="stylesheet" href="assets/css/header_footer.css">
</head>
<body>
    <!-- Tag header para o cabeçalho do site -->
    <header>
        <!-- Tag nav para menu de navegação -->
        <nav class="navbar">
            <div class="nav-container">
                <div class="logo">
                    <h1>AutoDrive</h1>
                </div>
                <!-- Tag ul para lista não ordenada do menu -->
                <ul class="menu">
                    <!-- Tag li para cada item da lista -->
                    <li><a href="home.php">Home</a></li>
                    <?php if(isset($_SESSION['id'])): ?>
                        <?php if($_SESSION['tipo'] == 'admin'): ?>
                            <!-- Tag a para link de adicionar veículo (admin) -->
                            <li><a href="adicionar_veiculo.php">Adicionar Veículo</a></li>
                            <!-- Tag a para link de ver agendamentos (admin) -->
                            <li><a href="ver_agendamentos.php">Ver Agendamentos</a></li>
                        <?php else: ?>
                            <!-- Tag a para link de meus agendamentos (cliente) -->
                            <li><a href="ver_agendamentos.php?meus=true">Meus Agendamentos</a></li>
                        <?php endif; ?>
                        <!-- Tag a para link de logout -->
                        <li><a href="logout.php">Sair (<?php echo $_SESSION['nome']; ?>)</a></li>
                    <?php else: ?>
                        <!-- Tag a para link de login -->
                        <li><a href="login.php">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>