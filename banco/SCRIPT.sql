-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema mustachedb01
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mustachedb01
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mustachedb01` DEFAULT CHARACTER SET utf8 ;
USE `mustachedb01` ;

-- -----------------------------------------------------
-- Table `mustachedb01`.`clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mustachedb01`.`clientes` (
  `id` INT(4) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `cpf` VARCHAR(11) NOT NULL,
  `senha` VARCHAR(32) NOT NULL,
  `data_nasc` DATE NOT NULL,
  `ativo` BIT(1) NOT NULL,
  `data_cad` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  `telefone` CHAR(14) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mustachedb01`.`niveis`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mustachedb01`.`niveis` (
  `id` INT(4) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `sigla` CHAR(3) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mustachedb01`.`profissionais`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mustachedb01`.`profissionais` (
  `id` INT(4) NOT NULL AUTO_INCREMENT,
  `nivel_id` INT(4) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `disponibilidade` CHAR(1) NOT NULL,
  `ativo` BIT(1) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Profissional_Niveis1_idx` (`nivel_id` ASC) ,
  CONSTRAINT `fk_Profissional_Niveis1`
    FOREIGN KEY (`nivel_id`)
    REFERENCES `mustachedb01`.`niveis` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mustachedb01`.`categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mustachedb01`.`categorias` (
  `id` INT(4) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  `sigla` CHAR(3) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mustachedb01`.`servicos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mustachedb01`.`servicos` (
  `id` INT(4) NOT NULL AUTO_INCREMENT,
  `categoria_id` INT(4) NULL DEFAULT NULL,
  `nome` VARCHAR(60) NOT NULL,
  `valor_unit` DOUBLE NOT NULL,
  `duracao_estimada` TIME NOT NULL,
  `desconto` DOUBLE NOT NULL,
  `data_cad` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  `imagem` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Serviços_Categoria1_idx` (`categoria_id` ASC) ,
  CONSTRAINT `fk_Serviços_Categoria1`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `mustachedb01`.`categorias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 17
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mustachedb01`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mustachedb01`.`usuarios` (
  `id` INT(4) NOT NULL AUTO_INCREMENT,
  `nivel_id` INT(4) NOT NULL,
  `nome` VARCHAR(60) NOT NULL,
  `email` VARCHAR(60) NOT NULL,
  `data_cad` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  `ativo` BIT(1) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `cpf` VARCHAR(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
  UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC) ,
  INDEX `fk_Usuarios_Niveis1_idx` (`nivel_id` ASC) ,
  CONSTRAINT `fk_Usuarios_Niveis1`
    FOREIGN KEY (`nivel_id`)
    REFERENCES `mustachedb01`.`niveis` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mustachedb01`.`agendamentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mustachedb01`.`agendamentos` (
  `id` INT(4) NOT NULL AUTO_INCREMENT,
  `cliente_id` INT(4) NOT NULL,
  `usuario_id` INT(4) NOT NULL,
  `profissional_id` INT(4) NOT NULL,
  `servico_id` INT(4) NOT NULL,
  `status` CHAR(3) NOT NULL,
  `data` DATE NOT NULL,
  `hora_inicio` TIME NOT NULL,
  `hora_termino` TIME NOT NULL,
  `data_criacao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  INDEX `fk_Agendamento_Clientes1_idx` (`cliente_id` ASC) ,
  INDEX `fk_Agendamento_Profissional1_idx` (`profissional_id` ASC) ,
  INDEX `fk_Agendamento_Usuarios1_idx` (`usuario_id` ASC) ,
  INDEX `fk_Agendamento_Serviços1_idx` (`servico_id` ASC) ,
  CONSTRAINT `fk_Agendamento_Clientes1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `mustachedb01`.`clientes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Agendamento_Profissional1`
    FOREIGN KEY (`profissional_id`)
    REFERENCES `mustachedb01`.`profissionais` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Agendamento_Serviços1`
    FOREIGN KEY (`servico_id`)
    REFERENCES `mustachedb01`.`servicos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Agendamento_Usuarios1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `mustachedb01`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mustachedb01`.`atendimentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mustachedb01`.`atendimentos` (
  `id` INT(4) NOT NULL AUTO_INCREMENT,
  `agendamento_id` INT(4) NOT NULL,
  `profissional_id` INT(4) NOT NULL,
  `data` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  `descricao` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Atendimentos_Agendamento1_idx` (`agendamento_id` ASC) ,
  INDEX `fk_Atendimentos_Profissional1_idx` (`profissional_id` ASC) ,
  CONSTRAINT `fk_Atendimentos_Agendamento1`
    FOREIGN KEY (`agendamento_id`)
    REFERENCES `mustachedb01`.`agendamentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Atendimentos_Profissional1`
    FOREIGN KEY (`profissional_id`)
    REFERENCES `mustachedb01`.`profissionais` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mustachedb01`.`comandas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mustachedb01`.`comandas` (
  `id` INT(4) NOT NULL AUTO_INCREMENT,
  `atendimento_id` INT(4) NOT NULL,
  `cliente_id` INT(4) NOT NULL,
  `status` CHAR(1) NOT NULL,
  `desconto` DOUBLE NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Comandas_Atendimentos1_idx` (`atendimento_id` ASC) ,
  INDEX `fk_Comandas_Clientes1_idx` (`cliente_id` ASC) ,
  CONSTRAINT `fk_Comandas_Atendimentos1`
    FOREIGN KEY (`atendimento_id`)
    REFERENCES `mustachedb01`.`atendimentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Comandas_Clientes1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `mustachedb01`.`clientes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mustachedb01`.`comandaservico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mustachedb01`.`comandaservico` (
  `Id` INT(4) NOT NULL AUTO_INCREMENT,
  `servico_id` INT(4) NOT NULL,
  `comanda_id` INT(4) NOT NULL,
  `preco` DOUBLE NOT NULL,
  `desconto` DOUBLE NOT NULL,
  PRIMARY KEY (`Id`),
  INDEX `fk_Agendaservico_Serviços1_idx` (`servico_id` ASC) ,
  INDEX `fk_Comandaservico_Comanda1_idx` (`comanda_id` ASC) ,
  CONSTRAINT `fk_Agendaservico_Serviços1`
    FOREIGN KEY (`servico_id`)
    REFERENCES `mustachedb01`.`servicos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Comandaservico_Comanda1`
    FOREIGN KEY (`comanda_id`)
    REFERENCES `mustachedb01`.`comandas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mustachedb01`.`enderecos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mustachedb01`.`enderecos` (
  `id` INT(4) NOT NULL AUTO_INCREMENT,
  `clientes_id` INT(4) NOT NULL,
  `cep` CHAR(8) NOT NULL,
  `logradouro` VARCHAR(100) NOT NULL,
  `numero` VARCHAR(40) NOT NULL,
  `complemento` VARCHAR(45) NULL DEFAULT NULL,
  `bairro` VARCHAR(60) NOT NULL,
  `cidade` VARCHAR(60) NOT NULL,
  `uf` CHAR(2) NOT NULL,
  `tipo` CHAR(3) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Enderecos_Clientes1_idx` (`clientes_id` ASC) ,
  CONSTRAINT `fk_Enderecos_Clientes1`
    FOREIGN KEY (`clientes_id`)
    REFERENCES `mustachedb01`.`clientes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mustachedb01`.`pagamentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mustachedb01`.`pagamentos` (
  `id` INT(4) NOT NULL AUTO_INCREMENT,
  `comanda_id` INT(4) NOT NULL,
  `data` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  `valor` DOUBLE NOT NULL,
  `taxa` DOUBLE NOT NULL,
  `forma_pag` VARCHAR(12) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Pagamentos_Comanda1_idx` (`comanda_id` ASC) ,
  CONSTRAINT `fk_Pagamentos_Comanda1`
    FOREIGN KEY (`comanda_id`)
    REFERENCES `mustachedb01`.`comandas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mustachedb01`.`profissionalservico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mustachedb01`.`profissionalservico` (
  `profissional_id` INT(4) NOT NULL,
  `servico_id` INT(4) NOT NULL,
  PRIMARY KEY (`profissional_id`, `servico_id`),
  INDEX `fk_Profissionalserviço_Serviços1_idx` (`servico_id` ASC) ,
  CONSTRAINT `fk_Profissionalserviço_Profissional1`
    FOREIGN KEY (`profissional_id`)
    REFERENCES `mustachedb01`.`profissionais` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Profissionalserviço_Serviços1`
    FOREIGN KEY (`servico_id`)
    REFERENCES `mustachedb01`.`servicos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mustachedb01`.`recibo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mustachedb01`.`recibo` (
  `id` INT(4) NOT NULL AUTO_INCREMENT,
  `pagamento_id` INT(4) NOT NULL,
  `data` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  `valor` DOUBLE NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Nivel_Pagamentos1_idx` (`pagamento_id` ASC) ,
  CONSTRAINT `fk_Nivel_Pagamentos1`
    FOREIGN KEY (`pagamento_id`)
    REFERENCES `mustachedb01`.`pagamentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

USE `mustachedb01` ;

-- -----------------------------------------------------
-- procedure sp_agendamento_insert
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_agendamento_insert`(
		sp_cliente_id int(4),
        sp_usuario_id int(4),
        sp_profissional_id int(4),
        sp_servico_id int(4),
        sp_status char(3),
        sp_data date,
		sp_hora_inicio time,
		sp_hora_termino time
    )
begin
		insert into agendamentos values(0, sp_cliente_id, sp_usuario_id, sp_profissional_id,
        sp_servico_id, sp_status, sp_data, sp_hora_inicio, sp_hora_termino, default);
    end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_agendamento_update
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_agendamento_update`(
		sp_id int,
        sp_cliente_id int,
        sp_usuario_id int,
        sp_profissional_id int,
        sp_servico_id int,
        sp_status char(3),
        sp_data date,
        sp_hora_inicio time,
        sp_hora_termino time
    )
begin
		update agendamentos set
        cliente_id = sp_cliente_id,
        usuario_id = sp_usuario_id,
        profissional_id = sp_profissional_id,
        servico_id = sp_servico_id,
        status = sp_status,
        data = sp_data,
        hora_termino = sp_hora_termino,
        hora_inicio = sp_hora_inicio,
        data_criacao = default
        where id = sp_id;
    end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_atendimento_insert
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_atendimento_insert`(
		sp_agendamento_id int(4),
		sp_profissional_id int(4),
		sp_descricao varchar(45)
	)
begin 
		insert into atendimentos values (0, sp_agendamento_id, sp_profissional_id, default, sp_descricao);
		select * from atendimentos where id = last_insert_id();
	end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_categoria_delete
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_categoria_delete`(
	sp_id int
	)
begin
		delete from categorias where id= sp_id;
	end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_categoria_insert
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_categoria_insert`( 
		sp_descricao varchar(45), 
		sp_sigla char(3) 
	)
begin 
		insert into categorias values (0,sp_descricao,sp_sigla); 
		select last_insert_id(); 
	end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_categoria_update
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_categoria_update`(
		sp_id int(4),
		sp_descricao varchar(45),
		sp_sigla char(3)
	)
begin
		update categorias set
		descricao = sp_descricao,
		sigla = sp_sigla
		where id = sp_id;
	end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_cliente_desable
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cliente_desable`(
			sp_id int,
            sp_ativo bit(1)
        )
begin
			update clientes set 
            ativo = sp_ativo
            where id = sp_id;
        end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_cliente_insert
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cliente_insert`(
			sp_nome varchar(100),
            sp_email varchar(45),
            sp_cpf varchar(11),
            sp_data_nasc date, -- !!!!!!!!alterar para tinyint(1) ou bit(1) na estrutura do banco e na procedure!!!!!!!!!!
            sp_telefone char(14)
        )
begin
			insert into clientes values(0, sp_nome, sp_email, sp_cpf, sp_data_nasc, 1, default, sp_telefone);
            select last_insert_id();
		end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_cliente_update
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cliente_update`(
			sp_id int,
            sp_nome varchar(100),
            sp_email varchar(45),
            sp_cpf varchar(11),
            sp_data_nasc date,
            sp_ativo bit(1),
            sp_telefone char(14)
        )
begin
			update clientes set 
            nome = sp_nome,
            email = sp_email,
            cpf = sp_cpf,
            data_nasc = sp_data_nasc,
			ativo = sp_ativo,
            telefone = sp_telefone
            where id = sp_id;
        end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_comanda_insert
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_comanda_insert`( 
		sp_atendimento_id int(4),
        sp_cliente_id int(4),
		sp_status char(1),
		sp_desconto double
	)
begin
		insert into comandas values(0, sp_atendimento_id, sp_cliente_id, sp_status, sp_desconto);
		select last_insert_id() as id;
	end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_comanda_update
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_comanda_update`(
		sp_id int,
        sp_atendimento_id int,
        sp_cliente_id int,
		sp_status char(1),
		sp_desconto double
	)
begin
		update comandas set
        atendimento_id = sp_atendimento_id,
        cliente_id = sp_cliente_id,
		status = sp_status,
		desconto = sp_desconto
		where id = sp_id;
	end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_comandaservico_delete
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_comandaservico_delete`(
		sp_id int
    )
begin
		delete from comandaservico where id = sp_id;
    end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_comandaservico_insert
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_comandaservico_insert`(
        sp_servico_id int(4),
        sp_comanda_id int(4),
        sp_desconto double
    )
begin
		insert into comandaservico values(0, sp_servico_id, sp_comanda_id, (select valor_unit from servicos where id = sp_servico_id), sp_desconto);
    end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_comandaservico_update
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_comandaservico_update`(
		sp_id int,
        sp_servico_id int,
        sp_comanda_id int,
        sp_desconto double
    )
begin 
		update comandaservico set 
        servico_id = sp_servico_id,
        comanda_id = sp_comanda_id,
        preco = (select valor_unit from servicos where id = sp_servico_id),
        desconto = sp_desconto
        where id = sp_id;
    end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_endereco_delete
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_endereco_delete`(
		sp_id int
    )
begin
		delete from enderecos where id = sp_id;
    end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_endereco_insert
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_endereco_insert`(
		sp_cliente_id int(4),
		sp_cep char(8),
		sp_logradouro varchar(100),
		sp_numero varchar(40),
		sp_complemento varchar(45),
		sp_bairro varchar(60),
		sp_cidade varchar(60),
		sp_uf char(2),
		sp_tipo char(3)
	)
begin
		insert into enderecos values(0, sp_cliente_id, sp_cep, sp_logradouro, sp_numero, sp_complemento, sp_bairro, sp_cidade, sp_uf, sp_tipo);
		select * from enderecos where id = last_insert_id();
    end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_endereco_update
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_endereco_update`(
		sp_id int,
        sp_cep char(8),
        sp_logradouro varchar(100),
        sp_numero varchar(100), 
        sp_complemento varchar(45),
        sp_bairro varchar(60),
        sp_cidade varchar(60),
        sp_uf char(2),
		sp_tipo char(3)
    )
begin
		update enderecos set
        cep = sp_cep,
        logradouro = sp_logradouro,
        numero = sp_numero,
        complemento = sp_complemento,
        bairro = sp_bairro,
        cidade =  sp_cidade,
        uf = sp_uf,
        tipo = sp_tipo
        where id = sp_id;
    end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_nivel_insert
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_nivel_insert`(
sp_nome varchar(45),
sp_sigla char(3)
)
begin
insert into niveis values (0,sp_nome, sp_sigla);
select * from niveis where id = last_insert_id();
end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_nivel_update
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_nivel_update`(
sp_id int(4),
sp_nome varchar(45),
sp_sigla char(3)
)
begin
    update niveis set
	nome = sp_nome,
	sigla = sp_sigla
	where id = sp_id;
end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_profissional_desable
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_profissional_desable`(
		sp_id int,
        sp_ativo bit(1)
    )
begin
		update profissionais set
		ativo = sp_ativo
		where id = sp_id;
	end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_profissional_insert
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_profissional_insert`(
        sp_niveis_id int,
		sp_nome varchar(100),
        sp_disponibilidade char(1)
    )
begin
		insert into profissionais values(0, sp_niveis_id, sp_nome, sp_disponibilidade, 1);
        select * from profissionais where id = last_insert_id();    
    end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_profissional_update
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_profissional_update`(
		sp_id int,
        sp_nivel_id int,
        sp_nome varchar(100),
        sp_disponibilidade char(1)
    )
begin
		update profissionais set 
        nivel_id = sp_nivel_id,
        nome = sp_nome,
        disponibilidade = sp_disponibilidade
        where id = sp_id;
    end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_profissionalservico_delete
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_profissionalservico_delete`(
		sp_profissional_id int,
        sp_servico_id int
    )
begin
		delete from profissionalservico where profissional_id = sp_profissional_id and servico_id = sp_servico_id;
    end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_profissionalservico_insert
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_profissionalservico_insert`(
		sp_profissional_id int(4),
        sp_servico_id int(4)
    )
begin
		insert into profissionalservico values(sp_profissional_id, sp_servico_id);
    end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_profissionalservico_update
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_profissionalservico_update`(
		sp_profissional_id int,
        sp_servico_id int
    )
begin
		update profissionalservico set
        servico_id = sp_servico_id
        where profissional_id = sp_profissional_id;
    end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_servico_insert
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_servico_insert`(
		sp_nome varchar(60),
		sp_categoria_id int,
		sp_valor_unit double,
		sp_duracao_estimada time,
		sp_desconto double
	)
begin
		insert into servicos
		values(0, sp_categoria_id, sp_nome, sp_valor_unit, sp_duracao_estimada, sp_desconto, default);
		select last_insert_id() as id;
	end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_servico_update
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_servico_update`(
		sp_id int,
		sp_categoria_id int,
		sp_nome varchar(60),
		sp_valor_unit double,
		sp_duracao_estimada time,
		sp_desconto double
	)
begin
		update servicos set
		nome = sp_nome,
		valor_unit = sp_valor_unit,
		duracao_estimada = sp_duracao_estimada,
		desconto = sp_desconto
		where id = sp_id;
	end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_usuario_desable
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_usuario_desable`(
sp_id int(4),
sp_ativo bit (1)
)
begin
update usuarios set
ativo = sp_ativo
where id = sp_id;
end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_usuario_insert
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_usuario_insert`(
		sp_nivel_id int(4),
		sp_nome varchar(60),
		sp_email varchar(60),
		sp_senha varchar (45),
        sp_cpf varchar(11)
		)
begin insert into usuarios values (0,sp_nivel_id, sp_nome, sp_email, default, 1 ,md5(sp_senha), sp_cpf);
		select last_insert_id();
	end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_usuario_update
-- -----------------------------------------------------

DELIMITER $$
USE `mustachedb01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_usuario_update`(
		sp_id int(4),
		sp_nivel_id int(4),
		sp_nome varchar(60),
		sp_email varchar(60),
		sp_ativo bit (1),
		sp_senha varchar(45)
		)
begin
		update usuarios set
		nivel_id = sp_nivel_id,
		nome = sp_nome,
		email = sp_email,
		ativo = sp_ativo,
		senha = md5(sp_senha)
		where id = sp_id;
	end$$

DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- VIEW vw_servicos
-- -----------------------------------------------------
CREATE VIEW servicos_detalhados AS
SELECT 
    s.id AS servico_id,
    s.nome AS servico_nome,
    s.valor_unit AS servico_valor,
    s.duracao_estimada AS servico_duracao,
    s.desconto AS servico_desconto,
    s.data_cad AS servico_data_cad,
    s.imagem AS servico_imagem,
    c.descricao AS categoria_descricao,
    c.sigla AS categoria_sigla
FROM 
    mustachedb01.servicos s
JOIN 
    mustachedb01.categorias c
ON 
    s.categoria_id = c.id;


 -- INSERT TABLE CATEGORIAS -------

insert into categorias (id, descricao, sigla) values
(1, 'Cortes', 'COR'),
(2, 'Barba', 'BAR'),
(3, 'Tratamento Capilar', 'TRA'),
(4, 'Combos', 'CMB');

-- INSERT TABLE SERVICOS ---
insert into servicos(id, categoria_id, nome, descricao, valor_unit, duracao_estimada, desconto, data_cad, imagem) value
(1, 1, 'Clássico', 50.00, '00:30:00', 0, NOW(), 'corte_classico.png'),
(2, 1, 'Moderno', 60.00, '00:40:00', 0, NOW(), 'corte_oderno.png'),
(3, 1, 'Fade', 55.00, '00:35:00', 0, NOW(), 'corte_classico.png'),
(4, 1, 'Undercut', 65.00, '00:45:00', 0, NOW(), 'undercut.png'),
(5, 1, 'Pompador', 70.00, '00:50:00', 0, NOW(), 'pompadour.png'),
(6, 1, 'Buzz Cut', 45.00, '00:20:00', 0, NOW(), 'buzz_cut.png'),
(7, 1,'Afro', 55.00, '00:40:00', 0.00, NOW(), 'afro.png'),

(8, 2, 'Cavanhaque', 20.00, '00:15:00', 0.00, NOW(), 'cavanhaque.png'),
(9, 2, 'Bigode', 15.00, '00:10:00', 0.00, NOW(), 'bigode.png'),
(10, 2, 'Barba Curta', 25.00, '00:20:00', 0.00, NOW(), 'barba_curta.png'),
(11, 2, 'Barba Longa', 30.00, '00:25:00', 0.00, NOW(), 'barba_longa.png'),
(12, 2, 'Barba Lenhador', 35.00, '00:30:00', 0.00, NOW(), 'barba_lenhador.png'),

(13, 3, 'Lavagem e Condicionamento', 30.00, '00:20:00', 0.00, NOW(), 'lavagem_condicionamento.png'),
(14, 3, 'Hidratação', 40.00, '00:30:00', 0.00, NOW(), 'hidratacao.png'),
(15, 3, 'Progressiva', 150.00, '01:30:00', 0.00, NOW(), 'progressiva.png'),

(16, 4, 'Essential', 70.00, '00:50:00', 0.00, NOW(), 'barba_cabelo.png'),
(17, 4, 'Total Care', 90.00, '01:10:00', 0.00, NOW(), 'cabelo_barba_sobrancelha.png'),
(18, 4, 'Transformation', 200.00, '02:15:00', 0.00, NOW(), 'cabelo_barba_sobrancelha.png');
                                        












