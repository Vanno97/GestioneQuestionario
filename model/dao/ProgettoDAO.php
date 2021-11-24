<?php
require_once "model/dao/BaseDao.php";
require_once "util/DatabaseConnection.php";
require_once "model/Progetto.php";
require_once "model/Questionario.php";
require_once "model/Classe.php";

class ProgettoDAO implements BaseDao
{
    private const QUERY_ALL = "SELECT * FROM `progetto`
                                    JOIN (SELECT * FROM `questionario` JOIN `classe` ON `questionario`.`classe` = `classe`.`id_classe`)
                                    `questionario` ON `progetto`.`questionario` = `questionario`.`id_questionario`";
    private const QUERY_READ = "SELECT * FROM `progetto`
                                    JOIN (SELECT * FROM `questionario` JOIN `classe` ON `questionario`.`classe` = `classe`.`id_classe`)
                                    `questionario` ON `progetto`.`questionario` = `questionario`.`id_questionario` WHERE `progetto`.`id_progetto`=?";
    private const QUERY_INSERT = "INSERT INTO `progetto`(`nome_progetto`, `dettagliImplementativi`, `questionario`) VALUES (?,?,?)";
    private const QUERY_UPDATE = "UPDATE `progetto` SET `nome_progetto`=?,`dettagliImplementativi`=?,`questionario`=? WHERE `id_progetto`=?";
    private const QUERY_DELETE = "DELETE FROM `progetto` WHERE `id_progetto`=?";
    private const QUERY_READ_ALL_BY_QUESTIONARIO = "SELECT * FROM `progetto` WHERE questionario = ?";

    /**
     * @inheritDoc
     */
    public function getAll(): array
    {
        $listaProgetti = [];
        $connection = DatabaseConnection::getConnection();
        if($result = $connection->query(self::QUERY_ALL)) {
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $progetto = new Progetto(
                    $row['id_progetto'],
                    $row['nome_progetto'],
                    $row['dettagliImplementativi'],
                    new Questionario(
                        $row['id_questionario'],
                        $row['nomeQuestionario'],
                        new Classe(
                            $row['id_classe'],
                            $row['nomeClasse']
                        )
                    )
                );
                $listaProgetti[] = $progetto;
            }
        }
        return $listaProgetti;
    }

    /**
     * @inheritDoc
     */
    public function read($idProgetto)
    {
        $connection = DatabaseConnection::getConnection();
        $statement = $connection->prepare(self::QUERY_READ);
        $statement->bind_param("i", $idProgetto);
        if($statement->execute()) {
            $row = $statement->get_result()->fetch_array(MYSQLI_ASSOC);
            return new Progetto(
                $row['id_progetto'],
                $row['nome_progetto'],
                $row['dettagliImplementativi'],
                new Questionario(
                    $row['id_questionario'],
                    $row['nomeQuestionario'],
                    new Classe(
                        $row['id_classe'],
                        $row['nomeClasse']
                    )
                )
            );
        }
        $statement->close();
        return false;
    }

    /**
     * @inheritDoc
     */
    public function insert($model): bool
    {
        $connection = DatabaseConnection::getConnection();
        $statement = $connection->prepare(self::QUERY_INSERT);
        if($model instanceof Progetto) {
            $nomeProgetto = $model->getNomeProgetto();
            $dettagliImplementativi = $model->getDettagliImplementativi();
            $questionario = $model->getQuestionario()->getIdQuestionario();
            $statement->bind_param("sss",$nomeProgetto, $dettagliImplementativi, $questionario);
            $result = $statement->execute();
            $statement->close();
            return $result;
        }
        $statement->close();
        return false;
    }

    /**
     * @inheritDoc
     */
    public function update($model): bool
    {
        $connection = DatabaseConnection::getConnection();
        $statement = $connection->prepare(self::QUERY_UPDATE);
        if($model instanceof Progetto) {
            $nomeProgetto = $model->getNomeProgetto();
            $dettagliImplementativi = $model->getDettagliImplementativi();
            $questionario = $model->getQuestionario()->getIdQuestionario();
            $idProgetto = $model->getIdProgetto();
            $statement->bind_param("sssi", $nomeProgetto, $dettagliImplementativi, $questionario,$idProgetto);
            $result = $statement->execute();
            $statement->close();
            return $result;
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function delete($id): bool
    {
        $connection = DatabaseConnection::getConnection();
        $statement = $connection->prepare(self::QUERY_DELETE);
        $statement->bind_param("i", $id);
        return $statement->execute();
    }

    /**
     * Questo metodo restiuisce la lista di progetti collegatti ad uno specifico questionario
     * @param $questionario string Id Questionario
     * @return array Lista dei progetti
     */
    public function getAllByQuestionario($questionario): array
    {
        $listaProgetti = [];
        $connection = DatabaseConnection::getConnection();
        $statement = $connection->prepare(self::QUERY_READ_ALL_BY_QUESTIONARIO);
        $statement->bind_param("s", $questionario);
        if($statement->execute()) {
            $result = $statement->get_result();
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $idProgetto = $row['id_progetto'];
                $listaProgetti[] = $this->read($idProgetto);
            }
        }
        return $listaProgetti;
    }
}