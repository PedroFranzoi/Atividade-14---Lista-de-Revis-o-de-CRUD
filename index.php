<?php
include 'db/db.php';

$sqlUsuario = "SELECT id, nome FROM usuarios";
$resultUsuarios = $conn->query($sqlUsuario);

$sql = "SELECT 
            tarefas.id AS idTarefa,
            tarefas.descricao AS descricao,
            tarefas.nomeSetor AS nomeSetor,
            tarefas.prioridade AS prioridade,
            tarefas.dataCadastro AS dataCadastro,
            tarefas.statusTarefa AS statusTarefa,
            usuarios.nome AS responsavel
        FROM tarefas
        INNER JOIN usuarios ON tarefas.idUsuario = usuarios.id";

$result = $conn->query($sql);

$aFazer = [];
$fazendo = [];
$pronto = [];

while ($row = $result->fetch_assoc()) {
    switch ($row['statusTarefa']) {
        case 'fazendo':
            $fazendo[] = $row;
            break;
        case 'pronto':
            $pronto[] = $row;
            break;
        default:
            $aFazer[] = $row;
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>

<div class="flex">
    <a class="link" href="tarefas/criarTarefas.php">Criar Tarefa</a>
    <a class="link" href="usuarios/cadastrarUsuario.php">Cadastrar Usuario</a>
</div>


    <div class="flex">
            <div id="fazer">
                            <h2>A fazer</h2>
                                <table border="1">
                                    <tr>
                                        <th>Descrição</th>
                                        <th>Nome do Setor</th>
                                        <th>Prioridade</th>
                                        <th>Data de Cadastro</th>
                                        <th>Responsável</th>
                                        <th>Editar</th>
                                        <th>Deletar</th>
                                    </tr>
                                    <?php foreach ($aFazer as $t) { ?>
                                        <tr>
                                            <td><?= $t['descricao'] ?></td>
                                            <td><?= $t['nomeSetor'] ?></td>
                                            <td><?= $t['prioridade'] ?></td>
                                            <td><?= $t['dataCadastro'] ?></td>
                                            <td><?= $t['responsavel'] ?></td>
                                            <td> <a href="tarefas/atualizarTarefa.php?id={$row['id']}">Ediatar</a></td>
                                            <td> <a href="tarefas/deletarTarefa?id={$row['id']}">Deletra</a></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                </div>
                        
                        <div id="fazendo">
                            <h2>Fazendo</h2>
                            <table border="1">
                                <tr>
                                    <th>Descrição</th>
                                    <th>Nome do Setor</th>
                                    <th>Prioridade</th>
                                    <th>Data de Cadastro</th>
                                    <th>Responsável</th>
                                    <th>Editar</th>
                                    <th>Deletar</th>
                                </tr>
                                <?php foreach ($fazendo as $t) { ?>
                                    <tr>
                                        <td><?= $t['descricao'] ?></td>
                                        <td><?= $t['nomeSetor'] ?></td>
                                        <td><?= $t['prioridade'] ?></td>
                                        <td><?= $t['dataCadastro'] ?></td>
                                        <td><?= $t['responsavel'] ?></td>
                                        <td> <a href="tarefas/atualizarTarefa.php?id={$row['id']}">Ediatar</a></td>
                                        <td> <a href="tarefas/deletarTarefa?id={$row['id']}">Deletra</a></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                        
                    <div id="pronto">
                        <h2>Pronto</h2>
                        <table border="1">
                            <tr>
                                <th>Descrição</th>
                                <th>Nome do Setor</th>
                                <th>Prioridade</th>
                                <th>Data de Cadastro</th>
                                <th>Responsável</th>
                                <th>Editar</th>
                                <th>Deletar</th>
                            </tr>
                            <?php foreach ($pronto as $t) { ?>
                                <tr>
                                    <td><?= $t['descricao'] ?></td>
                                    <td><?= $t['nomeSetor'] ?></td>
                                    <td><?= $t['prioridade'] ?></td>
                                    <td><?= $t['dataCadastro'] ?></td>
                                    <td><?= $t['responsavel'] ?></td>
                                    <td> <a href="tarefas/atualizarTarefa.php?id={$row['id']}">Ediatar</a></td>
                                    <td> <a href="tarefas/deletarTarefa?id={$row['id']}">Deletra</a></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                        

                    </div>
    </div>

    
</body>
</html>
<div>

    
