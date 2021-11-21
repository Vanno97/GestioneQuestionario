CREATE TABLE `utenti` (
    `utenti_id` INT AUTO_INCREMENT,
    `username` VARCHAR(50),
    `password` VARCHAR(50),
    PRIMARY KEY(`utenti_id`)
);

CREATE TABLE `questionario` (
    `questionario_id` INT UNIQUE,
    `nome_questionario` VARCHAR(50),
    `classe` VARCHAR(50)
);

CREATE TABLE `progetti` (
    `progetto_id` INT AUTO_INCREMENT,
    `nome_progetto` VARCHAR(50),
    `dettagli_implementativi` VARCHAR(10000),
    `questionario` INT,
    PRIMARY KEY(`progetto_id`),
    FOREIGN KEY(`questionario`) REFERENCES `questionario`(`questionario_id`)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

CREATE TABLE `scelte` (
    `id` INT AUTO_INCREMENT,
    `nome` VARCHAR(500) UNIQUE,
    `sceltaProgetto` INT,
    `questionario` INT,
    PRIMARY KEY(`id`)
);