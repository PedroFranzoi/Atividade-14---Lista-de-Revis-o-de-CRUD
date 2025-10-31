<?php
include '../db/db.php';


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $nome = $_POST['nome'];
    $email = $_POST['email'];


    $sql = "INSERT INTO usuarios (nome,email) VALUE ('$nome','$email')";



    if($conn->query($sql) === true){
        echo "Cadastrado com sucesso.";
    } else{
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
    <title>Cadastrar usuarios</title>
</head>
<body>
    <h1>Cadastrar Usuario</h1>

    <form method="POST" action="">

    <label for="nome">Nome:</label>
    <input type="text" name="nome" required>
    <br>
    <label for="nome">Email:</label>
    <input type="text" name="email" required>
    <br>
    <br>
    <button type="submit">Criar</button>
    <br>
    <br>
    <a href="../index.php">Voltar</a>

    </form>



</body>
</html>