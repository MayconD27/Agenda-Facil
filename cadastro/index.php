<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../main-style/index.css">
    <link rel="stylesheet" href="style/container.css">
    <title>Go</title>
</head>
<body>
    <form>
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
<div class="dots">
    <div class="dot" id="dot1" style="display:flex">1</div>
    <div class="dot" id="dot2" style="display:none">2</div>
    <div class="dot" id="dot3"style="display:none">3</div>
                </div>

    <script src="script/script.js"></script>
    <script src="script/intera.js"></script>
</body>
</html>