<?php
session_start();
require_once 'config.php';
require_once 'backup.php'; // Importa as funções de backup

if (!isset($_SESSION['user_id'])) exit;

$action = $_GET['action'] ?? '';
$user_id = $_SESSION['user_id'];
$houve_mudanca = false;

// --- ADICIONAR ---
if ($action == 'add' && !empty($_POST['titulo'])) {
    $stmt = $pdo->prepare("INSERT INTO tarefas (user_id, titulo) VALUES (?, ?)");
    if($stmt->execute([$user_id, $_POST['titulo']])) $houve_mudanca = true;
}

// --- ATUALIZAR STATUS ---
if ($action == 'update') {
    $id = $_GET['id'];
    $to = $_GET['to'];
    $data_fin = ($to == 'finalizado') ? date('Y-m-d H:i:s') : null;
    
    $stmt = $pdo->prepare("UPDATE tarefas SET status = ?, data_finalizacao = ? WHERE id = ? AND user_id = ?");
    if($stmt->execute([$to, $data_fin, $id, $user_id])) $houve_mudanca = true;
}

// --- EXCLUIR ---
if ($action == 'delete') {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM tarefas WHERE id = ? AND user_id = ?");
    if($stmt->execute([$id, $user_id])) $houve_mudanca = true;
}

// Se o banco foi alterado, atualiza o arquivo SQL imediatamente
if ($houve_mudanca) {
    realizarBackup('dinamico');
}

header("Location: index.php");