<?php
session_start();
require_once 'config.php';
$erro = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['username'];
    $senha = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = ?");
    $stmt->execute([$usuario]);
    $user = $stmt->fetch();

    if ($user && password_verify($senha, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
    } else {
        $erro = "Usuário ou senha inválidos.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="public/css/login.css">
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <?php if(isset($_GET['sucesso'])) echo "<p style='color:green'>Cadastro realizado!</p>"; ?>
        <?php if($erro) echo "<p style='color:red'>$erro</p>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Usuário" required><br><br>
            <input type="password" name="password" placeholder="Senha" required><br><br>
            <button type="submit">Entrar</button>
        </form>
        <p>Não tem conta? <a href="cadastro.php">Cadastre-se</a></p>
    </div>
</body>
</html>