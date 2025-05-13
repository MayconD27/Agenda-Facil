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
    <div class="btn-container mb-5">
        <a href="cadastrar.php">Cadastrar usuário</a>
    </div>
    <div class="users-container">
        <?php

            // Defina o número de itens por página
            $por_pagina = 10;

            // Pegue o número da página atual pela URL, padrão é 1
            $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            if ($pagina < 1) $pagina = 1;

            // Calcule o OFFSET
            $offset = ($pagina - 1) * $por_pagina;

            // Pegue o total de usuários para calcular o total de páginas
            $total_usuarios = $bd->query("SELECT COUNT(*) FROM usuario")->fetchColumn();
            $total_paginas = ceil($total_usuarios / $por_pagina);

            // Prepare a consulta com LIMIT e OFFSET
            $sql = "SELECT id_user, nome, email, ativo FROM usuario LIMIT :limit OFFSET :offset";
            $resultado = $bd->prepare($sql);
            $resultado->bindValue(':limit', $por_pagina, PDO::PARAM_INT);
            $resultado->bindValue(':offset', $offset, PDO::PARAM_INT);
            $resultado->execute();

            foreach($resultado as $r){
                $id = $r['id_user'];
                $nome = $r['nome'];
                $ativo = $r['ativo'];
                $email = $r['email'];
        ?>
        <a href="usuario.php?id=<?=$id;?>" class="user-item">
            <div class="text">
                <h5><?=$nome; ?></h5>
                <p> <?= $email; ?></p>
            </div>
            <div class="info-ativo">
                <div class="dot <?= $ativo ==1 ? "active" : "noactive"; ?>"></div>
                <!--<p class="info-text"><?= $ativo ==1 ? "Ativo" : "Desativado"; ?></p>-->
            </div>
        </a>
        <?php } ?>
    </div>
    
    <div class="pagination">
        <?php if ($pagina > 1): ?>
            <a class="dot" href="?pagina=1">&laquo;</a>
            <a class="dot" href="?pagina=<?= $pagina - 1 ?>">&lsaquo;</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
            <a href="?pagina=<?= $i ?>" class="dot <?= $pagina == $i ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <?php if ($pagina < $total_paginas): ?>
            <a class="dot" href="?pagina=<?= $pagina + 1 ?>">&rsaquo;</a>
            <a class="dot" href="?pagina=<?= $total_paginas ?>">&raquo;</a>
        <?php endif; ?>
    </div>


</main>
</body>
</html>