<?php
session_start();

// Verifica se o usuário está logado e tem papel de admmin , se não, ele é rederesioando para a pagína de login

if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header("Location: ../login/loginpage.php");
    exit();
}

// Faz a requisição da conexão do banco
require_once '../banco/connection.php';

// Deleta o registro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codCurso = $_POST['codCurso'];

    $sql = "DELETE FROM `NOTAS DE CORTE - PROCESSO SELETIVO SISU 2022.1 - UNILAB` WHERE `Cod. Curso`=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$codCurso]);
    header("Location: ../pages/admin_page.php");
    exit();
}
?>
