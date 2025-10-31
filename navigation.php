<?php
// navigation.php (SEM IDIOMAS)
function renderNavigation() {
    $current_page = basename($_SERVER['PHP_SELF']);
    $is_logged_in = isset($_SESSION['user_id']);
    $username = $is_logged_in ? $_SESSION['username'] : '';
    
    // Buscar tipo de usuário se estiver logado
    $user_type = '';
    if ($is_logged_in) {
        require 'db.php';
        $stmt = $pdo->prepare("SELECT tipo FROM login WHERE idlog = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch();
        $user_type = $user['tipo'];
    }
    
    echo '
    <nav class="nav-menu">
        <div class="nav-container">
            <a href="index.php" class="nav-brand">SELECT CAR MOTORS</a>
            
            <ul class="nav-links">';
    
    // Páginas públicas
    echo '<li><a href="index.php" class="' . ($current_page == 'index.php' ? 'active' : '') . '">Início</a></li>';
    
    if ($is_logged_in) {
        // Páginas protegidas (apenas para usuários logados)
        echo '
        <li><a href="catalogo.php" class="' . ($current_page == 'catalogo.php' ? 'active' : '') . '">Catálogo</a></li>';
        
        // Apenas atendentes podem acessar admin e gerenciar test drives
        if ($user_type === 'atendente') {
            echo '
            <li><a href="admin.php" class="' . ($current_page == 'admin.php' ? 'active' : '') . '">Administração</a></li>
            <li><a href="gerenciar_test_drives.php" class="' . ($current_page == 'gerenciar_test_drives.php' ? 'active' : '') . '">Gerenciar Test Drives</a></li>';
        }
    }
    
    echo '</ul>';
    
    if ($is_logged_in) {
        echo '
        <div class="user-area">
            <div class="user-info">
                <span class="user-name">' . htmlspecialchars($username) . '</span>
                <small style="color: var(--accent); font-weight: 600;">(' . ($user_type === 'atendente' ? 'Atendente' : 'Cliente') . ')</small>
            </div>
            <div class="user-buttons">
                <a href="logout.php" class="btn btn-outline">Sair</a>
            </div>
        </div>';
    } else {
        echo '
        <div class="user-buttons">
            <a href="login.php" class="btn btn-outline">Entrar</a>
            <a href="register.php" class="btn btn-primary">Cadastrar</a>
        </div>';
    }
    
    echo '</div></nav>';
}

// Renderiza o menu
renderNavigation();
?>