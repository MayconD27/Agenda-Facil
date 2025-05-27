<?php
        include_once '../bd.php';
        session_start();
        $usuarioLogado = isset($_SESSION['logado']) ?  $_SESSION['logado'] : false;

        if($usuarioLogado== false){
            header('location: ../Login');
            exit;
        }
       $isAdm = isset($_SESSION['adm']) && intval($_SESSION['adm']) == 0  ?  true : false;
        if($isAdm== false){
            header('location: ../main');
            exit;
        }

?>
<?php

    $id = isset($_GET['id']) ? $_GET['id'] : false;
    $message_update = "";
    $update = isset($_GET['update']) ? $_GET['update'] : "";
    if(!empty($update)){
        $message_update = "Campo atualizado com sucesso";
    }
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
            <p  class="full-width text-center"><?= $message_update; ?></p>                
            <h2 class="full-width text-center"><?=$nome_user?></h2>
        <div class="form-group p-5 row">
            <div class="col-12 mb-2">
                <label>Nome do usuário</label>
                <input class="form-control" name="nome" type="text" placeholder="Nome do usuário" value="<?=$nome_user?>" onchange="onUpdate(<?= $id;?>,'nome',this.value)">
            </div>
            <div class="col-12 col-md-6 mb-2">
                <label>E-mail:</label>
                <input class="form-control" nam-e="email" type="email" placeholder="Email de acesso" value="<?=$email_user?>" onchange="onUpdate(<?= $id;?>,'email',this.value)">
            </div>
            <div class="col-12 col-md-6 mb-2">
                <label>Senha: </label> 
                <div class="row">
                    <input id="password" class="form-control col" style="margin-right:10px;" name="senha" type="password" placeholder="Senha" disabled onclick="HabilitInput()" onchange="onUpdate(<?= $id;?>,'senha',this.value)">        
                    <button class="btn btn-primary rounded-circle col-auto" style="border:none; width:40px; height:40px;" onclick="HabilitInput()"><i class="bi bi-pencil-square"></i></button>     
                </div> 
            </div>
            <div class="col-12 mb-2">
                <label>Tipo de usuário</label>
                <select name="tipo" class="form-control" onchange="onUpdate(<?= $id;?>,'adm',this.value)">
                    <option value="">Selecione</option>
                    <option value="0"<?= $adm == 0 ? "selected" :"";?> >Usuário normal</option>
                    <option value="1" <?= $adm == 1 ? "selected" :"";?> >Usuario administrador</option>
                </select>
            </div>
            <div class="col-12 d-flex form-check form-switch justify-content-end" style="gap:10px;">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" <?= $ativo ? "checked" : ""?> onchange="onUpdate(<?= $id;?>,'ativo',this.checked ? 1: 0)">
                <label class="form-check-label">Ativo</label>
            </div>
            <p class="col-12 text-center info-update">
                <strong>Esses são os dados do cliente.</strong>
                Nesta tela, além de visualizar as informações, você também pode editá-las.
                Basta selecionar o campo que deseja atualizar
            </p>
        </div>
    </div>
<script>
    async function onUpdate(id, field, value){
        const response = await fetch(`./update.php?field=${field}&value=${value}&id=${id}`);
        if(response.ok){
            // Exibe mensagem com SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'Atualizado!',
                text: 'Campo atualizado com sucesso',
                timer: 2000,
                showConfirmButton: false
            });
            setTimeout(() => {
                window.location.reload();
            }, 2100);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Ocorreu um erro ao atualizar o campo',
            });
        
        }
        
    }
    function HabilitInput(){
        console.log('1')
        const password = document.querySelector("#password");
        password.removeAttribute("disabled");
    }
</script>

</body>
</html>