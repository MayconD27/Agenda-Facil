<?php
    include_once '../bd.php';
    session_start();
    $usuarioLogado = isset($_SESSION['logado']) ?  $_SESSION['logado'] : false;

    if($usuarioLogado== false){
        header('location: ../Login');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de usuários</title>
    <link rel="stylesheet" href="../main-style/index.css">
    <link rel="stylesheet" href="../main-style/menu.css">
    <link rel="stylesheet" href="./style/cadUser.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href=" 	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php
        //tools
        include_once "../tools/menu.php";
    ?>

<main class="cad-container">
    <div class="btn-container">
        <a href="cadastrar.php">Cadastrar usuário</a>
    </div>
    <div class="users-container">
        <a href="usuario.php" class="user-item">
            <h5>Nome do usuário</h5>
            <div class="info-ativo">
                <div class="dot active"></div>
                <p class="info-text">Ativo</p>
            </div>
        </a>
    </div>
</main>
</body>
</html>