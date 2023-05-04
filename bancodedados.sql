CREATE TABLE IF NOT EXISTS usuarios (
  iduser int(11) PRIMARY KEY AUTO_INCREMENT,
  login varchar(255),
  cargo varchar(255),
  nome varchar(255),
  permissao int(1),
  statususer int(1)
);

CREATE TABLE IF NOT EXISTS inicial (
  id INT(11) PRIMARY KEY AUTO_INCREMENT,
  sei VARCHAR(19),
  numsql VARCHAR(20),
  tipo VARCHAR(1),
  req VARCHAR(3),
  aprovadigital VARCHAR(20),
  fisico VARCHAR(20),
  dataprotocolo DATE,
  dataad DATE,
  tipoalvara1 VARCHAR(1),
  tipoalvara2 VARCHAR(1),
  tipoalvara3 VARCHAR(1),
  tipoprocesso VARCHAR(1),
  gerador TINYINT,
  aiu TINYINT,
  aquecimento TINYINT,
  cepac TINYINT,
  ou TINYINT,
  outorga TINYINT,
  rivi TINYINT,
  stand TINYINT,
  obs TEXT,
  sts VARCHAR(255),
  decreto VARCHAR(255),
  conclusao TINYINT
);

CREATE TABLE  IF NOT EXISTS distribuicao (
  id INT(11) PRIMARY KEY AUTO_INCREMENT,
  controleinterno INT(11) UNIQUE,
  tec VARCHAR(255),
  tectroca VARCHAR(255),
  adm VARCHAR(255),
  admsubst VARCHAR(255),
  admsubst2 VARCHAR(255),
  pi varchar(20),
  assuntopi VARCHAR(255),
  baixa VARCHAR(255),
  obs1 TEXT,
  obs2 TEXT,
  FOREIGN KEY (controleinterno) REFERENCES inicial(id)
);

CREATE TABLE IF NOT EXISTS admissibilidade (
  id INT(11) PRIMARY KEY AUTO_INCREMENT,  
  controleinterno INT(11) UNIQUE,
  coordenadoria VARCHAR(2),
  dataenvio DATE,
  parecer VARCHAR(1),
  sub INT(2),
  categoria INT(1),
  FOREIGN KEY (controleinterno) REFERENCES inicial(id)
);

CREATE TABLE IF NOT EXISTS reconsideracao_admissibilidade (
 id INT(11) PRIMARY KEY AUTO_INCREMENT, 
 controleinterno INT(11) UNIQUE,
 dataenvio date,
 datapubli date,
 datarecon date, 
 parecer varchar(1),
 FOREIGN KEY (controleinterno) REFERENCES inicial(id)
);

CREATE TABLE IF NOT EXISTS secretarias (
 id INT(11) PRIMARY KEY AUTO_INCREMENT, 
 controleinterno INT(11) UNIQUE,
interfacesehab tinyint,
interfacesiurb tinyint,
interfacesmc tinyint,
interfacesmt tinyint,
interfacesvma tinyint,
sehab varchar (19),
siurb varchar(19),
smc varchar(19),
smt varchar(19),
svma varchar(19),
tec varchar(19),
tec2 varchar(19),
 FOREIGN KEY (controleinterno) REFERENCES inicial(id)
);

CREATE TABLE IF NOT EXISTS conclusao (
  id INT PRIMARY KEY AUTO_INCREMENT,
  controleinterno INT(11) UNIQUE,
  dataapostilamento DATE,
  dataconclusao DATE,
  dataemissao DATE,
  dataoutorga DATE,
  dataresposta DATE,
  datatermo DATE,
  numeroalvara VARCHAR(255),
  obs TEXT,
  outorga TINYINT,
  FOREIGN KEY (controleinterno) REFERENCES inicial(id)
);

CREATE TABLE IF NOT EXISTS graproem (
  id INT PRIMARY KEY AUTO_INCREMENT,
  controleinterno INT(11) UNIQUE,
  complementar TINYINT,
  dataagendada DATE,
  datacoord DATE,
  datacumprimento DATE,
  datainicio DATE,
  datalimite DATE,
  datapubli DATE,
  datapublicomplementar DATE,
  datareal DATE,
  dataresposta DATE,
  datasehab DATE,
  datasiurb DATE,
  datasmc DATE,
  datasmt DATE,
  datasmul DATE,
  datasvma DATE,
  graproem INT(1),
  instancia INT(1),
  motivo INT(1),
  obs TEXT,
  parecer INT(1),
  FOREIGN KEY (controleinterno) REFERENCES inicial(id)
);

CREATE TABLE IF NOT EXISTS motivoinad (
    id INT PRIMARY KEY AUTO_INCREMENT,
    descricao varchar(255)
);

CREATE TABLE IF NOT EXISTS motivoinad_rel (
    id INT PRIMARY KEY AUTO_INCREMENT,
    controleinterno INT(11) UNIQUE,
    idmotivo INT(11),
    descricao varchar(255),
    FOREIGN KEY (controleinterno) REFERENCES inicial(id),
    FOREIGN KEY (idmotivo) REFERENCES motivoinad(id)
);

CREATE TABLE IF NOT EXISTS suspensao_prazo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    controleinterno INT(11) UNIQUE,
    datainicio date,
    datafim date,
    motivo int (1),
    etapa int (1),
    FOREIGN KEY (controleinterno) REFERENCES inicial(id)
);


CREATE TABLE IF NOT EXISTS `graproem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controleinterno` int(11) NOT NULL,
  `complementar` tinyint(1) NOT NULL,
  `dataagendada` date DEFAULT NULL,
  `datacoord` date DEFAULT NULL,
  `datacumprimento` date DEFAULT NULL,
  `datainicio` date DEFAULT NULL,
  `datalimite` date DEFAULT NULL,
  `datapubli` date DEFAULT NULL,
  `datapublicomplementar` date DEFAULT NULL,
  `datareal` date DEFAULT NULL,
  `dataresposta` date DEFAULT NULL,
  `datasehab` date DEFAULT NULL,
  `datasiurb` date DEFAULT NULL,
  `datasmc` date DEFAULT NULL,
  `datasmt` date DEFAULT NULL,
  `datasmul` date DEFAULT NULL,
  `datasvma` date DEFAULT NULL,
  `graproem` int(1) NOT NULL,
  `instancia` int(1) NOT NULL,
  `motivo` int(1) NOT NULL,
  `obs` text,
  `parecer` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_graproem_inicial` (`controleinterno`),
  CONSTRAINT `fk_graproem_inicial` FOREIGN KEY (`controleinterno`) REFERENCES `inicial` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


