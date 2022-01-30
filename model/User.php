<?php
require_once "model/Database.php";
require_once "model/AbstractModel.php";

require_once "model/Role.php";

class User extends AbstractModel implements Database
{//
    /**
     * @var int
     */
    private $userId;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var array
     */
    private $role;

    /**
     * @param int $userId
     * @param string $username
     * @param string $password
     */
    public function __construct(int $userId = 0, string $username = "", string $password = "")
    {
        $this->userId = $userId;
        $this->username = $username;
        $this->password = $password;
        $this->role = [];
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return array
     */
    public function getRole(): array
    {
        return $this->role;
    }

    /**
     * @param Role $role
     */
    public function addRole(Role $role): void
    {
        $this->role[] = $role;
    }

    public static function getAll(): array
    {
        $userList = [];
        $query = "SELECT `user`.`user_id`, `user`.`username`, `user`.`password`,
                         `role`.`role_id`, `role`.`role_name`
                  FROM `user_roles`
                             JOIN `user` ON `user_roles`.`user_id` = `user`.`user_id`
                             JOIN `role` ON `user_roles`.`role_id` = `role`.`role_id`";
        $result = self::executeQuery($query);
        if($result) {
            $userList = self::retrieveData($result);
        }
        return $userList;
    }

    public static function read(int $id)
    {
        $query = "SELECT `user`.`user_id`, `user`.`username`, `user`.`password`,
                         `role`.`role_id`, `role`.`role_name`
                  FROM `user_roles`
                             JOIN `user` ON `user_roles`.`user_id` = `user`.`user_id`
                             JOIN `role` ON `user_roles`.`role_id` = `role`.`role_id`
                  WHERE `user`.`user_id`= ? ";
        $statement = self::getStatement($query);
        $statement->bind_param("i", $id);
        $result = self::executeStatement($statement);
        $userList = [];
        if($result) {
            $userList = self::retrieveData($result);
        }
        return $userList[0];
    }

    public static function insert($model): bool
    {
        $query = "CALL insertUser(?,?)";
        $statement = self::getStatement($query);
        if($model instanceof User) {
            $usernameToInsert = $model->getUsername();
            $passwordToInsert = $model->getPassword();
            $statement->bind_param("ss", $usernameToInsert, $passwordToInsert);
            $result = self::executeStatement($statement);
            $statement->close();
            return $result;
        }
        $statement->close();
        return false;
    }

    //TO CHECK
    public static function update($model): bool
    {
        if($model instanceof User) {
            $userRead = self::read($model->getUserId());
            if(count($model->getRole()) != count($userRead->getRole())) {
                $queryUpdateUser = "UPDATE `user` SET `username` = ?, `password` = ? WHERE `user_id` = ?";
                $connection = self::getStatementWithTransaction($queryUpdateUser);
                //$connection = DatabaseConnection::getConnection();
                //$connection->begin_transaction();
                //$statement = $connection['connection']->prepare($queryUpdateUser);
                $usernameToUpdate = $model->getUsername();
                $passwordToUpdate = $model->getPassword();
                $userIdToUpdate = $model->getUserId();
                $statement = $connection['statement'];
                $statement->bind_param("ssi", $usernameToUpdate, $passwordToUpdate, $userIdToUpdate);
                $updateUserResult = self::executeStatement($statement);
                $statement->close();
                $globalRoleUpdate = false;
                foreach ($model->getRole() as $role) {
                    $queryUpdateRole = "INSERT INTO `user_roles` (`user_id`,`role_id`) VALUES (?,?)";$statement = $connection['statement']->bind_param("ssi", $usernameToUpdate, $passwordToUpdate, $userIdToUpdate);
                    $statement = self::getStatementFromConnection($queryUpdateRole, $connection['connection']);
                    foreach ($userRead->getRole() as $existingRole) {
                        if($role->getRoleId() != $existingRole->getIdRole()) {
                            $userIdToUpdate = $model->getUserId();
                            $roleIdToUpdate = $role->getRoleId();
                            $statement->bind_param("ii", $userIdToUpdate, $roleIdToUpdate);
                            $updateUserResult = self::executeStatement($statement);
                            if(!$updateUserResult) {
                                $connection['connection']->rollback();
                                $globalRoleUpdate = false;
                                break 2;
                            }
                        }
                    }
                    $statement->close();
                    $globalRoleUpdate = true;
                }
                $statement->close();
                if(!$updateUserResult && !$globalRoleUpdate) {
                    $connection['connection']->rollback();
                    return false;
                } else {
                    $connection['connection']->commit();
                    return true;
                }
            } else {
                $query = "UPDATE `user` SET `username` = ?, `password` = ? WHERE `user_id` = ?";
                $statement = self::getStatement($query);
                $usernameToUpdate = $model->getUsername();
                $passwordToUpdate = $model->getPassword();
                $userIdToUpdate = $model->getUserId();
                $statement->bind_param("ssi", $usernameToUpdate, $passwordToUpdate, $userIdToUpdate);
                $result = self::executeStatement($statement);
                $statement->close();
                return $result;
            }
        }
        return false;
    }

    //to check
    public static function delete(int $id): bool
    {
        $queryDeleteUser = "DELETE FROM `user` WHERE `user_id` = ?";
        $connection = self::getStatementWithTransaction($queryDeleteUser);
        $statement = $connection['statement'];
        $statement->bind_param("i", $id);
        $userDeleteResult = self::executeStatement($statement);

        $queryDeleteUserRole = "DELETE FROM `user_roles` WHERE `user_id` = ?";
        $statement = self::getStatementFromConnection($statement, $connection['connection']);
        $statement->bind_param("i", $id);
        $userRoleDeleteResult = self::executeStatement($statement);
        if($userDeleteResult && $userRoleDeleteResult) {
             return true;
        }
        $connection['connection']->rollback();
        return false;
    }

    private static function retrieveData($result): array
    {
        $data = [];
        $user = new User();
        foreach ($result as $item) {
            $userIdRead = $item['user_id'];
            $toInsert = true;
            foreach ($data as $userRead) {
                if($userRead->getUserId() == $userIdRead) {
                    $toInsert = false;
                    break;
                } else {
                    $toInsert = true;
                }
            }
            if($toInsert) { //se l'utente non esiste nell'array lo aggiungi
                $user = new User();
                $usernameRead = $item['username'];
                $passwordRead = $item['password'];
                $roleId = $item['role_id'];
                $roleName = $item['role_name'];
                $user->setUserId($userIdRead);
                $user->setUsername($usernameRead);
                $user->setPassword($passwordRead);
                $roleToAdd = new Role($roleId, $roleName);
                $user->addRole($roleToAdd);
                $data[] = $user;
            } else {
                //controllo se nella riga ci sono ruoli da aggiungere su questo utente
                //ciclo utilizatto per ritrovare l'utente all'interno dell'array gia creato
                foreach ($data as $userToCheck) {
                    //controllo sull'id utente per stabilire quale sia da aggiornare
                    if($userToCheck->getUserId() == $userIdRead) {
                        $roleId = $item['role_id'];
                        //verifica dell'id del ruolo per stabilire se aggiungerlo
                        foreach ($user->getRole() as $role) {
                            if ($role->getRoleId() != $roleId) {
                                $roleId = $item['role_id'];
                                $roleName = $item['role_name'];
                                $roleToAdd = new Role($roleId, $roleName);
                                $user->addRole($roleToAdd);
                            }
                        }
                    }
                }
            }
        }
        return $data;
    }
}