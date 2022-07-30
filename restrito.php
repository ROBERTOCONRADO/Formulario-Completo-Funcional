<?php 
require('config/conexao.php'); 

//VERIFICAÇÃO DE AUTENTICAÇÃO
$userr = auth($_SESSION['TOKEN']);
if ($userr) {
    echo "<h1>SEJA BEM-VINDO <b style='color:red'>".$userr['nome']."!</b></h1>";
    echo "<br><br><a style='background: green; padding: 10px; cursor:pointer; color: white; border-radius: 5px; text-decoration: none;' href='logout.php'>Sair do sistema</a>";
}else {
    //REDIRECIONAR PARA LOGIN
    header('location: index.php?');
}


/*
//VERIFICAR SE TEM AUTORIZAÇÃO
$sql = $pdo->prepare("SELECT * FROM usuarios WHERE token=? LIMIT 1");
$sql->execute(array($_SESSION['TOKEN']));
$usuario = $sql->fetch(PDO::FETCH_ASSOC);

//SE NÃO ENCONTAR USUARIO
if(!$usuario) {
    header('location: index.php?'); 
}else {
    echo "<h1>SEJA BEM-VINDO <b style='color:red'>".$usuario['nome']."!</b></h1>";
    echo "<br><br><a style='background: green; padding: 10px; cursor:pointer; color: white; border-radius: 5px; text-decoration: none;' href='logout.php'>Sair do sistema</a>";
}
*/