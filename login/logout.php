<?php
// Começa a session
session_start();

// desativa todas as varíaveis de sessão
$_SESSION = array();

// Destroi a sessão
session_destroy();

// Redireciona para a pagína de login
header("Location: ../login/loginpage.php");
exit;
?>
