<?php
require_once 'config.php';
$erro = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['username'];
    $senha = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO usuarios (username, password) VALUES (?, ?)");
        $stmt->execute([$usuario, $senha]);
        header("Location: login.php?sucesso=1");
    } catch (PDOException $e) {
        $erro = "Usuário já existe ou erro no banco.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cadastro</title>
    <link rel="stylesheet" href="public/css/login.css">
</head>
<body>
    <div class="login-box">
        <h2>Criar Conta</h2>
        <?php if($erro) echo "<p style='color:red'>$erro</p>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Usuário" required><br><br>
            <input type="password" name="password" placeholder="Senha" required><br><br>
            <button type="submit">Cadastrar</button>
        </form>
        <p>Já tem conta? <a href="login.php">Logar</a></p>
    </div>
</body>
</html>