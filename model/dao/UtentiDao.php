<?php
require_once "util/DatabaseConnection.php";
require_once "model/dao/BaseDao.php";
require_once "model/Utenti.php";
require_once "model/Classe.php";
class UtentiDao implements BaseDao
{

    private const QUERY_ALL = "";
    //avendo l'id dell'utente;
    private const QUERY_READ = "SELECT * FROM `utenti_classe` JOIN `classe` ON `classe`.`id_classe` = `utenti_classe`.`id_classe` WHERE `utenti_classe`.`id_utente` = ?";
    private const QUERY_READ_ALL_ONLY_USER = "SELECT * FROM `utenti`";
    private const QUERY_READ_ONLY_USER = "SELECT * FROM `utenti` WHERE `id_utenti` = ?";
    private const QUERY_INSERT = "INSERT INTO `utenti`(`username`, `password`, `type`) VALUES (?,?,?,?)";
    private const QUERY_UPDATE = "UPDATE `utenti` SET `username`=?,`password`=?,`type`=? WHERE `id_utenti`=?";
    private const QUERY_DELETE = "DELETE FROM `utenti` WHERE `id_utenti`=?";

    private const QUERY_LOGIN = "SELECT * FROM `utenti` WHERE `username`=? AND `password`=?";

    /**
     * @inheritDoc
     */
    public function getAll(): array
    {
        $listaUtentiSenzaClasse = [];
        $listaUtenti = [];
        $connection = DatabaseConnection::getConnection();
        if($resultOnlyUser = $connection->query(self::QUERY_READ_ALL_ONLY_USER)){
            while ($rowUser = $resultOnlyUser->fetch_array(MYSQLI_ASSOC)) {
                $listaUtentiSenzaClasse[] = $rowUser;
            }
            foreach ($listaUtentiSenzaClasse as $value) {
                $listaClassi = [];
                $statement = $connection->prepare(self::QUERY_READ);
                $idUtente = (int)$value['id_utenti'];
                $statement->bind_param("i", $idUtente);
                if($statement->execute()) {
                    $result = $statement->get_result();
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        $listaClassi[] = new Classe(
                            $row['id_classe'],
                            $row['nomeClasse']
                        );
                    }
                    $listaUtenti[] = new Utenti(
                        $value['id_utenti'],
                        $value['username'],
                        $value['password'],
                        $value['type'],
                        $listaClassi
                    );
                    $statement->close();
                }
            }
        }
        return $listaUtenti;
    }

    /**
     * @inheritDoc
     * @param $id int Id dell utente da tra trovare
     */
    public function read($id)
    {
        $connection = DatabaseConnection::getConnection();
        $statement = $connection->prepare(self::QUERY_READ_ONLY_USER);
        $statement->bind_param("i", $id);
        if($statement->execute()) {
            $resultOnlyUser = $statement->get_result();
            $rowUser = $resultOnlyUser->fetch_array(MYSQLI_ASSOC);
            $utenteSenzaClasse = $rowUser;

            $listaClassi = [];
            $statement = $connection->prepare(self::QUERY_READ);
            $idUtente = (int)$utenteSenzaClasse['id_utenti'];
            $statement->bind_param("i", $idUtente);
            if($statement->execute()) {
                $result = $statement->get_result();
                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    $listaClassi[] = new Classe(
                        $row['id_classe'],
                        $row['nomeClasse']
                    );
                }
            }
            $utente = new Utenti(
                $utenteSenzaClasse['id_utenti'],
                $utenteSenzaClasse['username'],
                $utenteSenzaClasse['password'],
                $utenteSenzaClasse['type'],
                $listaClassi
            );
            return $utente;

        }
        return false;
    }

    /**
     * @inheritDoc
     * @param $model Utenti utente da inserire
     */
    public function insert($model): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     * @param $model Utenti utente da aggiornare
     */
    public function update($model): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     * @param $id int Id del utente da eliminare
     */
    public function delete($id): bool
    {
        return false;
    }

    /**
     * Metodo utilizzato per il login dell'utente
     * @param $username string Username dell'utente
     * @param $password string Password dell'utente
     * @return bool|Utenti false se il login fallisce, l'oggeto dell'utente altrimenti
     */
    public function login(string $username, string $password) {
        $connection = DatabaseConnection::getConnection();
        $statement = $connection->prepare(self::QUERY_LOGIN);
        $statement->bind_param("ss",$username,$password);
        if($statement->execute()) {
            $row = $statement->get_result()->fetch_array(MYSQLI_ASSOC);
            $idUtente = $row['id_utenti'];
            $statement->close();
            return $this->read($idUtente);
        }
        $statement->close();
        return false;
    }
}