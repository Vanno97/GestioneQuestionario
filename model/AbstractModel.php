<?php

abstract class AbstractModel
{
    /**
     * This method execute a query to db and return all data
     * @param $query string to execute
     * @return array|false
     */
    protected function executeQuery(string $query)
    {
        $connection = DatabaseConnection::getConnection();
        $result = $connection->query($query);
        if(!$result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return false;
    }

    /**
     * This method retrieve a statement using the given query
     * @param string $query Query used to create statement
     * @return false|mysqli_stmt Return the statement, false if encounter an error
     */
    protected function getStatement(string $query) {
        $connection = DatabaseConnection::getConnection();
        return $connection->prepare($query);
    }

    /**
     * This method execute the given statement
     * @param mysqli_stmt $statement Statement to execute
     * @return array|false Return data of statement, false if encounter an error
     */
    protected function executeStatement(mysqli_stmt $statement) {
        $executeResult = $statement->execute();
        if($executeResult) {
            $result = $statement->get_result();
            if($result) {
                return $result->fetch_all(MYSQLI_ASSOC);
            }
        }
        return false;
    }
}