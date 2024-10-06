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
            <button>Hoje</button>
            
            <form action="">
            <div>
                <legend>Filtrar data</legend>
                <input type="date">
                <button>Filtrar</button>
            </div>
            </form>
        </nav>

        <section class="agendamentos">

        </section>

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