<?php
include '../db/db.php';

$sqlUsuario = "SELECT id,nome FROM usuarios";
$resultUsuarios = $conn->query($sqlUsuario);

$id = $_GET['id'];
$sql = "SELECT * FROM tarefas WHERE id = $id";
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $descricao = $_POST['descricao'];
    $nomeSetor = $_POST['nomeSetor'];
    $prioridade = $_POST['prioridade'];
    $dataCadastro = $_POST['dataCadastro'];
    $usuario = $_POST['usuario'];
    $statusTarefa = $_POST['statusTarefa'];

    $sql = "UPDATE tarefas SET descricao = '$descricao' , nomeSetor = '$nomeSetor', prioridade = '$prioridade', dataCadastro = '$dataCadastro', idUsuario = '$usuario', statusTarefa = '$statusTarefa' WHERE id = $id)";

 

    if ($conn->query($sql) === true) {
        echo "Tarefa atualizada com sucesso.";
    }else {
        echo "Erro " . $sql . '<br>' . $conn->error;
    }
    $conn->close();
    exit();


}

$result = $conn ->query($sql);
$row = $result->fetch_assoc();



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
        <input type="text" name="descricao" required VALUE="<php echo $row['descricao']; ?>">
        <br>
        <br>
        <label for="nome">Nome do setor:</label>
        <input type="text" name="nomeSetor" required VALUE="<php echo $row['nomeSetor']; ?>">
        <br>
        <br>
        <label for="prioridade">Prioridade:</label>
        <select name="prioridade" required>
            <option value="<php echo $row['prioridade']; ?>"></option>
            <option value="baixa">Baixa</option>
            <option value="média">Média</option>
            <option value="alta">Alta</option>
        </select>
        <br>
        <br>
        <label for="nome">Data de criação:</label>
        <input type="date" name="dataCadastro" required VALUE="<php echo $row['dataCadastro']; ?>">
        <br>
        <br>
        <label for="statusTarefa">Status:</label>
        <select name="statusTarefa" required>
            <option value="<php echo $row['statusTarefa']; ?>"></option>
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