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
    public function __construct(int $roleId, string $roleName)
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
    public function getAll(): array
    {
        $roleList = [];
        $query = "SELECT * FROM `role`";
        $result = $this->executeQuery($query);
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
    public function read(int $id)
    {
        $query = "SELECT * FROM `role` WHERE `role_id` = ?";
        $statement = $this->getStatement($query);
        $statement->bind_param("i", $id);
        $result = $this->executeStatement($statement);
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
    public function insert($model): bool
    {
        // TODO: Implement insert() method.
        return false;
    }

    /**
     * @inheritDoc
     */
    public function update($model): bool
    {
        // TODO: Implement update() method.
        return false;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): bool
    {
        // TODO: Implement delete() method.
        return false;
    }
}