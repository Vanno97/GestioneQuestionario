<?php

/**
 * This class provide a connection to DB
 * This class follow singleton pattern
 */
class DatabaseConnection
{
    /**
     * @var mysqli Connection to db
     * This object is static to follow the singleton pattern
     */
    private static $connection;

    /**
     * The constructor is private to follow singleton pattern
     */
    private function __construct()
    {
    }

    /**
     * @return mysqli
     * This static method retrieve the database connection
     */
    public static function getConnection(): mysqli
    {
        if(self::$connection == null) {
            $properties = parse_ini_file("app.ini");
            $host = $properties['host'];
            $port = $properties['port'];
            $username = $properties['username'];
            $password = $properties['password'];
            $database = $properties['database'];
            self::$connection = @new mysqli($host,$username,$password,$database,$port);
            if(self::$connection->connect_error) {
                die("Errore di connesione al db");
            }
        }
        return self::$connection;
    }
}