-- Criar o banco de dados (opcional, caso ainda não tenha criado no servidor)
CREATE DATABASE IF NOT EXISTS login_transporte;
USE login_transporte;

-- Criar a tabela de usuários
CREATE TABLE IF NOT EXISTS users (
    id_usuario INT NOT NULL AUTO_INCREMENT,
    login VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(120) NOT NULL,
    PRIMARY KEY (id_usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Garante que estamos usando o banco correto
USE login_transporte;

-- Inserindo os dados da Mirly
INSERT INTO users (login, senha) 
VALUES ('Mirly2@seduc.ce.gov.br', '202cb962ac59075b964b07152d234b70');

--Nova Tabela unitária para o usuário ADMIN
CREATE TABLE IF NOT EXISTS admin (
    id_admin INT NOT NULL AUTO_INCREMENT,
    login VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(120) NOT NULL,
    PRIMARY KEY (id_admin)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO admin (login, senha) VALUES ('admin.stge20@seduc.ce.gov.br', 'eeep-adm-sgte-seduc');