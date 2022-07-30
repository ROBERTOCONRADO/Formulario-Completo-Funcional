<?php
session_start();
//DOIS MODOS : LOCAL E PRODUÇÃO
$modo = 'local';

if($modo == 'local') {
    $servidor ="localhost";
    $usuario = "root";
    $senha = "";
    $banco = "formulario";
}

if($modo == 'producao') {
    $servidor ="";
    $usuario = "";
    $senha = "";
    $banco = "";
}

try {
    $pdo = new PDO("mysql:host=$servidor;dbname=$banco",$usuario,$senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo "banco conectado com sucesso!";
}catch(PDOException $erro) {
    echo "Falha ao se conectar com o banco!";
}

function limparPost($dados) {
    $dados = trim($dados);
    $dados = stripcslashes($dados);
    $dados = htmlspecialchars($dados);
    return $dados;
}
?>