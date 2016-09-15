-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Máquina: 127.0.0.1
-- Data de Criação: 22-Nov-2013 às 12:14
-- Versão do servidor: 5.6.11-log
-- versão do PHP: 5.4.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `artifice`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_BUSCA_ARTISTA_COMPLEXO`(IN cat INT, IN id INT, IN ps INT, IN es INT, IN cid INT)
BEGIN

	/*DECLARANDO AS VARIÁVEIS QUE SERÃO USADAS NO PROCESSO*/
    DECLARE CATEGORIA, IDADE, PAIS, ESTADO, CIDADE INT;

	SET CATEGORIA = cat, IDADE = id, PAIS = ps, ESTADO = es, CIDADE = cid; 
	
	/*Criando a tabela temporária das categorias.*/	
	CREATE TEMPORARY TABLE tb_temp_categoria(
		id 			int auto_increment primary key,
		categorias 	int
	)
	ENGINE=MEMORY;

	/*Criando a tabela temporária da data de nascimento.*/
	CREATE TEMPORARY TABLE tb_temp_datas(
		id 	int auto_increment primary key,
		datas varchar(15)
	)
	ENGINE=MEMORY;

	/*Criando a tabela temporária dos paises.*/	
	CREATE TEMPORARY TABLE tb_temp_pais(
		id        int auto_increment primary key,
		paises    int
	)
	ENGINE=MEMORY;
	
	/*Criando a tabela temporária dos estados.*/	
	CREATE TEMPORARY TABLE tb_temp_estado(
		id 		int auto_increment primary key,
		estados int
	)
	ENGINE=MEMORY;
	
	/*Criando a tabela temporária das cidades.*/	
	CREATE TEMPORARY TABLE tb_temp_cidade(
		id 			int auto_increment primary key,
		cidades     int
	)
	ENGINE=MEMORY;
	
	IF(CATEGORIA = 0)then
		INSERT INTO tb_temp_categoria(categorias) SELECT cat_id FROM tb_categoria WHERE cat_id IS NOT NULL;
	ELSE
		INSERT INTO tb_temp_categoria(categorias) SELECT cat_id FROM tb_categoria WHERE cat_id = CATEGORIA;
	END IF;
	
	IF(IDADE = 0)THEN
		INSERT INTO tb_temp_datas(datas) SELECT art_datanasc FROM tb_artista where art_datanasc IS NOT NULL;
	ELSE
		INSERT INTO tb_temp_datas(datas) SELECT art_datanasc FROM tb_artista WHERE DATE_FORMAT(art_datanasc, '%Y') = DATE_FORMAT(NOW(), '%Y') - IDADE; 
	END IF;

	IF(PAIS = 0)THEN
		INSERT INTO tb_temp_pais(paises) SELECT pais_id FROM tb_pais WHERE pais_id IS NOT NULL;
		INSERT INTO tb_temp_estado(estados) SELECT est_id FROM tb_estado WHERE est_id IS NOT NULL;
		INSERT INTO tb_temp_cidade(cidades) SELECT cid_id FROM tb_cidade WHERE cid_id IS NOT NULL;
	ELSE
		INSERT INTO tb_temp_pais(paises) SELECT pais_id FROM tb_pais WHERE pais_id = PAIS;
		IF(ESTADO = 0 AND CIDADE = 0)THEN
			INSERT INTO tb_temp_estado(estados) SELECT est_id FROM tb_estado WHERE est_id IS NOT NULL;
			INSERT INTO tb_temp_cidade(cidades) SELECT cid_id FROM tb_cidade WHERE cid_id IS NOT NULL;
		ELSEIF(ESTADO <> 0 AND CIDADE = 0)THEN
			INSERT INTO tb_temp_estado(estados) SELECT est_id FROM tb_estado WHERE est_id = ESTADO;
			INSERT INTO tb_temp_cidade(cidades) SELECT cid_id FROM tb_cidade WHERE cid_id IS NOT NULL;
		ELSE
			INSERT INTO tb_temp_estado(estados) SELECT est_id FROM tb_estado WHERE est_id = ESTADO;
			INSERT INTO tb_temp_cidade(cidades) SELECT cid_id FROM tb_cidade WHERE cid_id = CIDADE;
		END IF;
	END IF;
	
	SELECT 
		usu_id AS idusu,
		usu_tipo_usu AS tipo,
		usu_foto AS foto,
		cat_nome AS categoria,
		art_nome AS nome,
		art_datanasc AS datanasc,
		pais_nome AS pais,
		est_nome AS estado,
		cid_nome AS cidade
		FROM tb_usuario
			INNER JOIN tb_artista ON art_usuid = usu_id
			INNER JOIN tb_categoria ON cat_id = art_catid
			INNER JOIN tb_localizacao ON loc_usuid = usu_id
			INNER JOIN tb_pais ON pais_id = loc_paisid
			INNER JOIN tb_estado ON est_id = loc_estid
			INNER JOIN tb_cidade ON cid_id  = loc_cidid
			WHERE usu_status = 1 AND usu_tipo_usu = 1 
				AND cat_id IN (SELECT categorias FROM tb_temp_categoria)
				AND art_datanasc IN (select datas from tb_temp_datas)
				AND pais_id IN (SELECT paises FROM tb_temp_pais) 
				AND est_id IN (SELECT estados FROM tb_temp_estado) 
				AND cid_id IN (SELECT cidades FROM tb_temp_cidade);

			/*Aparagando as tabelas temporárias*/
			DROP TABLE IF EXISTS tb_temp_categoria;
			DROP TABLE IF EXISTS tb_temp_datas;
			DROP TABLE IF EXISTS tb_temp_pais;
			DROP TABLE IF EXISTS tb_temp_estado;
			DROP TABLE IF EXISTS tb_temp_cidade;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_BUSCA_COMPANHIAS_COMPLEXO`(IN ps INT, IN es INT, IN cid INT)
BEGIN

	/*DECLARANDO AS VARIÁVEIS QUE SERÃO USADAS NO PROCESSO*/
    DECLARE PAIS, ESTADO, CIDADE INT;

	SET PAIS = ps, ESTADO = es, CIDADE = cid; 
	
	
	/*Criando a tabela temporária dos paises.*/	
	CREATE TEMPORARY TABLE tb_temp_pais(
		id        int auto_increment primary key,
		paises    int
	)
	ENGINE=MEMORY;
	
	/*Criando a tabela temporária dos estados.*/	
	CREATE TEMPORARY TABLE tb_temp_estado(
		id 		int auto_increment primary key,
		estados int
	)
	ENGINE=MEMORY;
	
	/*Criando a tabela temporária das cidades.*/	
	CREATE TEMPORARY TABLE tb_temp_cidade(
		id 			int auto_increment primary key,
		cidades     int
	)
	ENGINE=MEMORY;
	
	IF(PAIS = 0)THEN
		INSERT INTO tb_temp_pais(paises) SELECT pais_id FROM tb_pais WHERE pais_id IS NOT NULL;
		INSERT INTO tb_temp_estado(estados) SELECT est_id FROM tb_estado WHERE est_id IS NOT NULL;
		INSERT INTO tb_temp_cidade(cidades) SELECT cid_id FROM tb_cidade WHERE cid_id IS NOT NULL;
	ELSE
		INSERT INTO tb_temp_pais(paises) SELECT pais_id FROM tb_pais WHERE pais_id = PAIS;
		IF(ESTADO = 0 AND CIDADE = 0)THEN
			INSERT INTO tb_temp_estado(estados) SELECT est_id FROM tb_estado WHERE est_id IS NOT NULL;
			INSERT INTO tb_temp_cidade(cidades) SELECT cid_id FROM tb_cidade WHERE cid_id IS NOT NULL;
		ELSEIF(ESTADO <> 0 AND CIDADE = 0)THEN
			INSERT INTO tb_temp_estado(estados) SELECT est_id FROM tb_estado WHERE est_id = ESTADO;
			INSERT INTO tb_temp_cidade(cidades) SELECT cid_id FROM tb_cidade WHERE cid_id IS NOT NULL;
		ELSE
			INSERT INTO tb_temp_estado(estados) SELECT est_id FROM tb_estado WHERE est_id = ESTADO;
			INSERT INTO tb_temp_cidade(cidades) SELECT cid_id FROM tb_cidade WHERE cid_id = CIDADE;
		END IF;
	END IF;
	
	SELECT 
		usu_id AS idusu,
		usu_tipo_usu AS tipo,
		usu_foto AS foto,
		usu_site AS site,
		usu_telefone AS telefone,
		usu_celular AS celular,
		comp_razao_social AS rs,
		comp_nome_fantasia AS nf,
	    comp_cnpj AS cnpj,
		comp_insc_estadual AS ins_est,
		pais_nome AS pais,
		est_nome AS estado,
		cid_nome AS cidade
		FROM tb_usuario
			INNER JOIN tb_companhia ON comp_usuid = usu_id
			INNER JOIN tb_localizacao ON loc_usuid = usu_id
			INNER JOIN tb_pais ON pais_id = loc_paisid
			INNER JOIN tb_estado ON est_id = loc_estid
			INNER JOIN tb_cidade ON cid_id  = loc_cidid
			WHERE usu_status = 1 AND usu_tipo_usu = 2
				AND pais_id IN (SELECT paises FROM tb_temp_pais) 
				AND est_id IN (SELECT estados FROM tb_temp_estado) 
				AND cid_id IN (SELECT cidades FROM tb_temp_cidade);

			/*Aparagando as tabelas temporárias*/
			DROP TABLE IF EXISTS tb_temp_pais;
			DROP TABLE IF EXISTS tb_temp_estado;
			DROP TABLE IF EXISTS tb_temp_cidade;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_artista`
--

CREATE TABLE IF NOT EXISTS `tb_artista` (
  `art_id` int(11) NOT NULL AUTO_INCREMENT,
  `art_usuid` int(11) NOT NULL,
  `art_nome` varchar(70) DEFAULT NULL,
  `art_nome_artistico` varchar(70) DEFAULT NULL,
  `art_rg` varchar(16) DEFAULT NULL,
  `art_cpf` varchar(16) DEFAULT NULL,
  `art_drt` varchar(30) DEFAULT NULL,
  `art_catid` int(11) DEFAULT NULL,
  `art_datanasc` date DEFAULT NULL,
  PRIMARY KEY (`art_id`),
  KEY `fk_id_usuario` (`art_usuid`),
  KEY `fk_id_cat_no_artista` (`art_catid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_categoria`
--

CREATE TABLE IF NOT EXISTS `tb_categoria` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_nome` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `tb_categoria`
--

INSERT INTO `tb_categoria` (`cat_id`, `cat_nome`) VALUES
(1, 'Humor'),
(2, 'Drama'),
(3, 'Geral'),
(4, 'Zarzuela'),
(5, 'Music hall'),
(6, 'Circo-teatro'),
(7, 'Comédia-balé'),
(8, 'Burlesco'),
(9, 'Musical'),
(10, 'Tragédia'),
(11, 'Farsa'),
(12, 'Surrealismo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cidade`
--

CREATE TABLE IF NOT EXISTS `tb_cidade` (
  `cid_id` int(11) NOT NULL AUTO_INCREMENT,
  `cid_estid` int(11) NOT NULL,
  `cid_nome` varchar(50) NOT NULL,
  PRIMARY KEY (`cid_id`),
  KEY `fk_id_estado` (`cid_estid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Extraindo dados da tabela `tb_cidade`
--

INSERT INTO `tb_cidade` (`cid_id`, `cid_estid`, `cid_nome`) VALUES
(1, 1, 'Mogi das Cruzes'),
(2, 1, 'São Paulo'),
(3, 1, 'Campinas'),
(4, 1, 'Suzano'),
(5, 2, 'Angra do Reis'),
(6, 2, 'Macuco'),
(7, 2, 'Lurín'),
(8, 3, 'Abatia'),
(9, 3, 'Ampare'),
(10, 3, 'Leopolis'),
(11, 4, 'Callao'),
(12, 4, 'Rímac'),
(13, 4, 'Lurín'),
(14, 6, 'Cayma'),
(15, 6, 'La Joya'),
(16, 6, 'Miraflores'),
(17, 8, 'Buenos Aires'),
(18, 8, 'La Plata'),
(19, 9, 'Pilagás'),
(20, 9, 'Patiño'),
(21, 12, 'Toronto'),
(22, 12, 'Ottawa'),
(23, 13, 'Los Angeles'),
(24, 13, 'São Francisco'),
(25, 14, 'Dallas'),
(26, 14, 'Houston');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_companhia`
--

CREATE TABLE IF NOT EXISTS `tb_companhia` (
  `comp_id` int(11) NOT NULL AUTO_INCREMENT,
  `comp_usuid` int(11) NOT NULL,
  `comp_razao_social` varchar(70) DEFAULT NULL,
  `comp_nome_fantasia` varchar(70) DEFAULT NULL,
  `comp_cnpj` varchar(20) DEFAULT NULL,
  `comp_insc_estadual` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`comp_id`),
  KEY `fk_id_usuario_no_comp` (`comp_usuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_estado`
--

CREATE TABLE IF NOT EXISTS `tb_estado` (
  `est_id` int(11) NOT NULL AUTO_INCREMENT,
  `est_paisid` int(11) NOT NULL,
  `est_nome` varchar(40) NOT NULL,
  PRIMARY KEY (`est_id`),
  KEY `fk_id_pais` (`est_paisid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `tb_estado`
--

INSERT INTO `tb_estado` (`est_id`, `est_paisid`, `est_nome`) VALUES
(1, 1, 'São Paulo'),
(2, 1, 'Rio de Janeiro'),
(3, 1, 'Paraná'),
(4, 2, 'Lima'),
(6, 2, 'Arequipa'),
(8, 3, 'Buenos Aires'),
(9, 3, 'Formosa'),
(12, 4, 'Ontário'),
(13, 5, 'California'),
(14, 5, 'Texas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_experiencia`
--

CREATE TABLE IF NOT EXISTS `tb_experiencia` (
  `exp_id` int(11) NOT NULL AUTO_INCREMENT,
  `exp_usuid` int(11) NOT NULL,
  `exp_empresa` varchar(100) DEFAULT NULL,
  `exp_funcao` varchar(70) DEFAULT NULL,
  `exp_periodo_inicial` varchar(7) DEFAULT NULL,
  `exp_periodo_final` varchar(7) DEFAULT NULL,
  `exp_descricao` longtext,
  PRIMARY KEY (`exp_id`),
  KEY `fk_id_usu_na_exp` (`exp_usuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_formacao`
--

CREATE TABLE IF NOT EXISTS `tb_formacao` (
  `for_id` int(11) NOT NULL AUTO_INCREMENT,
  `for_usuid` int(11) NOT NULL,
  `for_instituto` varchar(70) DEFAULT NULL,
  `for_formacao` varchar(70) DEFAULT NULL,
  `for_periodo_inicial` varchar(7) DEFAULT NULL,
  `for_periodo_final` varchar(7) DEFAULT NULL,
  `for_descricao` longtext,
  PRIMARY KEY (`for_id`),
  KEY `fk_id_usu_na_formacao` (`for_usuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_localizacao`
--

CREATE TABLE IF NOT EXISTS `tb_localizacao` (
  `loc_id` int(11) NOT NULL AUTO_INCREMENT,
  `loc_usuid` int(11) DEFAULT NULL,
  `loc_paisid` int(11) DEFAULT NULL,
  `loc_estid` int(11) DEFAULT NULL,
  `loc_cidid` int(11) DEFAULT NULL,
  `loc_bairro` varchar(50) DEFAULT NULL,
  `loc_endereco` varchar(100) DEFAULT NULL,
  `loc_numero` int(11) DEFAULT NULL,
  `loc_complemento` varchar(20) DEFAULT NULL,
  `loc_cep` varchar(9) DEFAULT NULL,
  PRIMARY KEY (`loc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_me_seguindo`
--

CREATE TABLE IF NOT EXISTS `tb_me_seguindo` (
  `meseg_id` int(11) NOT NULL AUTO_INCREMENT,
  `meseg_usuid` int(11) NOT NULL,
  `meseg_usuid_meseguindo` int(11) DEFAULT NULL,
  `meseg_data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`meseg_id`),
  KEY `fk_id_usu_no_meseg` (`meseg_usuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_midias_sociais`
--

CREATE TABLE IF NOT EXISTS `tb_midias_sociais` (
  `ms_id` int(11) NOT NULL AUTO_INCREMENT,
  `ms_usuid` int(11) NOT NULL,
  `ms_facebook` varchar(255) DEFAULT NULL,
  `ms_googleplus` varchar(255) DEFAULT NULL,
  `ms_twitter` varchar(255) DEFAULT NULL,
  `ms_linkedin` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ms_id`),
  KEY `fk_id_usu_nas_ms` (`ms_usuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pais`
--

CREATE TABLE IF NOT EXISTS `tb_pais` (
  `pais_id` int(11) NOT NULL AUTO_INCREMENT,
  `pais_nome` varchar(30) NOT NULL,
  PRIMARY KEY (`pais_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `tb_pais`
--

INSERT INTO `tb_pais` (`pais_id`, `pais_nome`) VALUES
(1, 'Brasil'),
(2, 'Perú'),
(3, 'Argentina'),
(4, 'Canadá'),
(5, 'Estado Unidos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_portfolio`
--

CREATE TABLE IF NOT EXISTS `tb_portfolio` (
  `port_id` int(11) NOT NULL AUTO_INCREMENT,
  `port_usuid` int(11) NOT NULL,
  `port_foto` varchar(70) NOT NULL,
  `port_titulo` varchar(70) NOT NULL,
  `port_descricao` longtext NOT NULL,
  `port_datahora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`port_id`),
  KEY `fk_id_usu_no_port` (`port_usuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_seguindo`
--

CREATE TABLE IF NOT EXISTS `tb_seguindo` (
  `seg_id` int(11) NOT NULL AUTO_INCREMENT,
  `seg_usuid` int(11) NOT NULL,
  `seg_usuid_seguindo` int(11) DEFAULT NULL,
  `seg_data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`seg_id`),
  KEY `fk_id_usu_no_seg` (`seg_usuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario`
--

CREATE TABLE IF NOT EXISTS `tb_usuario` (
  `usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_foto` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `usu_email` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `usu_senha` varchar(40) COLLATE latin1_spanish_ci DEFAULT NULL,
  `usu_telefone` varchar(14) COLLATE latin1_spanish_ci DEFAULT NULL,
  `usu_celular` varchar(15) COLLATE latin1_spanish_ci DEFAULT NULL,
  `usu_site` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `usu_datacad` date DEFAULT NULL,
  `usu_horacad` time DEFAULT NULL,
  `usu_tipo_usu` int(1) DEFAULT NULL,
  `usu_status` int(1) DEFAULT NULL,
  PRIMARY KEY (`usu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_artista`
--
ALTER TABLE `tb_artista`
  ADD CONSTRAINT `fk_id_cat_no_artista` FOREIGN KEY (`art_catid`) REFERENCES `tb_categoria` (`cat_id`),
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`art_usuid`) REFERENCES `tb_usuario` (`usu_id`);

--
-- Limitadores para a tabela `tb_cidade`
--
ALTER TABLE `tb_cidade`
  ADD CONSTRAINT `fk_id_estado` FOREIGN KEY (`cid_estid`) REFERENCES `tb_estado` (`est_id`);

--
-- Limitadores para a tabela `tb_companhia`
--
ALTER TABLE `tb_companhia`
  ADD CONSTRAINT `fk_id_usuario_no_comp` FOREIGN KEY (`comp_usuid`) REFERENCES `tb_usuario` (`usu_id`);

--
-- Limitadores para a tabela `tb_estado`
--
ALTER TABLE `tb_estado`
  ADD CONSTRAINT `fk_id_pais` FOREIGN KEY (`est_paisid`) REFERENCES `tb_pais` (`pais_id`);

--
-- Limitadores para a tabela `tb_experiencia`
--
ALTER TABLE `tb_experiencia`
  ADD CONSTRAINT `fk_id_usu_na_exp` FOREIGN KEY (`exp_usuid`) REFERENCES `tb_usuario` (`usu_id`);

--
-- Limitadores para a tabela `tb_formacao`
--
ALTER TABLE `tb_formacao`
  ADD CONSTRAINT `fk_id_usu_na_formacao` FOREIGN KEY (`for_usuid`) REFERENCES `tb_usuario` (`usu_id`);

--
-- Limitadores para a tabela `tb_me_seguindo`
--
ALTER TABLE `tb_me_seguindo`
  ADD CONSTRAINT `fk_id_usu_no_meseg` FOREIGN KEY (`meseg_usuid`) REFERENCES `tb_usuario` (`usu_id`);

--
-- Limitadores para a tabela `tb_midias_sociais`
--
ALTER TABLE `tb_midias_sociais`
  ADD CONSTRAINT `fk_id_usu_nas_ms` FOREIGN KEY (`ms_usuid`) REFERENCES `tb_usuario` (`usu_id`);

--
-- Limitadores para a tabela `tb_portfolio`
--
ALTER TABLE `tb_portfolio`
  ADD CONSTRAINT `fk_id_usu_no_port` FOREIGN KEY (`port_usuid`) REFERENCES `tb_usuario` (`usu_id`);

--
-- Limitadores para a tabela `tb_seguindo`
--
ALTER TABLE `tb_seguindo`
  ADD CONSTRAINT `fk_id_usu_no_seg` FOREIGN KEY (`seg_usuid`) REFERENCES `tb_usuario` (`usu_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
