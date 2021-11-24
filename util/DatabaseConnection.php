<?php

/**
 * Classe per la connesione a DB
 */
class DatabaseConnection
{
    /**
     * @var mysqli Ogetto di connesione al DB
     */
    private static $connection;

    /**
     * Costruttore privato per evitare l'istanziazione dall'esterno
     */
    private function __construct() {

    }

    /**
     * @return mysqli|void metodo statico che restituisce l'istanza di connesione
     */
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