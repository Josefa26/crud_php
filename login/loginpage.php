<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <!-- Exibir mensagem de erro caso exista -->
        <?php if (isset($_SESSION['login_error'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['login_error']; ?>
            </div>
            <?php unset($_SESSION['login_error']); ?>
        <?php endif; ?>
        
        <h2>Login</h2>
        <hr>

        <!-- Login form -->
        <form method="post" action="../login/process_login.php">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>

        <!-- Link para a pagína de registro -->
        <p class="mt-3">Não tem uma conta? <a href="../index.php">Registre-se</a>.</p>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
