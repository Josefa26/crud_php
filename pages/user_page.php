<?php
session_start();

// Verifica se o usuário está logado e tem papel de admmin , se não, ele é rederesioando para a pagína de login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/loginpage.php");
    exit();
}

//Inclui a conexão com o banco de dados
require_once '../banco/connection.php';

// Function para pegar os dados do banco de dados
function getAllTableData($pdo) {
    $stmt = $pdo->query("SELECT * FROM `NOTAS DE CORTE - PROCESSO SELETIVO SISU 2022.1 - UNILAB`");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Pega os dados da  tabela
$tableData = getAllTableData($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page - Visualizar Dados</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>User Page - NOTAS DE CORTE - PROCESSO SELETIVO SISU 2022.1 - UNILAB</h2>
        <hr>
        <!-- Tabela para exibir os dados-->
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Campus</th>
                    <th>Cod. Curso</th>
                    <th>Curso</th>
                    <th>Turno</th>
                    <th>Formação</th>
                    <th>Cota</th>
                    <th>Corte Ch Regular</th>
                    <th>Corte Final</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tableData as $row): ?>
                    <tr>
                        <td><?= $row['Campus'] ?></td>
                        <td><?= $row['Cod. Curso'] ?></td>
                        <td><?= $row['Curso'] ?></td>
                        <td><?= $row['Turno'] ?></td>
                        <td><?= $row['Formação'] ?></td>
                        <td><?= $row['Cota'] ?></td>
                        <td><?= $row['Corte Ch Regular'] ?></td>
                        <td><?= $row['Corte Final'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <!-- Botão de logout-->
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#logoutModal">Sair</button>
        
        <!-- Modal de confirmação do logout -->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="logoutModalLabel">Confirmar saída</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Tem certeza que quer sair?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <form method="post" action="../login/logout.php">
                            <button type="submit" class="btn btn-danger">Sair</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
