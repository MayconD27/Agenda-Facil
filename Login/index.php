<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="../main-style/index.css">
    <title>Pratica tela de login</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form>
                <h1>Agenda Facil</h1>
                <span>Ou use seus dados para se registrar.</span>
                <input type="text" placeholder="Nome">
                <input type="email" placeholder="Email">
                <input type="password" placeholder="Senha">
                <button>Cria conta</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form>
                <h1>Login</h1>

                <span>Use seus dados ja cadastrados.</span>
                <input type="email" placeholder="Email">
                <input type="password" placeholder="Senha">
                <button>Entrar</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Bem vindo de volta!</h1>
                    <p>Entre com seus dados ja cadastrados.</p>
                    <button class="hidden" id="login"> Entrar</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Agenda Fácil</h1>
                    <p>Registre com seus dados pessoais para facilitar futuros agendamentos.</p>
                    <button class="hidden" id="register"> Cadastrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>