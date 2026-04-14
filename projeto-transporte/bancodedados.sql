-- Criar o banco de dados
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

--Nova Tabela unitária para o usuário ADMIN
CREATE TABLE IF NOT EXISTS admin (
    id_admin INT NOT NULL AUTO_INCREMENT,
    login VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(120) NOT NULL,
    PRIMARY KEY (id_admin)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO admin (login, senha) VALUES ('admin.stge20@seduc.ce.gov.br', MD5('eeep-adm-stge-seduc')); --eeep-adm-stge-seduc é a senha