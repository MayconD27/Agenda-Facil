<?php
        include_once '../bd.php';
        session_start();
        $usuarioLogado = isset($_SESSION['logado']) ?  $_SESSION['logado'] : false;

        if($usuarioLogado== false){
            header('location: ../Login');
            exit;
        }
       $isAdm = isset($_SESSION['adm']) && intval($_SESSION['adm']) === 0;
        if(!
        $isAdm){
            header('location: ../main');
            exit;
        }

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar usuario</title>
    <link rel="stylesheet" href="../main-style/index.css">
    <link rel="stylesheet" href="../main-style/menu.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href=" 	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    .delete{
        background-color: var(--primary-color);
        width: 50px;
        height: 50px;
        border: none;
        border-radius: 50%;
        display:flex;
        justify-content:center;
        align-items: center;
        color:#fff;
        font-size:20px;
    }
</style>
<body>
    <?php
        //tools
        include_once "../tools/menu.php";
    ?>
    <main class="cad-container">
        <div class="btn-container mb-5">
            
            <button class="d-flex align-items-center" onclick="AddProcedimento()">
                <i class="bi bi-plus-lg" style="margin-right:5px;"></i>
                <p class="m-0">Novo Procedimento</p>
            </button>
        </div>
        <div class="users-container">
            <?php
                // Definir paginação
                $por_pagina = 10;
                $pagina = isset($_GET['pagina']) && is_numeric($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                $offset = ($pagina - 1) * $por_pagina;

                // Sua consulta
                $sql = "SELECT id, procedimento, hora FROM procedimento LIMIT :limit OFFSET :offset";
                $resultado = $bd->prepare($sql);
                $resultado->bindValue(':limit', $por_pagina, PDO::PARAM_INT);
                $resultado->bindValue(':offset', $offset, PDO::PARAM_INT);
                $resultado->execute();
                    foreach($resultado as $r){
                        $id = $r['id'];
                        $procedimento = $r['procedimento'];
                        $hora = $r['hora'];
                    ?>
                    
                        <div class="user-item">
                            <div class="text">
                                <h5><?= htmlspecialchars($procedimento); ?></h5>
                                <p><?= $hora; ?> hora<?= $hora > 1 ? 's' : ''; ?></p>
                            </div>
                            <button class="delete" onclick="onDeletar(<?=$id?>)">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>

                <?php } ?>
        </div>

    </main>
    <script>
        async function AddProcedimento(){
            Swal.fire({
            title: 'Registrar Procedimento',
            html: `
                <input id="procedimento" class="swal2-input" placeholder="Procedimento">
                <input id="tempo" type="number" class="swal2-input" placeholder="Tempo gasto (horas)">
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Salvar',
            confirmButtonColor: '#0d9488',
            preConfirm: () => {
                const procedimento = document.getElementById('procedimento').value;
                const tempo = document.getElementById('tempo').value;

                if (!procedimento || !tempo) {
                Swal.showValidationMessage('Preencha todos os campos');
                return false;
                }

                return { procedimento, tempo };
            }
            }).then(async (result) => {
            if (result.isConfirmed) {
                const dados = result.value;

                try {
                const response = await fetch('./cadastrar.php', {
                    method: 'POST',
                    headers: {
                    'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(dados)
                });

                if (!response.ok) {
                    throw new Error('Erro ao cadastrar procedimento');
                }

                const respostaApi = await response.json();

                Swal.fire({
                    title: 'Salvo!',
                    text: respostaApi.message || 'Procedimento cadastrado com sucesso!',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0d9488'
                });
                setTimeout(() => {
                window.location.reload();
                }, 2100);

                } catch (erro) {
                Swal.fire({
                    title: 'Erro',
                    text: erro.message || 'Ocorreu um erro ao salvar os dados.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#d33'
                });
                }
            }
            });

        }
        async function onDeletar(id) {
            const { isConfirmed } = await Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá reverter essa ação!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0d9488',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!',
                cancelButtonText: 'Cancelar'
            });

            if (!isConfirmed) return;

            try {
                const response = await fetch(`delete.php?id=${id}`, { method: 'GET' });

                if (response.ok) {
                await Swal.fire({
                    title: 'Deletado!',
                    text: 'Procedimento deletado com sucesso.',
                    icon: 'success',
                    confirmButtonColor: '#0d9488'
                });
                location.reload();
                } else {
                const errorText = await response.text();
                Swal.fire({
                    title: 'Erro!',
                    text: errorText || 'Erro ao deletar procedimento.',
                    icon: 'error',
                    confirmButtonColor: '#0d9488'
                });
                }
            } catch (error) {
                Swal.fire({
                title: 'Erro!',
                text: 'Erro na requisição: ' + error.message,
                icon: 'error',
                confirmButtonColor: '#0d9488'
                });
            }
            }

    </script>
</body>
</html>