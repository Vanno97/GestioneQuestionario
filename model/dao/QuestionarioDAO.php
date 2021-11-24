<?php
require_once "model/dao/BaseDao.php";
require_once "util/DatabaseConnection.php";
require_once "model/Questionario.php";
require_once "model/Classe.php";

class QuestionarioDAO implements BaseDao
{
    private const QUERY_ALL = "SELECT `questionario`.`id_questionario`, `questionario`.`nomeQuestionario`, `questionario`.`classe`,
                                      `classe`.`nomeClasse` FROM `questionario`
                                        JOIN `classe` ON `questionario`.`classe` = `classe`.`id_classe`";
    private const QUERY_READ = "SELECT `questionario`.`id_questionario`, `questionario`.`nomeQuestionario`, `questionario`.`classe`,
                                      `classe`.`nomeClasse` FROM `questionario`
                                        JOIN `classe` ON `questionario`.`classe` = `classe`.`id_classe` WHERE `id_questionario`=?";
    private const QUERY_INSERT = "INSERT INTO `questionario`(`id_questionario`, `nomeQuestionario`, `classe`) VALUES (?,?,?)";
    private const QUERY_UPDATE = "UPDATE `questionario` SET `id_questionario`=?,`nomeQuestionario`=?,`classe`=? WHERE `id_questionario`=?";
    private const QUERY_DELETE = "DELETE FROM `questionario` WHERE `id_questionario`=?";
    private const QUERY_READ_ALL_FROM_CLASSE = "SELECT * FROM `questionario` WHERE `classe`=?";

    /**
     * @inheritDoc
     */
    public function getAll(): array
    {
        $listaQuestionari = [];
        $connection = DatabaseConnection::getConnection();
        if($result = $connection->query(self::QUERY_ALL)) {
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $questionario = new Questionario(
                    $row['id_questionario'],
                    $row['nomeQuestionario'],
                    new Classe(
                        $row['classe'],
                        $row['nomeClasse']
                    )
                );
                $listaQuestionari[] = $questionario;
            }
        }
        return $listaQuestionari;
    }

    /**
     * @inheritDoc
     */
    public function read($id)
    {
        $connection = DatabaseConnection::getConnection();
        $statement = $connection->prepare(self::QUERY_READ);
        $statement->bind_param("s",$id);
        if($statement->execute()) {
            $row = $statement->get_result()->fetch_array(MYSQLI_ASSOC);
            $statement->close();
            return new Questionario(
                $row['id_questionario'],
                $row['nomeQuestionario'],
                new Classe(
                    $row['classe'],
                    $row['nomeClasse']
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
        if($model instanceof Questionario) {
            $idQuestionario = $model->getIdQuestionario();
            $nomeQuestionario = $model->getNomeQuestionario();
            $classe = $model->getClasse()->getIdClasse();
            $statement->bind_param("ssi",$idQuestionario,$nomeQuestionario,$classe);
            $result = $statement->execute();
            $statement->close();
            return $result;
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function update($model): bool
    {
        $connection = DatabaseConnection::getConnection();
        $statement = $connection->prepare(self::QUERY_UPDATE);
        if($model instanceof Questionario) {
            $idQuestionario = $model->getIdQuestionario();
            $nomeQuestionario = $model->getNomeQuestionario();
            $classe = $model->getClasse()->getIdClasse();
            $statement->bind_param("ssis",$idQuestionario,$nomeQuestionario,$classe,$idQuestionario);
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
        $statement->bind_param("s", $id);
        $result = $statement->execute();
        $statement->close();
        return $result;
    }

    /**
     * Questo metodo restituisce tutti i questionari di una classe
     * @param $classe int Classe da usare come filtri
     * @return array Lista dei progetti trovati
     */
    public function getAllFromClasse($classe) {
        $listaProgetti = [];
        $connection = DatabaseConnection::getConnection();
        $statement = $connection->prepare(self::QUERY_READ_ALL_FROM_CLASSE);
        $statement->bind_param("i", $classe);
        if($statement->execute()) {
            $result = $statement->get_result();
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $idQuestionario = $row['idquestionario'];
                $questionario = $this->read($idQuestionario);
                $listaProgetti[] = $questionario;
            }
        }
        return $listaProgetti;
    }
}