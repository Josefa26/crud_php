<?php
// Configuração do banco de dados
$host = '127.0.0.1';
$db = 'crud_josefa';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

// Nome da Fonte de Dados (DSN)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Opções do PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Cria uma instância do PDO
    $pdo = new PDO($dsn, $user, $pass, $options);
   
} catch (PDOException $e) {
    // Lida com erro de conexão
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
?>
