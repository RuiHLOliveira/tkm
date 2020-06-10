create database tkm;

use tkm;

create table Tarefas (
    id int not null AUTO_INCREMENT,
    nome varchar(255),
    descricao varchar(255),
    completa boolean,
    CONSTRAINT PK_Tarefas PRIMARY KEY (id)
);