<?php
session_start();
require_once 'conexao.php';

// Verifica login
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$tipo_usuario = $_SESSION['tipo'];

// Buscar veículos no banco
$sql = "SELECT * FROM veiculos ORDER BY id DESC";
$stmt = $pdo->query($sql);
$veiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>AutoDrive - Veículos</title>
    <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>

<header class="header">
    <div class="logo">AutoDrive</div>

    <nav>
        <?php if ($tipo_usuario === 'admin'): ?>
            <a href="adicionar_veiculo.php" class="btn-admin">Adicionar Veículo</a>
        <?php endif; ?>

        <a href="logout.php" class="btn-sair">Sair</a>
    </nav>
</header>

<section class="banner">
    <h1>Escolha seu próximo Test Drive</h1>
    <p>Os melhores veículos selecionados especialmente para você.</p>
</section>

<main>
    <h2 class="titulo-home">Veículos Disponíveis</h2>

    <div class="carros-container">

        <?php foreach ($veiculos as $v): ?>
        <div class="car-card">

            <img src="uploads/<?php echo $v['imagem']; ?>" alt="<?php echo $v['modelo']; ?>">

            <h3><?php echo $v['modelo']; ?></h3>
            <p><?php echo $v['descricao']; ?></p>

            <div class="acoes-card">
                <?php if ($tipo_usuario === 'cliente'): ?>
                    <a href="agendamento.php?id=<?php echo $v['id']; ?>" class="btn-agendar">Agendar Test Drive</a>

                <?php else: ?>
                    <a href="editar_veiculo.php?id=<?php echo $v['id']; ?>" class="btn-editar">Editar</a>
                    <a href="apagar_veiculo.php?id=<?php echo $v['id']; ?>" class="btn-excluir" onclick="return confirm('Confirmar exclusão?')">Excluir</a>
                <?php endif; ?>
            </div>

        </div>
        <?php endforeach; ?>
        
    </div>
</main>

<footer>
    <p>© 2025 AutoDrive - Todos os direitos reservados.</p>
</footer>

</body>
</html>
