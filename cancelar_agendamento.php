<?php
session_start();
require_once 'conexao.php';

// Verifica se e administrador
if (!isset($_SESSION['id']) || $_SESSION['tipo'] != 'admin') {
    die("Acesso negado.");
}

// Verifica se o ID veio pela URL
if (!isset($_GET['id'])) {
    die("Agendamento nao encontrado.");
}

$id_agendamento = $_GET['id'];

/* 1) Buscar o agendamento no banco
   para saber qual veiculo esta relacionado */
$sql = $pdo->prepare("SELECT id_veiculo FROM test_drives WHERE id = ?");
$sql->execute([$id_agendamento]);
$agendamento = $sql->fetch(PDO::FETCH_ASSOC);

// Se nao existir o agendamento, cancela o processo
if (!$agendamento) {
    die("Agendamento inexistente.");
}

$id_veiculo = $agendamento['id_veiculo'];

/* 2) Atualizar status do agendamento para CANCELADO */
$sql = $pdo->prepare("UPDATE test_drives SET status = 'cancelado' WHERE id = ?");
$sql->execute([$id_agendamento]);

/* 3) Deixar o veiculo DISPONIVEL novamente (1) */
$sql = $pdo->prepare("UPDATE veiculos SET disponivel = 1 WHERE id = ?");
$sql->execute([$id_veiculo]);

// Redireciona de volta para a lista
header("Location: ver_agendamentos.php");
exit;
