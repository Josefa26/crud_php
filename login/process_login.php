<?php
session_start();

// Inclui a conexão com o banco de dados
require_once '../banco/connection.php';

// Verifica se o email e a senha foram fornecidos
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepara e executa a declaração SQL para recuperar o usuário do banco de dados
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário existe e se a senha está correta
    if ($user && password_verify($password, $user['password'])) {
        // Define as variáveis de sessão para o usuário
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role_id'] = $user['role_id'];

        // Redireciona para a página de administrador se o usuário for um administrador, caso contrário, redireciona para a página do usuário
        if ($_SESSION['role_id'] == 1) {
            header("Location: ../pages/admin_page.php");
            exit();
        } else {
            header("Location: ../pages/user_page.php");
            exit();
        }
    } else {
        // Define a mensagem de erro de login se o email ou a senha estiverem incorretos
        $_SESSION['login_error'] = "Email ou senha inválidos, tente novamente.";
        header("Location: ./loginpage.php?error=1");
        exit();
    }
} else {
    // Redireciona para a página de login se o email ou a senha não forem fornecidos
    header("Location: ./loginpage.php?error=2");
    exit();
}
?>
