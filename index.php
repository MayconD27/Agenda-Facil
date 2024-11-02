<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela inicial</title>
    <link rel="stylesheet" href="main-style/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href=" 	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="main-style/inicio.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <main class="container-main">
        <nav class="menu">
            <div class="dia">
                <div class="antes"><</div>
                <button>Hoje</button>
                <div class="depois">></div>
            </div>
            
            
            <form action="">
            <div>
                <input type="date">
                <button>Filtrar pela data</button>
            </div>
            </form>
        </nav>
        <table>
            <thead>
                <tr class="cabecalho">
                    <th>Horario</th>
                    <th>Cliente</th>
                    <th>Contato</th>
                    <th><i class="bi bi-gear"></i></th>
                </tr>

            </thead>
            <tbody>
                <?php
                    include_once './bd.php';
                    $num = 7;

                    while ($num <= 19) {
                        
                        if($num ==15){
                            echo "
                            <tr class='linhaCorpo'>
                                <td class='lineHorario'>$num:00</td>
                                <td  class='vago' colspan='3'>Horario Vago</td>
                            </tr>
                            ";         
                        }
                        if ($num == 8) {
                            echo "
                            <tr class='linhaCorpo'>
                                <td class='lineHorario'>$num:00</td>
                                <td rowspan='2'>Cliente $num</td>
                                <td rowspan='2'>Telefone $num</td>
                                <td rowspan='2'class='ferramentas'>
                                    <a href='' class='trash' data-bs-toggle='tooltip' data-bs-placement='right' data-bs-title='Apagar'><i class='bi bi-trash'></i></a>
                                    <a href='' class='contact' data-bs-toggle='tooltip' data-bs-placement='right' data-bs-title='Enviar mensagem'><i class='bi bi-whatsapp'></i></a>
                                </td>
                            </tr>
                            ";
                            // Linha seguinte com horário diferente
                            $num++;
                            echo "
                            <tr class='linhaCorpo'>
                                <td class='lineHorario'>$num:00</td>
                            </tr>
                            ";
                        } else {
                            echo "
                            <tr class='linhaCorpo'>
                                <td class='lineHorario'>$num:00</td>
                                <td>Cliente $num</td>
                                <td>Telefone $num</td>
                                <td class='ferramentas'>
                                    <a href='' class='trash' data-bs-toggle='tooltip' data-bs-placement='right' data-bs-title='Apagar'><i class='bi bi-trash'></i></a>
                                    <a href='' class='contact' data-bs-toggle='tooltip' data-bs-placement='right' data-bs-title='Enviar mensagem'><i class='bi bi-whatsapp'></i></a>
                                </td>
                            </tr>
                            ";
                        }
                        $num++;
                    }
                    
                  
                ?>
            </tbody>
        </table>
        <footer>&copy;2024 Agenda Fácil</footer>
        <!--Botão que direciona para tela de cadastro-->
        <a href="cadastro" class="btn-cadastro" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cadastro">
            <i class="bi bi-plus-lg"></i>
        </a>

    </main>  

    
<script>
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
</script>
 

</body>
</html>