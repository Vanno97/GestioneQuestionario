CREATE TABLE `classe` (
    `id_classe` INT AUTO_INCREMENT,
    `nomeClasse` VARCHAR(50),
    PRIMARY KEY(`id_classe`)
);

INSERT INTO `classe` (`nomeclasse`) VALUES ('NESSUNA CLASSE');

CREATE TABLE `utenti` (
    `id_utenti` INT AUTO_INCREMENT,
    `username` VARCHAR(50),
    `password` VARCHAR(50),
    `type` VARCHAR(50),
    `classe` INT,
    PRIMARY  KEY(`id_utenti`),
    FOREIGN KEY(`classe`) REFERENCES `classe`(`id_classe`)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

INSERT INTO `utenti` (`username`,`password`,`type`,`classe`) VALUES ('admin','21232f297a57a5a743894a0e4a801fc3','ADMIN',1);

/*CREATE TABLE `utenti_classe` (
    `id_utente` INT,
    `id_classe` INT,
    FOREIGN KEY (`id_utente`) REFERENCES `utenti`(`id_utenti`)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    FOREIGN KEY (`id_classe`) REFERENCES `classe`(`id_classe`)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);*/

CREATE TABLE `questionario` (
    `id_questionario` VARCHAR(50),
    `nomeQuestionario` VARCHAR(50),
    `classe` INT,
    PRIMARY KEY(`id_questionario`),
    FOREIGN KEY(`classe`) REFERENCES `classe`(`id_classe`)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

CREATE TABLE `progetto` (
    `id_progetto` INT AUTO_INCREMENT,
    `nome_progetto` VARCHAR(100),
    `dettagliImplementativi` VARCHAR(36535),
    `questionario` VARCHAR(50),
    PRIMARY KEY(`id_progetto`),
    FOREIGN KEY(`questionario`) REFERENCES `questionario`(`id_questionario`)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

CREATE TABLE `votazione` (
    `id_votazione` INT AUTO_INCREMENT,
    `id_questionario` VARCHAR(50),
    `id_progetto` INT(50),
    `utente_votante` INT,
    PRIMARY KEY(`id_votazione`),
    FOREIGN KEY(`id_questionario`) REFERENCES `questionario`(`id_questionario`)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    FOREIGN KEY(`id_progetto`) REFERENCES `progetto`(`id_progetto`)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY(`utente_votante`) REFERENCES `utenti`(`id_utenti`)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);