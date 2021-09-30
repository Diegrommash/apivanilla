CREATE DATABASE apivanilla;
USE apivanilla;

CREATE TABLE users(
id              int(255) auto_increment not null,
userName        varchar(100) not null,
email           varchar(255) not null,
password        varchar(255) not null,
rol             varchar(20),
imagen          varchar(255),
emailValidation TINYINT,
CONSTRAINT pk_usuarios PRIMARY KEY(id),
CONSTRAINT uq_email UNIQUE(email)  
)ENGINE=InnoDb;