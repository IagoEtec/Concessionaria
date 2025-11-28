<?php

// estabelece uma conexão com o mySQL usando PDO (PHP Data Objects em qualquer cas), configura acesso ao banco da concessionaria no servidor local com usuário root e fazzendo uso try/catch para tratamento de erros que vai exibir uma mensagem no caso de falhar.
$host = 'localhost';
$dbname = 'concessionaria';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}

?>
