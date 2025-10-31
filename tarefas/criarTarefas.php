<?php
include '../db/db.php';

$sqlUsuario = "SELECT id,nome FROM usuarios";
$resultUsuarios = $conn->query($sqlUsuario);

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $descricao = $_POST['descricao'];
    $nomeSetor = $_POST['nomeSetor'];
    $prioridade = $_POST['prioridade'];
    $dataCadastro = $_POST['dataCadastro'];
    $usuario = $_POST['usuario'];

    $sql = "INSERT INTO tarefas (descricao, nomeSetor, prioridade, dataCadastro, idUsuario) VALUE ('$descricao','$nomeSetor','$prioridade','$dataCadastro','$usuario')";

 

    if ($conn->query($sql) === true) {
        echo "Nova tarefa criada com sucesso.";
    }else {
        echo "Erro " . $sql . '<br>' . $conn->error;
    }
    $conn->close();


}




?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Tarefa</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>

    <h1>Criar tarefa</h1>


    <form method="post" action="criarTarefas.php">

        <label for="nome">Descrição:</label>
        <input type="text" name="descricao" required>
        <br>
        <br>
        <label for="nome">Nome do setor:</label>
        <input type="text" name="nomeSetor" required>
        <br>
        <br>
        <label for="prioridade">Prioridade:</label>
        <select name="prioridade" required>
            <option value="baixa">Baixa</option>
            <option value="média">Média</option>
            <option value="alta">Alta</option>
        </select>
        <br>
        <br>
        <label for="nome">Data de criação:</label>
        <input type="date" name="dataCadastro" required>
        <br>
        <br>
        <label for="statusTarefa">Status:</label>
        <select name="statusTarefa" required>
            <option value="a fazer">A fazer</option>
            <option value="fazendo">Fazendo</option>
            <option value="pronto">Pronto</option>
        </select>

        <br>
        <br>
        <label for="usuario">Usuario responsavel:</label>
        <select name="usuario">
            <?php while ($row = $resultUsuarios->fetch_assoc()): ?>
                <option value="<?= $row['id'] ?>"><?= $row['nome'] ?></option>
                <?php endwhile; ?>
            </select>
        <br>
        <br>
        <button type="submit">Criar</button> 
        <br>
        <br>
        <a href="../index.php">Voltar para tela inicial</a>
    </form>
    



    
</body>
</html>