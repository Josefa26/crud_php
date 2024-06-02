<?php
session_start();

// Verifica se o usuário está logado e tem papel de admmin , se não, ele é rederesioando para a pagína de login
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header("Location: ./login/loginpage.php");
    exit();
}

// Faz a requisição da conexão do banco
require_once '../banco/connection.php';

// Adiciona registro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $campus = $_POST['Campus'];
    $codCurso = $_POST['CodCurso'];
    $curso = $_POST['Curso'];
    $turno = $_POST['Turno'];
    $formacao = $_POST['Formacao'];
    $cota = $_POST['Cota'];
    $corteChRegular = $_POST['CorteChRegular'];
    $corteFinal = $_POST['CorteFinal'];

    $sql = "INSERT INTO `NOTAS DE CORTE - PROCESSO SELETIVO SISU 2022.1 - UNILAB` (Campus, `Cod. Curso`, Curso, Turno, Formação, Cota, `Corte Ch Regular`, `Corte Final`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$campus, $codCurso, $curso, $turno, $formacao, $cota, $corteChRegular, $corteFinal]);
    header("Location: ../pages/admin_page.php");
    exit();
}
?>
