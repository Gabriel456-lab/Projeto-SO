<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$search = $_GET['search'] ?? '';
$status_filter = $_GET['status'] ?? 'falta';

// Lógica de busca e filtros
$sql = "SELECT * FROM tarefas WHERE user_id = :user_id AND status = :status";
if ($search) {
    $sql .= " AND titulo LIKE :search";
}
$sql .= " ORDER BY data_criacao DESC";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id);
$stmt->bindValue(':status', $status_filter);
if ($search) $stmt->bindValue(':search', "%$search%");
$stmt->execute();
$tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Minha Lista de Tarefas</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body class="dark-theme">

    <div class="circulo-gradiente1"></div>
    <div class="circulo-gradiente2"></div>
    <header>
        <h2>Olá, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
        <div class="dark-light">
        <label class="switch">
            <input type="checkbox" id="theme-toggle">
            <span class="slider">
                <span class="icon-container">
                    <span class="icon sun claro"><ion-icon name="sunny"></ion-icon></span>
                    <span class="icon moon"><ion-icon name="moon"></ion-icon></span>
                </span>
            </span>
        </label>
        <a id="sair" href="logout.php">Sair</a>
    </div>
    </header>

    <div class="container">
        
        <!-- Abas -->
        <nav class="tabs">
            <a href="?status=falta" id="falta" class="<?= $status_filter == 'falta' ? 'active' : '' ?>">Em Falta</a>
            <a href="?status=execucao" id="execucao" class="<?= $status_filter == 'execucao' ? 'active' : '' ?>">Em Execução</a>
            <a href="?status=finalizado" id="finalizado" class="<?= $status_filter == 'finalizado' ? 'active' : '' ?>">Finalizado</a>
        </nav>
        <!-- Campo de Pesquisa -->
        <form method="GET">
            <input type="text" name="search" placeholder="Buscar tarefa..." value="<?= htmlspecialchars($search) ?>">
            <button type="submit">Pesquisar</button>
        </form>

        <!-- Cadastro de Tarefa -->
        <form action="actions.php?action=add" method="POST">
            <input type="text" name="titulo" placeholder="Nova tarefa" required>
            <button type="submit" class="btn btn-add">Adicionar</button>
        </form>

        <h1>Lista de Tarefas</h1>

        <!-- Lista de Tarefas -->
        <table>
            <?php foreach ($tarefas as $t): ?>
                <tr class="<?= $t['status'] == 'falta' ? 'bg-falta' : ($t['status'] == 'execucao' ? 'bg-execucao' : 'bg-finalizado') ?>">
                    <td><?= htmlspecialchars($t['titulo']) ?></td>

                    <td>

                        <?php if ($t['status'] == 'falta'): ?>
                            <a href="actions.php?action=update&id=<?= $t['id'] ?>&to=execucao"><ion-icon name="play"></ion-icon></a>
                        <?php elseif ($t['status'] == 'execucao'): ?>
                            <a href="actions.php?action=update&id=<?= $t['id'] ?>&to=finalizado"><ion-icon name="checkmark"></ion-icon></a>
                        <?php else: ?>
                            <span>✅ Finalizado em: <?= date('d/m/H:i', strtotime($t['data_finalizacao'])) ?></span>
                        <?php endif; ?>

                        <a href="javascript:void(0)" onclick="confirmarExclusao(<?= $t['id'] ?>)"><ion-icon name="trash"></ion-icon></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script src="public/js/script.js"></script>
</body>

</html>