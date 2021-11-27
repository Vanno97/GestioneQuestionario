<?php
require_once "model/dao/BaseDao.php";
require_once "util/DatabaseConnection.php";
require_once "model/Questionario.php";
require_once "model/Votazione.php";
require_once "model/Progetto.php";
require_once "model/dao/ClasseDAO.php";

class VotazioneDAO implements BaseDao
{
    private const QUERY_ALL = "SELECT `votazione`.`id_votazione`, `votazione`.`utente_votante`,
                                      `questionario`.`id_questionario`, `questionario`.`nomeQuestionario`, `questionario`.`classe`,
                                      `progetto`.`id_progetto`, `progetto`.`nome_progetto`, `progetto`.`dettagliImplementativi` FROM `votazione`
                                        JOIN `questionario` ON `votazione`.`id_questionario` = `questionario`.`id_questionario`
                                        JOIN `progetto` ON `votazione`.`id_progetto` = `progetto`.`id_progetto`
                                        JOIN `utenti` ON `votazione`.`utente_votante` = `utenti`.`id_utenti`";
    private const QUERY_READ = "SELECT `votazione`.`id_votazione`, `votazione`.`utente_votante`,
                                      `questionario`.`id_questionario`, `questionario`.`nomeQuestionario`, `questionario`.`classe` FROM `votazione`
                                        JOIN `questionario` ON `votazione`.`id_questionario` = `questionario`.`id_questionario`
                                        JOIN `progetto` ON `votazione`.`id_progetto` = `progetto`.`id_progetto`
                                        JOIN `utenti` ON `votazione`.`utente_votante` = `utenti`.`id_utenti` WHERE `id_votazione`=?";
    private const QUERY_INSERT = "INSERT INTO `votazione`(`id_questionario`, `id_progetto`, `utente_votante`) VALUES (?,?,?)";
    private const QUERY_UPDATE = "UPDATE `votazione` SET `id_questionario`=?,`id_progetto`=?,`utente_votante`=? WHERE `id_votazione`=?";
    private const QUERY_DELETE = "DELETE FROM `votazione` WHERE `id_votazione`=?";

    /**
     * @inheritDoc
     */
    public function getAll(): array
    {
        $listaVotazioni = [];
        $connection = DatabaseConnection::getConnection();
        if($result = $connection->query(self::QUERY_ALL)) {
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $classeDao = new ClasseDAO();
                $classe = $classeDao->read($row['classe']);
                $questionario = new Questionario(
                    $row['id_questionario'],
                    $row['nomeQuestionario'],
                    $classe
                );
                $votazione = new Votazione(
                    $row['id_votazione'],
                    $questionario,
                    new Progetto(
                        $row['id_progetto'],
                        $row['nome_progetto'],
                        $row['dettagliImplementativi'],
                        $questionario
                    ),
                    $row['utente_votante']
                );
                $listaVotazioni[] = $votazione;
            }
        }
        return $listaVotazioni;
    }

    /**
     * @inheritDoc
     */
    public function read($id)
    {
        $connection = DatabaseConnection::getConnection();
        $statement = $connection->prepare(self::QUERY_READ);
        $statement->bind_param("i", $id);
        if($statement->execute()) {
            $row = $statement->get_result()->fetch_array(MYSQLI_ASSOC);
            $statement->close();
            $classeDao = new ClasseDAO();
            $classe = $classeDao->read($row['classe']);
            $questionario = new Questionario(
                $row['id_questionario'],
                $row['nomeQuestionario'],
                $classe
            );
            return new Votazione(
                $row['id_votazione'],
                $questionario,
                new Progetto(
                    $row['id_progetto'],
                    $row['nome_progetto'],
                    $row['dettagliImplementativi'],
                    $questionario
                ),
                $row['utente_votante']
            );
        }
        $statement->close();
        return false;
    }

    /**
     * @inheritDoc
     * @param $model Votazione
     */
    public function insert($model): bool
    {
        $connection = DatabaseConnection::getConnection();
        $statement = $connection->prepare(self::QUERY_INSERT);
        $idQuestionario = $model->getQuestionario()->getIdQuestionario();
        $idProgetto = $model->getProgetto()->getIdProgetto();
        $utenteVotante = $model->getUtenteVotante();
        $statement->bind_param("sii",$idQuestionario, $idProgetto,$utenteVotante);
        $result = $statement->execute();
        $statement->close();
        return $result;
    }

    /**
     * @inheritDoc
     * @param $model Votazione
     */
    public function update($model): bool
    {
        $connection = DatabaseConnection::getConnection();
        $statement = $connection->prepare(self::QUERY_UPDATE);
        $idQuestionario = $model->getQuestionario();
        $idProgetto = $model->getProgetto();
        $utente_votante = $model->getUtenteVotante();
        $idVotazione = $model->getIdVotazione();
        $statement->bind_param("siii",$idQuestionario, $idProgetto, $utente_votante, $idVotazione);
        $result = $statement->execute();
        $statement->close();
        return $result;
    }

    /**
     * @inheritDoc
     */
    public function delete($id): bool
    {
        $connection = DatabaseConnection::getConnection();
        $statement = $connection->prepare(self::QUERY_DELETE);
        $statement->bind_param("i",$id);
        $result =  $statement->execute();
        $statement->close();
        return $result;
    }
}