<?php
require('config/conexao.php');

//VERIFICAR SE A POSTAGEM EXISTE DE ACORDO COM OS CAMPOS
if(isset($_POST['nomeCompleto']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
//VERIFICAR SE TODOS OS CAMPOS FORAM PREENCHIDOS
    if(empty($_POST['nomeCompleto']) && empty($_POST['email']) && empty($_POST['password']) && empty($_POST['confirm_password'])  && empty($_POST['termos'])) {
         
    }
}
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
    <title>Cadastrar</title>
</head>
<body>
    <form method="post">
        <h1>Cadastrar</h1>

        <div class="erro-geral animate__animated animate__tada">
            Avisos de erro!
        </div>

        <div class="input-group">
            <img class="input-icon" src="./css/img/nome-C.png" alt="login">
            <input type="text" placeholder="Nome Completo" name="nomeCompleto" required>
            <div class="erro">Insira um nome valido</div>
        </div>

        <div class="input-group">
            <img class="input-icon" src="./css/img/email.png" alt="login">
            <input type="email" placeholder="Seu melhor Email" name="email" required>
        </div>

        <div class="input-group">
            <img class="input-icon" src="./css/img/senha1.png" alt="login">
            <input type="password" placeholder="Digite uma Senha" name="password"
            required>
        </div>

        <div class="input-group">
            <img class="input-icon" src="./css/img/senha2.png" alt="login">
            <input type="password" placeholder="Confirmar Senha"
            name="confirm_password" required>
        </div>

        <div class="input-group">
            <input type="checkbox" name="termos" id="termos" value="ok" required>
            <label for="termos">
                Ao se cadastrar você concorda com a nossa <a href="#" class="link">Política de Privacidade</a> e os <a href="#" class="link" >Termos de uso.</a>
            </label>
        </div>
        
        <button class="btn-blue" type="submit">Cadastrar</button>
        <a href="index.php">Já tenho uma conta</a>
    </form>
</body>
</html>