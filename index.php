<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Criar Conta</h2>
        <hr>

        <!-- Exibir mensagem de sucesso de registro, se disponível -->
        <?php if (isset($_SESSION['register_success'])) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['register_success']; ?>
            </div>
            <?php unset($_SESSION['register_success']); ?>
        <?php endif; ?>

        <!-- Exibir mensagem de erro de registro, se disponível -->
        <?php if (isset($_SESSION['register_error'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['register_error']; ?>
            </div>
            <?php unset($_SESSION['register_error']); ?>
        <?php endif; ?>

        <!-- Formulário de registro -->
        <form method="post" action="./register/registracion.php">
            <div class="form-group">
                <label for="username">Nome de Usuário</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmar Senha</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>

        <!-- Link para a página de login -->
        <p class="mt-3">Já tem uma conta? <a href="./login/loginpage.php">Faça login aqui</a>.</p>
    </div>

    <!-- Bootstrap JS (opcional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
