<?php
require('config/conexao.php');

//VERIFICAR SE A POSTAGEM EXISTE DE ACORDO COM OS CAMPOS
if(isset($_POST['nomeCompleto']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
//VERIFICAR SE TODOS OS CAMPOS FORAM PREENCHIDOS
    if(empty($_POST['nomeCompleto']) && empty($_POST['email']) && empty($_POST['password']) && empty($_POST['confirm_password'])  && empty($_POST['termos'])) {
         $erro_geral = "Todos os campos são obrigatórios!";
    }else {
        //RECEBER VALORES VINDO DOS POST E LIMPANDO VÁLORES
        $nome = limparPost($_POST['nomeCompleto']);
        $email = limparPost($_POST['email']);
        $senha = limparPost($_POST['password']);
        $senha_cript = sha1($senha);
        $repete_senha = limparPost($_POST['confirm_password']);
        $checkbox = limparPost($_POST['termos']);

        //VERIFICAR SE NOME É APENAS LETRAS E ESPAÇOS
        if (!preg_match("/^[a-zA-Z-' ]*$/",$nome)) {
            $erro_nome = "Somente letras e espaços em branco!";
          }

        //VERIFICAR SE EMAIL É VÁLIDO
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erro_email = "Formato de e-mail inválido!";
          }

        //VERIFICAR SE SENHA CONTÉM MINIMO 6 DÍGITOS
        if(strlen($senha) < 6) {
            $erro_senha = "A senha deve conter no mínimo 6 caracteres!";
        }

        //VERIFICAR SE SENHAS SÃO IGUAIS
        if($senha !== $repete_senha) {
            $erro_repete_senha = "Digite a mesma senha em ambos os campos!";
        }

        //VERIFICAR SE CHECKBOX FOI MARCADO
        if($checkbox !== "ok") {
            $erro_checkbox = "Desativado!";
        }

        if(!isset($erro_geral) && !isset($erro_nome) && !isset($erro_email) && !isset($erro_senha) && !isset($erro_repete_senha) && !isset($erro_checkbox)) {

            //VERIFICAR SE EMAIL JÁ ESTÁ CADASTRADO NO BANCO
            $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email=? LIMIT 1");
            $sql->execute(array($email));
            $user = $sql->fetch();

            //SE NÃO EXISTIR USUARIO - ADICIONAR AO BANCO
            if(!$user) {
                $recupera_senha = "";
                $token = "";
                $status = "novo";
                $data_cadastro = date('d/m/Y');

                $sql = $pdo->prepare("INSERT INTO usuarios VALUES (null,?,?,?,?,?,?,?)");
                
                if($sql->execute(array($nome,$email,$senha_cript,$recupera_senha,$token,$status,$data_cadastro))){
                    header('location: index.php?result=ok');
                }
            }else{
            //JÁ EXISTE USUARIO - APRESENTAR ERRO
                $erro_geral = "Usuário já cadastrado!";     
            }    
        }
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

        <?php if(isset($erro_geral)) { ?>
            <div class="erro-geral animate__animated animate__tada">
            <?php echo $erro_geral; ?>
            </div>
        <?php } ?>

        <div class="input-group">
            <img class="input-icon" src="./css/img/nome-C.png" alt="login">
            <input <?php if(isset($erro_geral) or isset($erro_nome)){echo 'class="erro-input"';}?> type="text" placeholder="Nome Completo" name="nomeCompleto" <?php if(isset($_POST['nomeCompleto'])){echo "value='$nome'";}?> required>
            <?php if(isset($erro_nome)){ ?>
            <div class="erro"><?php echo $erro_nome; ?></div>
            <?php } ?>
        </div>

        <div class="input-group">
            <img class="input-icon" src="./css/img/email.png" alt="login">
            <input <?php if(isset($erro_geral) or isset($erro_email)){echo 'class="erro-input"';}?> type="email" placeholder="Seu melhor Email" name="email" <?php if(isset($_POST['email'])){echo "value='$email'";}?> required>
            <?php if(isset($erro_email)){ ?>
            <div class="erro"><?php echo $erro_email; ?></div>
            <?php } ?>
        </div>

        <div class="input-group">
            <img class="input-icon" src="./css/img/senha1.png" alt="login">
            <input <?php if(isset($erro_geral) or isset($erro_senha)){echo 'class="erro-input"';}?> type="password" placeholder="Digite uma Senha" name="password" required>
            <?php if(isset($erro_senha)){ ?>
            <div class="erro"><?php echo $erro_senha; ?></div>
            <?php } ?>
        </div>

        <div class="input-group">
            <img class="input-icon" src="./css/img/senha2.png" alt="login">
            <input <?php if(isset($erro_geral) or isset($erro_repete_senha)){echo 'class="erro-input"';}?> type="password" placeholder="Confirmar Senha"
            name="confirm_password" required>
            <?php if(isset($erro_repete_senha)){ ?>
            <div class="erro"><?php echo $erro_repete_senha; ?></div>
            <?php } ?>
        </div>

        <div <?php if(isset($erro_geral) or isset($erro_checkbox)){echo 'class="input-group erro-input"';}else{'class="input-group"';}?>>
            <input type="checkbox" name="termos" id="termos" value="ok" required>
            <?php if(isset($erro_checkbox)){ ?>
            <div class="erro"><?php echo $erro_checkbox; ?></div>
            <?php } ?>
            <label for="termos">
                Ao se cadastrar você concorda com a nossa <a href="#" class="link">Política de Privacidade</a> e os <a href="#" class="link" >Termos de uso.</a>
            </label>
        </div>
        
        <button class="btn-blue" type="submit">Cadastrar</button>
        <a href="index.php">Já tenho uma conta</a>
    </form>
</body>
</html>