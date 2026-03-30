-- Criar o banco de dados (opcional, caso ainda não tenha criado no servidor)
CREATE DATABASE IF NOT EXISTS login_transporte;
USE login_transporte;

-- Criar a tabela de usuários
CREATE TABLE IF NOT EXISTS users (
    id_usuario INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    login VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(120) NOT NULL,
    PRIMARY KEY (id_usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Garante que estamos usando o banco correto
USE login_transporte;

-- Inserindo os dados da Mirly
INSERT INTO usuario (nome, login, senha) 
VALUES ('Mirly', 'Mirly2@seduc.ce.gov.br', '202cb962ac59075b964b07152d234b70');
