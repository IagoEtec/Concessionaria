<?php
// navigation.php
function renderNavigation() {
    $current_page = basename($_SERVER['PHP_SELF']);
    $is_logged_in = isset($_SESSION['user_id']);
    $username = $is_logged_in ? $_SESSION['username'] : '';
    
    echo '
    <nav class="nav-menu">
        <div class="nav-container">
            <a href="index.php" class="nav-brand">SELECT CAR MOTORS</a>
            
            <ul class="nav-links">';
    
    // Páginas públicas
    echo '<li><a href="index.php" class="' . ($current_page == 'index.php' ? 'active' : '') . '" data-i18n="inicio">Início</a></li>';
    
    if ($is_logged_in) {
        // Páginas protegidas (apenas para usuários logados) - SEM DASHBOARD
        echo '
        <li><a href="catalogo.php" class="' . ($current_page == 'catalogo.php' ? 'active' : '') . '" data-i18n="catalogo">Catálogo</a></li>
        <li><a href="admin.php" class="' . ($current_page == 'admin.php' ? 'active' : '') . '" data-i18n="administracao">Administração</a></li>';
    }
    
    echo '</ul>';
    
    if ($is_logged_in) {
        echo '
        <div class="user-area">
            <div class="user-info">
                <span class="user-name">' . htmlspecialchars($username) . '</span>
            </div>
            <div class="user-buttons">
                <a href="logout.php" class="btn btn-outline" data-i18n="sair">Sair</a>
            </div>
        </div>';
    } else {
        echo '
        <div class="user-buttons">
            <a href="login.php" class="btn btn-outline" data-i18n="entrar">Entrar</a>
            <a href="register.php" class="btn btn-primary" data-i18n="cadastrar">Cadastrar</a>
        </div>';
    }
    
    echo '</div></nav>';
}

// Renderiza o menu
renderNavigation();
?>