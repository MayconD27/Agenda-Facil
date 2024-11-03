<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../main-style/index.css">
    <link rel="stylesheet" href="style/container.css">
    <link rel="stylesheet" href="style/dots.css">
    <title>Cadastro de Horario</title>
</head>
<body>
    <a href="../" class="back"><i class="bi bi-arrow-left-short"></i></a>
    <form action="inserirAgendamento.php" method="POST">
        <div class="container-etapas">
        <!--Etapa 1-->    
        <div class="etapa" id="etapa1">
            <?php include_once 'etapas/passo01.php'; ?>

        </div>

        <!--Etapa 2--> 
        <div class="etapa" id="etapa2" style="display: none;">
            <?php include_once 'etapas/passo02.php'; ?>
            
        </div>

        <!--Etapa 3--> 
        <div class="etapa" id="etapa3" style="display: none;">
            <?php include_once 'etapas/passo03.php'; ?>
        </div>

        <!--Etapa Final--> 
        <div class="etapa" id="etapaEnd" style="display: none;">
            <?php include_once 'etapas/conclusao.php' ?>
        </div>
    </div>

    <!--Botoões-->
        <div class="btns">
            <button id="next" type="button">Proximo</button>
            <button id="back" style="display: none;" type="button">Anterior</button>
        </div>

</form>
<?php include_once 'dots/dot.php'?>



    <script src="script/script.js"></script>
    <script src="script/intera.js"></script>
</body>
</html>