<?php
require_once "util/DatabaseConnection.php";

/**
 * This Abstract Class implements method to interface with the DB
 */
abstract class AbstractModel
{
    /**
     * This method execute a query to db and return all data
     * @param $query string to execute
     * @return array|false
     */
    protected static function executeQuery(string $query)
    {
        $connection = DatabaseConnection::getConnection();
        $result = $connection->query($query);
        if($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return false;
    }

    /**
     * This method retrieve a statement using the given query
     * @param string $query Query used to create statement
     * @return false|mysqli_stmt Return the statement, false if encounter an error
     */
    protected static function getStatement(string $query) {
        $connection = DatabaseConnection::getConnection();
        return $connection->prepare($query);
    }

    /**
     * This method retrieve a statement using the given query and the given connection
     * @param string $query Query used to create statement
     * @param mysqli $connection Connection used to create statement
     * @return false|mysqli_stmt Return the statement, false if encounter an error
     */
    protected static function getStatementFromConnection(string $query, mysqli $connection) {
        return $connection->prepare($query);
    }

    /**
     * This method retrieve a statement using the given query and open a transaction
     * @param string $query Query used to create a statement
     * @return array Return the statement and connection
     */
    protected static function getStatementWithTransaction(string $query): array
    {
        $connection = DatabaseConnection::getConnection();
        $connection->begin_transaction();
        $dbConnectionAndStatement['connection'] = $connection;
        $dbConnectionAndStatement['statement'] = $connection->prepare($query);
        return $dbConnectionAndStatement;
    }

    /**
     * This method execute the given statement
     * @param mysqli_stmt $statement Statement to execute
     * @return array|false Return data of statement, false if encounter an error
     */
    protected static function executeStatement(mysqli_stmt $statement) {
        $executeResult = $statement->execute();
        if($executeResult) {
            $result = $statement->get_result();
            if($result instanceof mysqli_result) {
                return $result->fetch_all(MYSQLI_ASSOC);
            } else {
                return true;
            }
        }
        return false;
    }
}