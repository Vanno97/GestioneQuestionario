<?php
require_once "model/Database.php";
require_once "model/AbstractModel.php";

class Role extends AbstractModel implements Database
{
    /**
     * @var int
     */
    private $roleId;

    /**
     * @var string
     */
    private $roleName;

    /**
     * @param int $roleId
     * @param string $roleName
     */
    public function __construct(int $roleId = 0, string $roleName = "")
    {
        $this->roleId = $roleId;
        $this->roleName = $roleName;
    }

    /**
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->roleId;
    }

    /**
     * @param int $roleId
     */
    public function setRoleId(int $roleId): void
    {
        $this->roleId = $roleId;
    }

    /**
     * @return string
     */
    public function getRoleName(): string
    {
        return $this->roleName;
    }

    /**
     * @param string $roleName
     */
    public function setRoleName(string $roleName): void
    {
        $this->roleName = $roleName;
    }

    /**
     * @inheritDoc
     */
    public static function getAll(): array
    {
        $roleList = [];
        $query = "SELECT * FROM `role`";
        $result = self::executeQuery($query);
        if($result) {
            foreach ($result as $item) {
                $roleList[] = new Role(
                    $item['role_id'],
                    $item['role_name']
                );
            }
        }
        return $roleList;
    }

    /**
     * @inheritDoc
     */
    public static function read(int $id)
    {
        $query = "SELECT * FROM `role` WHERE `role_id` = ?";
        $statement = self::getStatement($query);
        $statement->bind_param("i", $id);
        $result = self::executeStatement($statement);
        $statement->close();
        if($result) {
            foreach ($result as $item) {
                return new Role($item['role_id'], $item['role_name']);
            }
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public static function insert($model): bool
    {
        $query = "INSERT INTO `role`(`role_id`, `role_name`) VALUES (?,?)";
        $statement = self::getStatement($query);
        if($model instanceof Role) {
            $roleIdToInsert = $model->getRoleId();
            $roleNameToInsert = $model->getRoleName();
            $statement->bind_param("is", $roleIdToInsert, $roleNameToInsert);
            $result = self::executeStatement($statement);
            $statement->close();
            return $result;
        }
        $statement->close();
        return false;
    }

    /**
     * @inheritDoc
     */
    public static function update($model): bool
    {
        $query = "UPDATE `role` SET `role_name`=? WHERE `role_id`=?";
        $statement = self::getStatement($query);
        if($model instanceof Role) {
            $roleIdToUpdate = $model->getRoleId();
            $roleNameToUpdate = $model->getRoleName();
            $statement->bind_param("si", $roleNameToUpdate, $roleIdToUpdate);
            $result = self::executeStatement($statement);
            $statement->close();
            return $result;
        }
        $statement->close();
        return false;
    }

    /**
     * @inheritDoc
     */
    public static function delete(int $id): bool
    {
        $query = "DELETE FROM `role` WHERE `role_id` = ?";
        $statement = self::getStatement($query);
        $statement->bind_param("i", $id);
        $result = self::executeStatement($statement);
        $statement->close();
        return $result;
    }
}