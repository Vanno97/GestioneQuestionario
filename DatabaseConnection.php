<?php

class DatabaseConnection
{
    private static $connection;

    public static function getConnection() {
        if(!isset(self::$connection)) {
            self::$connection = @new mysqli("localhost","questionario","1234","progetti_di_classe");
            if(self::$connection->connect_error) {
                die("Errore con la connesione al DB");
            }
        }
        return self::$connection;
    }
}