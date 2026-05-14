<?php
// NÃO dê require_once 'config.php' aqui para evitar loop infinito

function realizarBackup($tipo = 'dinamico') {
    global $host, $user, $pass, $db;

    $diretorio = __DIR__ . '/backups';
    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0777, true);
    }

    if ($tipo == 'dinamico') {
        $nome_arquivo = "backup_atual.sql";
    } else {
        $nome_arquivo = "backup_semanal_" . date('Y-m-d_H-i-s') . ".sql";
    }

    $caminho_final = $diretorio . '/' . $nome_arquivo;
    
    // Caminho do mysqldump - Use barras normais ou escape as invertidas
    $mysqldump = "C:/xampp/mysql/bin/mysqldump.exe";

    // Montando o comando cuidadosamente
    // Se a senha estiver vazia, não passamos o parâmetro -p
    $senha_cmd = (!empty($pass)) ? "-p" . $pass : "";
    
    // Comando formatado para Windows (com aspas para caminhos com espaços)
    $comando = "\"$mysqldump\" -h $host -u $user $senha_cmd $db > \"$caminho_final\" 2>&1";

    // exec captura a saída de erro se houver
    exec($comando, $output, $return_var);

    if ($return_var !== 0) {
        // Se der erro, grava no log do PHP para você saber o que foi
        error_log("Erro no Backup MySQL: " . implode("\n", $output));
    } else {
        if ($tipo == 'semanal') {
            file_put_contents($diretorio . '/ultimo_backup_semanal.txt', time());
        }
    }
}

function verificarAgendamentoSemanal() {
    $arquivo_controle = __DIR__ . '/backups/ultimo_backup_semanal.txt';
    $uma_semana = 7 * 24 * 60 * 60;

    if (!file_exists($arquivo_controle) || (time() - (int)file_get_contents($arquivo_controle)) > $uma_semana) {
        realizarBackup('semanal');
    }
}