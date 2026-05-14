<?php
// Configurações do Banco de Dados
$host = 'localhost';
$db   = 'todo_list';
$user = 'root';
$pass = ''; // Se tiver senha, coloque aqui

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Erro de conexão: " . $e->getMessage());
    die("O sistema está temporariamente fora do ar.");
}

// Agora que as variáveis existem, chamamos o backup
require_once 'backup.php';
verificarAgendamentoSemanal(); 
?>