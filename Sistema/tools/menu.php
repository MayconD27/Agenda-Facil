<?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        $isAdm = isset($_SESSION['adm']) && $_SESSION['adm'] == 0;
?>
<div class="menu">
    <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
        <i class="bi bi-list"></i>
    </button>
</div>

<div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="staticBackdropLabel">Agenda Fácil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        <nav class="itens-menu">
            <a href="../main">
                <i class="bi bi-house"></i>
                <span>Inicio</span>
            </a>

            <?php
                if($isAdm){
            ?>
                <a href="../cadastroUser">
                    <i class="bi bi-person-add"></i>
                    <span>Usuários</span>
                </a>
                <a href="../procedimento">
                    <i class="bi bi-boxes"></i>
                    <span>Procedimentos</span>
                </a>
            <?php }?>
        </nav>
        <div class="comands">
            <a href=""> <?= $_SESSION['nome'] ?> </a>
            <a href="../logout.php">
                <i class="bi bi-box-arrow-left"></i>
                <span>Sair</span>
            </a>
        </div>
    </div>
</div>