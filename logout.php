<?php
// Inicia a sessão para poder destruí-la
session_start();
// Destroi todas as variáveis de sessão
// Isso efetivamente "loga out" o usuário
session_destroy();
// Redireciona para a página inicial após logout
header('Location: index.php');
?>