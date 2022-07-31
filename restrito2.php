<?php 
require('config/conexao.php'); 

//VERIFICAÇÃO DE AUTENTICAÇÃO
$userr = auth($_SESSION['TOKEN']);
if ($userr) {
    echo "<h1>ESSA È A PÀGINA RESTRITA </h1>";
    echo "<br><br><a style='background: green; padding: 10px; cursor:pointer; color: white; border-radius: 5px; text-decoration: none;' href='logout.php'>Sair do sistema</a>";
}else {
    //REDIRECIONAR PARA LOGIN
    header('location: index.php?');
}