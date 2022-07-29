<?php
require('config/conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <title>Login</title>
</head>
<body>
    <form action="">
        <h1>Login</h1>
        <!--Condição para que apareça a div-->
        <?php if (isset($_GET['result']) && ($_GET['result']== "ok")) { ?>
            <div class="sucesso animate__animated animate__rubberBand">
            Usuário Cadastrado com sucesso!
            </div>
        <?php }?>
        
        
        

        <div class="input-group">
            <img class="input-icon" src="./css/img/login.png" alt="login">
            <input type="text" placeholder="Nome Completo">
        </div>

        <div class="input-group">
            <img class="input-icon" src="./css/img/lock.png" alt="password">
            <input type="password" placeholder="Digite sua senha">
        </div>
        
        <button class="btn-blue" type="submit">Fazer Login</button>
        <a href="cadastrar.php">Ainda não tenho cadastro</a>
    </form>
    <!--Chamando o jQuery-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!--Mesma condição para desaparecer a div-->
    <?php if (isset($_GET['result']) && ($_GET['result']== "ok")) { ?>
        <script>
            setTimeout(() => {
                //$('.sucesso').hide();
                $('.sucesso').addClass('animate__hinge');                
            }, 3000);
        </script>
    <?php }?>    
</body>
</html>