<?php
    include_once '../bd.php';
    $id = isset($_GET['id']) ? $_GET['id'] : false;
    $sql = "SELECT id_user, nome, email, adm, ativo FROM usuario WHERE id_user = :id LIMIT 1";

    // Prepara a consulta
    $resultado = $bd->prepare($sql);

    // Faz o bind dos parâmetros
    $resultado->bindParam(':id', $id);

    // Executa a consulta
    $resultado->execute();
    $result = $resultado->fetch();
    $nome_user = $result['nome'];
    $email_user =$result['email'];
    $id_user = $result['id_user'];
    $adm = $result['adm'];
    $ativo = $result['ativo'] == 1;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario | <?= $nome_user;?></title>
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
    <div class="main">
                            
            <h2 class="full-width text-center"><?=$nome_user?></h2>
        <div class="form-group p-5 row">
            <div class="col-12 mb-2">
                <label>Nome do usuário</label>
                <input class="form-control" name="nome" type="text" placeholder="Nome do usuário" value="<?=$nome_user?>">
            </div>
            <div class="col-12 col-md-6 mb-2">
                <label>E-mail:</label>
                <input class="form-control" name="email" type="email" placeholder="Email de acesso" value="<?=$email_user?>">
            </div>
            <div class="col-12 col-md-6 mb-2">
                <label>Senha: </label>  
                <input class="form-control" name="senha" type="password" placeholder="Senha" disabled>        
            </div>
            <div class="col-12 mb-2">
                <label>Tipo de usuário</label>
                <select name="tipo" class="form-control" value="1">
                    <option value="">Selecione</option>
                    <option value="0"<?= $adm == 0 ? "selected" :"";?> >Usuário normal</option>
                    <option value="1" <?= $adm == 1 ? "selected" :"";?> >Usuario administrador</option>
                </select>
            </div>
            <div class="col-12 d-flex form-check form-switch justify-content-end" style="gap:10px;">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" <?= $ativo ? "checked" : ""?> >
                <label class="form-check-label">Ativo</label>
            </div>
            <p class="col-12 text-center info-update">
                <strong>Esses são os dados do cliente.</strong>
                Nesta tela, além de visualizar as informações, você também pode editá-las.
                Basta selecionar o campo que deseja atualizar
            </p>
        </div>
    </div>
</body>
</html>