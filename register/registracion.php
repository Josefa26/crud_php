<?php
session_start();
echo "Sessão iniciada.<br>";

// Inclui a conexão com o banco de dados
require_once '../banco/connection.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extrai os dados do formulário
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Verifica se as senhas coincidem
    if ($password !== $confirm_password) {
        $_SESSION['register_error'] = "As senhas não coincidem.";
        header("Location: ../index.php");
        exit();
    }

    // Verifica se o email já existe
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $existing_user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($existing_user) {
        $_SESSION['register_error'] = "O email já está registrado. Por favor, escolha outro email.";
        header("Location: ../index.php");
        exit();
    }

    // Criptografa a senha de forma segura
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insere o novo usuário no banco de dados
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$username, $email, $hashed_password])) {
        $_SESSION['register_success'] = "Registrado com sucesso! Faça login para acessar sua conta.";
        header("Location: ../login/loginpage.php");
        exit();
    } else {
        $_SESSION['register_error'] = "Ocorreu um erro ao registrar o usuário. Por favor, tente novamente.";
        header("Location: ../index.php");
        exit();
    }
} else {
    // Redireciona para a página de registro se o formulário não for enviado
    header("Location: ../index.php");
    exit();
}
?>
