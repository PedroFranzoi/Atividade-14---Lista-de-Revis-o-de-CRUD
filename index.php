<?php
include 'db/db.php';

$sql = "SELECT * FROM tarefas";
$aqlStatus = "SELECT statusTarefa FROM tarefas";
$sqlUsuario = "SELECT id,nome FROM usuarios";
$resultUsuarios = $conn->query($sqlUsuario);

$result = $conn->query($sql);






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
        <div class="link">
            <a href="usuarios/cadastrarUsuario.php">Cadastrar usuarios</a>
        </div>
        <div class="link">
            <a href="tarefas/criarTarefas.php">Criar tarefas</a>
        </div>
    </div>


    <div>
        <div id="paraFazer">
            <?php
            while($aqlStatus == 'a fazer'){
                echo "<tr>
                        <td> {$row['descricao']} </td>
                        <td> {$row['nomeSetor']} </td>
                        <td> {$row['prioridade']} </td>
                        <td> {$row['dataCadastro']} </td>
                        <td> {$row['nomeSetor']} </td>
                        <td> </td>
                     </tr>
                "
            }
            ?>
        </div>

        <div id="fazendo"></div>

        <div id="pronto"></div>
    </div>

    
    
</body>
</html>