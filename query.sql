/*Criacao do banco de dados*/
create database check_pet;

/*Selecao manual do banco de dados*/
use check_pet;

/*Criacao da tabela com os atributos necessarios*/
create table usuario(
	id_usuario int not null auto_increment,
    nome varchar(50) not null,
    email varchar(30) not null,
    senha varchar(64) not null,
    cpf varchar(11),
    data_nascimento date,
    sexo varchar(20),
    cidade varchar (20),
    endereco varchar(100),
    complemento varchar(20),
    
    primary key(id_usuario)
);

/*Comandos relevantes para a pesquisa*/
select *
from usuario;

drop table usuario;

/*Criar usuario*/
CREATE USER `usuario_apl`@`%` IDENTIFIED BY 'usuario123';

GRANT SELECT, INSERT, UPDATE, DELETE ON `check_pet`.* TO `usuario_apl`@`%`;