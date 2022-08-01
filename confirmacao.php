<?php
require('config/conexao.php'); 

if(isset($_GET['cod_confirm']) && !isset($_GET['cod_confirm'])) {
    //LIMPAR O GET
    $cod = limparPost($_GET['cod_confirm']);
    //CONSULTAR SE ALGUM USUARIO TEM ESSE CODIGO DE CONFIRMAÇAO
    //VERIFICAR SE EXISTE ESTE USUARIO
    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE cod_confirmacao=? LIMIT 1");
    $sql->execute(array($cod));
    $usuario = $sql->fetch(PDO::FETCH_ASSOC);

    if($usuario) {
        //ATUALIZAR O STATUS PARA CONFIRMADO
        $status = "confirmado";
        $sql = $pdo->prepare("UPDATE usuarios status=? WHERE cod_confirmacao=?");
        if($sql->execute(array($status, $cod))) {
        
        header('location: index.php?result=ok');
    }else {
        echo "<h1>Código de verificação inválido!</h1>";
    }
}   
}