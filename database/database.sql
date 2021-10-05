CREATE DATABASE apivanilla;
USE apivanilla;

CREATE TABLE users(
id              int(255) auto_increment not null,
userName        varchar(100) not null,
email           varchar(255) not null,
password        varchar(255) not null,
role            varchar(20),
image           varchar(255),
emailValidation TINYINT(2),
id_client       varchar(255),
secret_key      varchar(255),
created_at      date,
updated_at      date
CONSTRAINT pk_usuarios PRIMARY KEY(id),
CONSTRAINT uq_email UNIQUE(email)  
)ENGINE=InnoDb;

CREATE TABLE rols(
id int(255)     auto_increment not null,
roleName        varchar(255) not null,
description     varchar(255)
CONSTRAINT  pk_roles PRIMARY KEY(id)
)ENGINE=InnoDb;