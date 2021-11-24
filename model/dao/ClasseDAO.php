<?php
require_once "model/dao/BaseDao.php";
require_once "util/DatabaseConnection.php";
require_once "model/Classe.php";

class ClasseDAO implements BaseDao
{
    private const QUERY_ALL = "SELECT * FROM `classe`";
    private const QUERY_READ = "SELECT * FROM `classe` WHERE `id_classe` = ?";
    private const QUERY_INSERT = "INSERT INTO `classe`(`nomeClasse`) VALUES (?)";
    private const QUERY_UPDATE = "UPDATE `classe` SET `nomeClasse`=? WHERE `id_classe` = ?";
    private const QUERY_DELETE = "DELETE FROM `classe` WHERE `id_classe` = ?";

    /**
     * @inheritDoc
     */
    public function getAll(): array
    {
        $listaClassi = [];
        $connection = DatabaseConnection::getConnection();
        if($result = $connection->query(self::QUERY_ALL)) {
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $listaClassi[] = new Classe(
                    $row['id_classe'],
                    $row['nomeClasse']
                );
            }
        }
        return $listaClassi;
    }

    /**
     * @inheritDoc
     */
    public function read($idClasse)
    {
        $connection = DatabaseConnection::getConnection();
        $statement = $connection->prepare(self::QUERY_READ);
        $statement->bind_param("i", $idClasse);
        if($statement->execute()) {
            $result = $statement->get_result();
            $row = $result->fetch_array(MYSQLI_ASSOC);
            return new Classe(
                $row['id_classe'],
                $row['nomeClasse']
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
        if($model instanceof Classe) {
            $nomeClasse = $model->getNomeClasse();
            $statement->bind_param("s", $nomeClasse);
            $result =  $statement->execute();
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
        if($model instanceof Classe) {
            $classeId = $model->getIdClasse();
            $nomeClasse = $model->getNomeClasse();
            $statement->bind_param("si",$classeId, $nomeClasse);
            $statement->close();
            return $statement->execute();
        }
        $statement->close();
        return false;
    }

    /**
     * @inheritDoc
     */
    public function delete($idClasse): bool
    {
        $connection = DatabaseConnection::getConnection();
        $statement = $connection->prepare(self::QUERY_DELETE);
        $statement->bind_param("i", $idClasse);
        $statement->close();
        return $statement->execute();
    }
}