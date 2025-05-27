<?php
        session_start();
        $usuarioLogado = isset($_SESSION['logado']) ?  $_SESSION['logado'] : false;

        if($usuarioLogado== false){
            header('location: ../Login');
            exit;
        }
       $isAdm = isset($_SESSION['adm']) && intval($_SESSION['adm']) == 0  ?  true : false;
        if($isAdm == false){
            header('location: ../main');
            exit;
        }

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar usuario</title>
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
    <form action="./cad-user.php" method="post">
        <h2 class="full-width text-center">Cadastro de cliente</h2>
        <div class="form-group p-5 row">
            <div class="col-12 mb-2">
                <label>Nome do usuário</label>
                <input class="form-control" name="nome" type="text" placeholder="Nome do usuário">
            </div>
            <div class="col-12 col-md-6 mb-2">
                <label>E-mail:</label>
                <input class="form-control" name="email" type="email" placeholder="Email de acesso">
            </div>
            <div class="col-12 col-md-6 mb-2">
                <label>Senha: </label>  
                <input class="form-control" name="senha" type="password" placeholder="Senha">        
            </div>
            <div class="col-12 mb-2">
                <label>Tipo de usuário</label>
                <select name="tipo" class="form-control">
                    <option value="">Selecione</option>
                    <option value="0">Usuário normal</option>
                    <option value="1">Admin</option>
                </select>
            </div>
        </div>
        <button class="btn btn-primary col-12">Cadastrar</button>
    </form>
</body>
</html>