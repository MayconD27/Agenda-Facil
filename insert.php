
<?php
    $numTel = $_POST['telefone'];     
    //pega nome do cliente
    $nome = $_POST['nome'];
    //infoAgendamento
    $procedimento = $_POST['procedimento'];
    $data = $_POST['data_agnd'];
    $horario = $_POST['horas'];
    $qntAgend = 1;

    include_once './Sistema/bd.php';

        
        $stmtInsertAgnd = $bd->prepare("INSERT INTO agendamento (procedimento_id, data, horario, qnt_horario, nome_cliente, telefone) VALUES (:procedimento, :data_agend, :horario, :qnt_h, :nomeCli, :tel)");

        // Colocar o Parâmetro
        $stmtInsertAgnd->bindParam(':procedimento', $procedimento);
        $stmtInsertAgnd->bindParam(':data_agend', $data);
        $stmtInsertAgnd->bindParam(':horario', $horario);
        $stmtInsertAgnd->bindParam(':qnt_h', $qntAgend);
        $stmtInsertAgnd->bindParam(':tel', $numTel);
        $stmtInsertAgnd->bindParam(':nomeCli', $nome);

        $stmtInsertAgnd->execute();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Agendamento Confirmado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap + Ícones -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #134e4a;
            --second-color: #0d9488;
            --third-color: #ccfbf1;
            --bkg-color: #fff;
            --font-color: #333;
        }

        body {
            background-color: var(--third-color);
            color: var(--font-color);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .confirm-box {
            background-color: var(--bkg-color);
            border: 2px solid var(--second-color);
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .confirm-box h1 {
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .btn-voltar {
            margin-top: 20px;
            background-color: var(--second-color);
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 10px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-voltar:hover {
            background-color: var(--primary-color);
            color: white;
        }
    </style>
</head>
<body>
    <div class="confirm-box">
        <h1><i class="bi bi-check-circle-fill text-success"></i> Agendamento realizado com sucesso!</h1>
        <a href="./" class="btn-voltar">
            <i class="bi bi-arrow-left-circle"></i> Voltar para o início
        </a>
    </div>
</body>
</html>
