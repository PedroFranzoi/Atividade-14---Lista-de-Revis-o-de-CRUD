CREATE DATABASE revisao_CRUD;

USE revisao_CRUD;

CREATE TABLE usuarios(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
);

CREATE TABLE tarefas(
    id INT PRIMARY KEY AUTO_INCREMENT,
    descricao VARCHAR(255) NOT NULL,
    nomeSetor VARCHAR(255) NOT NULL,
    prioridade ENUM('baixa', 'média', 'alta') NOT NULL,
    dataCadastro DATE NOT NULL,
    statusTarefa ENUM('a fazer', 'fazendo', 'pronto') NOT NULL,
    idUsuario INT NOT NULL,
    FOREIGN KEY (idUsuario) REFERENCES usuarios(id)
);