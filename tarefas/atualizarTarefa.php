<?php
include '../db/db.php';

// Pegar e validar id
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    echo 'ID inválido.';
    exit;
}

// Buscar usuários (para select)
$sqlUsuario = "SELECT id, nome FROM usuarios";
$resultUsuarios = $conn->query($sqlUsuario);

// Buscar tarefa a ser atualizada
$sqlTarefa = "SELECT descricao, nomeSetor, prioridade, dataCadastro, statusTarefa, idUsuario FROM tarefas WHERE id = $id";
$resultTarefa = $conn->query($sqlTarefa);
if (!$resultTarefa || $resultTarefa->num_rows === 0) {
    echo 'Tarefa não encontrada.';
    exit;
}
$tarefa = $resultTarefa->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'] ?? '';
    $nomeSetor = $_POST['nomeSetor'] ?? '';
    $prioridade = $_POST['prioridade'] ?? '';
    $dataCadastro = $_POST['dataCadastro'] ?? '';
    $usuario = isset($_POST['usuario']) ? (int)$_POST['usuario'] : 0;
    $statusTarefa = $_POST['statusTarefa'] ?? '';

    // Prepared statement para evitar SQL injection e corrigir sintaxe
    $stmt = $conn->prepare("UPDATE tarefas SET descricao = ?, nomeSetor = ?, prioridade = ?, dataCadastro = ?, idUsuario = ?, statusTarefa = ? WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param('ssssisi', $descricao, $nomeSetor, $prioridade, $dataCadastro, $usuario, $statusTarefa, $id);
        if ($stmt->execute()) {
            // Redireciona para a página inicial após sucesso
            header('Location: ../index.php');
            exit;
        } else {
            echo 'Erro ao atualizar: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        echo 'Erro na preparação da query: ' . $conn->error;
    }

    $conn->close();
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Tarefa</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>

    <h1>Atualizar tarefa</h1>

    <form method="post" action="?id=<?php echo $id; ?>">

        <label for="descricao">Descrição:</label>
        <input type="text" name="descricao" id="descricao" required value="<?php echo htmlspecialchars($tarefa['descricao']); ?>">
        <br><br>

        <label for="nomeSetor">Nome do setor:</label>
        <input type="text" name="nomeSetor" id="nomeSetor" required value="<?php echo htmlspecialchars($tarefa['nomeSetor']); ?>">
        <br><br>

        <label for="prioridade">Prioridade:</label>
        <select name="prioridade" id="prioridade" required>
            <option value="" disabled>Selecione</option>
            <option value="baixa" <?php if ($tarefa['prioridade'] === 'baixa') echo 'selected'; ?>>Baixa</option>
            <option value="média" <?php if ($tarefa['prioridade'] === 'média') echo 'selected'; ?>>Média</option>
            <option value="alta" <?php if ($tarefa['prioridade'] === 'alta') echo 'selected'; ?>>Alta</option>
        </select>
        <br><br>

        <label for="dataCadastro">Data de criação:</label>
        <input type="date" name="dataCadastro" id="dataCadastro" required value="<?php echo htmlspecialchars($tarefa['dataCadastro']); ?>">
        <br><br>

        <label for="statusTarefa">Status:</label>
        <select name="statusTarefa" id="statusTarefa" required>
            <option value="" disabled>Selecione</option>
            <option value="a fazer" <?php if ($tarefa['statusTarefa'] === 'a fazer') echo 'selected'; ?>>A fazer</option>
            <option value="fazendo" <?php if ($tarefa['statusTarefa'] === 'fazendo') echo 'selected'; ?>>Fazendo</option>
            <option value="pronto" <?php if ($tarefa['statusTarefa'] === 'pronto') echo 'selected'; ?>>Pronto</option>
        </select>

        <br><br>
        <label for="usuario">Usuário responsável:</label>
        <select name="usuario" id="usuario">
            <?php while ($userRow = $resultUsuarios->fetch_assoc()): ?>
                <option value="<?php echo (int)$userRow['id']; ?>" <?php if ((int)$userRow['id'] === (int)$tarefa['idUsuario']) echo 'selected'; ?>><?php echo htmlspecialchars($userRow['nome']); ?></option>
            <?php endwhile; ?>
        </select>
        <br><br>

        <button type="submit">Atualizar</button>
        <br><br>
        <a href="../index.php">Voltar para tela inicial</a>
    </form>
    
</body>
</html>