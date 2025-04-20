<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela inicial</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <link rel="stylesheet" href="../main-style/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href=" 	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../main-style/inicio.css">
    <link rel="stylesheet" href="../main-style/menu.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php
        date_default_timezone_set('America/Sao_Paulo');
        $data = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d');

        include_once '../bd.php';
        session_start();
        $usuarioLogado = isset($_SESSION['logado']) ?  $_SESSION['logado'] : false;

        if($usuarioLogado== false){
            header('location: ../Login');
            exit;
        }
    //Tools
    include_once "../tools/menu.php";              
    ?>
    
    <main class="container-main">
        <button class="btn filter" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Filtrar">
            <i class="bi bi-funnel-fill"></i>
        </button>
        <a href="../cadastro" class="btn-cadastro" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cadastrar agendamento">
            <h5>Cadastrar</h5> <i class="bi bi-plus-lg"></i>
        </a>
        <h5 class="timer">
            <?php
                $dateObject = DateTime::createFromFormat('Y-m-d', $data);
                $dataFormatada = $dateObject->format('d/m/Y');
                echo $dataFormatada;
            ?>
        </h5> 
        <table>
            <thead>
                <tr class="cabecalho">
                    <th>Horario</th>
                    <th>Cliente</th>
                    <th>Procedimento</th>
                    <th ><i class="bi bi-gear"></i></th>
                </tr>

            </thead>
            <tbody>
                <?php
                    include_once 'bd.php';  

                    $stmt = $bd->prepare("SELECT * FROM agendamento WHERE data = :data_agend");
                    $stmt->execute([':data_agend' => $data]);
                    $agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    

                    $horarios = ['07:00:00', '08:00:00', '09:00:00', '10:00:00', '11:00:00','12:00:00','13:00:00','14:00:00','15:00:00','16:00:00','17:00:00','18:00:00','19:00:00'];
                    $qnt = 0;
                    foreach ($horarios as $indece => $h) {
                        $encontrado = false; // Rastreia se o horário foi encontrado

                        foreach ($agendamentos as $agendamento) {
                            $id = $agendamento['id_agenda'];
                            $horario = $agendamento['horario']; 
                            $nome = $agendamento['nome_cliente'];
                            $telefone = $agendamento['telefone'];
                            $quantidade = $agendamento['qnt_horario'];
                            $procedimento = $agendamento['procedimento'];

                            if ($horario==$h) {
                                $qnt  = $quantidade;

                                echo "
                                    <tr class='linhaCorpo'>  
                                        <td class='lineHorario'>$horario</td>
                                        <td rowspan='$quantidade'>$nome</td>
                                        <td rowspan='$quantidade'>$procedimento</td>
                                        <td rowspan='$quantidade' class='ferramentas'>
                                            <a onclick='Deletar($id)' class='trash' data-bs-toggle='tooltip' data-bs-placement='right' data-bs-title='Remover agendamento'>
                                                <i class='bi bi-trash'></i></a>
                                            
                                            <a target='_blank' href='https://api.whatsapp.com/send?phone=$telefone&text=Olá $nome, estamos entrando em contato para confirmar seu agendamento que terá inicio as $h' class='contact' data-bs-toggle='tooltip' data-bs-placement='right' data-bs-title='Enviar mensagem'>
                                                <i class='bi bi-whatsapp'></i>
                                            </a>
                                        </td>
                                    </tr> 
                                ";
                                $encontrado = true;
                                break; 
                            }
                        }


                            if (!$encontrado) {
                                if($qnt>1){
                                    $qnt --;
                                    echo "
                                        <tr class='linhaCorpo'>
                                            <td class='lineHorario'>$h </td>
                                        </tr>
                                    ";
                                    continue;
                                }else{
                                    echo "
                                    <tr class='linhaCorpo'>
                                        <td class='lineHorario'>$h </td>
                                        <td class='vago' colspan='3'>Horario Vago</td>
                                    </tr>
                                    ";
                                }
                                
                            }
                    }
                ?>
            </tbody>
        </table>
        <footer>&copy;2024 Agenda Fácil</footer>
        <!--Botão que direciona para tela de cadastro--> 
    </main>  


<script>
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });


function Deletar(id){
    Swal.fire({
        title: "Tem certeza que deseja remover o agendamento?",
        showDenyButton: true,
        confirmButtonText: "Remover",
        denyButtonText: `Cancelar`,
        customClass: {
        confirmButton: 'swal2-confirma',  
        denyButton: 'swal2-cancel'   
    },
    }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
        Swal.fire("Agendamento apagado", "", "success");
        window.location.href = `delete.php?id=${id}`;
    } else if (result.isDenied) {
        Swal.fire("Remoção cancelada", "", "info");
    }
    });
}
  
</script>
 

</body>
</html>