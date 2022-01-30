<?php

/**
 * This interface give the base method used for insert/retrieve data to/from DB
 */
interface Database
{
    /**
     * @return array
     * This method retrieve all element of the entity
     */
    public static function getAll(): array;

    /**
     * This method retrieve one element match with the given ID
     * @param int $id ID of the entity to read
     * @return mixed | false Result of the read. False if fail or nothing read
     */
    public static function read(int $id);

    /**
     * This method insert the model to DB
     * @param mixed $model Entity to insert
     * @return bool Result of insert
     */
    public static function insert($model): bool;

    /**
     * This method update the vien entity to DB
     * @param mixed $model Entity to update
     * @return bool Result of update
     */
    public static function update($model): bool;

    /**
     * This method delete the entity related to given ID
     * @param int $id ID of the entity to be removed
     * @return bool Result of delete
     */
    public static function delete(int $id): bool;
}