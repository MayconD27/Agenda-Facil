<h1>Teste</h1>
<?php
    $numTel = $_POST['num-tel']; 
    $ddd = $_POST['ddd'];
    $telCompleto = $ddd.$numTel;
    

    //pega nome do cliente
    $nome = $_POST['nome-cli'];

    //infoAgendamento
    $procedimento = $_POST['procedimento'];
    $data = $_POST['dataCadastro'];
    $horario = $_POST['horario'];
    $qntAgend = $_POST['qntHorario'];

    include_once '../bd.php';
    $stmt = $bd->prepare("SELECT id FROM cliente Where telefone = :tel");
    $stmt->execute([':tel'=> $telCompleto]);
    //Gera a pesquisa
    $agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);


    if($agendamentos){
        $idCli = $agendamentos[0]['id'];
        $stmtInsert = $bd->prepare("INSERT INTO agendamento (procedimento, data, horario, qnt_horario, id_cliente) VALUES (:procedimento, :data_agend, :horario, :qnt_h, :id_cli)");

        // Colocar o Parâmetro
        $stmtInsert->bindParam(':procedimento', $procedimento);
        $stmtInsert->bindParam(':data_agend', $data);
        $stmtInsert->bindParam(':horario', $horario);
        $stmtInsert->bindParam(':qnt_h', $qntAgend);
        $stmtInsert->bindParam(':id_cli', $idCli);
        

        
        // Executar a consulta
        $stmtInsert->execute();
        header('location: ../');

    }else{
        $stmtInsert = $bd->prepare("INSERT INTO cliente (nome, telefone) VALUES (:nomeCli, :tel)");

        // Colocar o Parâmetro
        $stmtInsert->bindParam(':tel', $telCompleto);
        $stmtInsert->bindParam(':nomeCli', $nome);
        
        // Executa
        $stmtInsert->execute();
        
        // Obtém o ID do último registro inserido
        $idInserido = $bd->lastInsertId();

        $stmtInsertAgnd = $bd->prepare("INSERT INTO agendamento (procedimento, data, horario, qnt_horario, id_cliente) VALUES (:procedimento, :data_agend, :horario, :qnt_h, :id_cli)");

        // Colocar o Parâmetro
        $stmtInsertAgnd->bindParam(':procedimento', $procedimento);
        $stmtInsertAgnd->bindParam(':data_agend', $data);
        $stmtInsertAgnd->bindParam(':horario', $horario);
        $stmtInsertAgnd->bindParam(':qnt_h', $qntAgend);
        $stmtInsertAgnd->bindParam(':id_cli', $idInserido);

        $stmtInsertAgnd->execute();
        header('location: ../');
    }
?>