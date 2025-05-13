<?php
 include_once '../bd.php';
 session_start();
 $usuarioLogado = isset($_SESSION['logado']) ?  $_SESSION['logado'] : false;

 if($usuarioLogado== true){
     header('location: ../main');
     exit;
 }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="../main-style/index.css">
    <title>Pratica tela de login</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
                <form>
                <h1>Agenda Facil</h1>
                <p class="desc">Veja sobre as vantagens do nosso app</p>
                <ul class="listaApp">
                    <li>Feito para facilitar sua vida</li>
                    <li>Mais praticidade</li>
                    <li>Intuitivo</li>
                    <li>Dinamico</li>
                </ul>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="logar.php" method="POST">
                <h1>Login</h1>

                <p class="desc">Use seus dados ja cadastrados.</p>
                <input type="email" placeholder="Email" name='email'>
                <input type="password" placeholder="Senha" name='senha'>
                <button type='submit'>Entrar</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Voltar ao Login</h1>
                    <p>Entre com seus dados ja cadastrados.</p>
                    <button class="hidden" id="login"> Entrar</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Agenda Fácil</h1>
                    <p>Veja as funcionalidades do nosso app.</p>
                    <button class="hidden" id="register">Saiba mais</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>