<?php
session_start();

// Verifica se o usuário está logado e tem papel de admmin , se não, ele é rederesioando para a pagína de login

if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header("Location: ../login/loginpage.php");
    exit();
}

// Inclui a conexão com o banco de dados
require_once '../banco/connection.php';

// Function para pegar os dados do banco de dados
function getTableData($pdo)
{
    $stmt = $pdo->query("SELECT * FROM `NOTAS DE CORTE - PROCESSO SELETIVO SISU 2022.1 - UNILAB`");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Pega os dados da  tabela
$tableData = getTableData($pdo);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page - CRUD Operations</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Admin Page - NOTAS DE CORTE - PROCESSO SELETIVO SISU 2022.1 - UNILAB</h2>
        <hr>

        <!-- Tabela para exbir os dados-->
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
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tableData as $row) : ?>
                    <tr>
                        <td><?= $row['Campus'] ?></td>
                        <td><?= $row['Cod. Curso'] ?></td>
                        <td><?= $row['Curso'] ?></td>
                        <td><?= $row['Turno'] ?></td>
                        <td><?= $row['Formação'] ?></td>
                        <td><?= $row['Cota'] ?></td>
                        <td><?= $row['Corte Ch Regular'] ?></td>
                        <td><?= $row['Corte Final'] ?></td>
                        <td>
                            <!-- Butão de editar -->
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?= $row['Cod. Curso'] ?>">Editar</button>
                            <!-- Butão de deletar-->
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $row['Cod. Curso'] ?>">Deletar</button>
                        </td>
                    </tr>

                    <!-- Modal de edição-->
                    <div class="modal fade" id="editModal<?= $row['Cod. Curso'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Editar registro</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="../crud/editdata.php">
                                        <input type="hidden" name="originalCodCurso" value="<?= $row['Cod. Curso'] ?>">
                                        <div class="form-group">
                                            <label for="editCampus">Campus</label>
                                            <input type="text" class="form-control" id="editCampus" name="Campus" value="<?= $row['Campus'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editCodCurso">Cod. Curso</label>
                                            <input type="number" class="form-control" id="editCodCurso" name="CodCurso" value="<?= $row['Cod. Curso'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editCurso">Curso</label>
                                            <input type="text" class="form-control" id="editCurso" name="Curso" value="<?= $row['Curso'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editTurno">Turno</label>
                                            <input type="text" class="form-control" id="editTurno" name="Turno" value="<?= $row['Turno'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editFormacao">Formação</label>
                                            <input type="text" class="form-control" id="editFormacao" name="Formacao" value="<?= $row['Formação'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editCota">Cota</label>
                                            <input type="text" class="form-control" id="editCota" name="Cota" value="<?= $row['Cota'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editCorteChRegular">Corte Ch Regular</label>
                                            <input type="number" class="form-control" id="editCorteChRegular" name="CorteChRegular" value="<?= $row['Corte Ch Regular'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editCorteFinal">Corte Final</label>
                                            <input type="number" class="form-control" id="editCorteFinal" name="CorteFinal" value="<?= $row['Corte Final'] ?>" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="update">Atualizar registro</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal de exclusão -->
                    <div class="modal fade" id="deleteModal<?= $row['Cod. Curso'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Confirmar exclusão</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Tem certeza que deseja excluir o registro de <?= $row['Curso'] ?>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <form method="post" action="../crud/deletedata.php">
                                        <input type="hidden" name="codCurso" value="<?= $row['Cod. Curso'] ?>">
                                        <button type="submit" class="btn btn-danger" name="delete">Deletar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Modal de adiconar o registro -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Adicionar novo registro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="../crud/adddata.php">
                            <div class="form-group">
                                <label for="addCampus">Campus</label>
                                <input type="text" class="form-control" id="addCampus" name="Campus" required>
                            </div>
                            <div class="form-group">
                                <label for="addCodCurso">Cod. Curso</label>
                                <input type="number" class="form-control" id="addCodCurso" name="CodCurso" required>
                            </div>
                            <div class="form-group">
                                <label for="addCurso">Curso</label>
                                <input type="text" class="form-control" id="addCurso" name="Curso" required>
                            </div>
                            <div class="form-group">
                                <label for="addTurno">Turno</label>
                                <input type="text" class="form-control" id="addTurno" name="Turno" required>
                            </div>
                            <div class="form-group">
                                <label for="addFormacao">Formação</label>
                                <input type="text" class="form-control" id="addFormacao" name="Formacao" required>
                            </div>
                            <div class="form-group">
                                <label for="addCota">Cota</label>
                                <input type="text" class="form-control" id="addCota" name="Cota" required>
                            </div>
                            <div class="form-group">
                                <label for="addCorteChRegular">Corte Ch Regular</label>
                                <input type="number" step="0.01" class="form-control" id="addCorteChRegular" name="CorteChRegular" required>
                            </div>
                            <div class="form-group">
                                <label for="addCorteFinal">Corte Final</label>
                                <input type="number" step="0.01" class="form-control" id="addCorteFinal" name="CorteFinal" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="add">Adicionar Registro</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botão de logout -->
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
                        Tem certeza que deseja sair?
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

    <!-- Botão para ativar o modal de registro-->
    <button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#addModal">Adicionar novo registro</button>

    <!-- Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
