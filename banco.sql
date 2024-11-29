DROP SCHEMA IF EXISTS imobilizado;
CREATE SCHEMA imobilizado;
USE imobilizado;

CREATE TABLE LOGIN(
	id INT AUTO_INCREMENT PRIMARY KEY,
    usuario varchar(255),
    senha varchar(255)
);

CREATE TABLE FILIAL(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nome_filial VARCHAR(255),
    cnpj VARCHAR(14),
    estado CHAR(2),
    cidade VARCHAR(255),
    bairro VARCHAR(255),
    rua VARCHAR(255),
    numero INT
);

CREATE TABLE CATEGORIA(
	id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(255)
);

CREATE TABLE SETOR(
	id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(255)
);

CREATE TABLE SETOR_FILIAL(
    id INT AUTO_INCREMENT PRIMARY KEY,
	setor_id INT NOT NULL,
    filial_id INT NOT NULL,
    FOREIGN KEY (setor_id) REFERENCES SETOR(id) ON DELETE CASCADE,
    FOREIGN KEY (filial_id) REFERENCES FILIAL(id) ON DELETE CASCADE
);

CREATE TABLE ATIVO(
	id INT AUTO_INCREMENT PRIMARY KEY,
    filial_id INT NOT NULL,
    setor_id INT NOT NULL,
    categoria_id INT NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    data_cadastro DATETIME NOT NULL,
    data_aquisicao DATETIME NOT NULL,
    vida_util INT,
    condicao INT,
    estado_ativo BOOL,
    valor FLOAT NOT NULL,
    FOREIGN KEY (filial_id) REFERENCES FILIAL(id),
    FOREIGN KEY (setor_id) REFERENCES SETOR(id),
    FOREIGN KEY (categoria_id) REFERENCES CATEGORIA(id)
);

CREATE TABLE TRANSFERENCIA(
    id INT AUTO_INCREMENT PRIMARY KEY,
	ativo_id INT NOT NULL,
    filial_origem_id INT NOT NULL,
    setor_origem_id INT NOT NULL,
    filial_destino_id INT NOT NULL,
    setor_destino_id INT NOT NULL,
    data_transferencia DATETIME,
    FOREIGN KEY (ativo_id) REFERENCES ATIVO(id) ON DELETE CASCADE,
    FOREIGN KEY (filial_origem_id) REFERENCES FILIAL(id),
    FOREIGN KEY (setor_origem_id) REFERENCES SETOR(id),
    FOREIGN KEY (filial_destino_id) REFERENCES FILIAL(id),
    FOREIGN KEY (setor_destino_id) REFERENCES SETOR(id)
);