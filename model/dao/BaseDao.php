<?php

/**
 * Interfaccia che firma i metodi base delle classi DAO
 */
interface BaseDao
{
    /**
     * Questo metodo restituisce tutti i record di un model
     * @return array lista di tutti gli elementi trovati
     */
    public function getAll(): array;

    /**
     * Questo metodo restiuisce un record collegato all'id fornito come parametro
     * @param $id mixed Id del record tra trovare
     * @return bool|mixed false se si è verificato un errore, altrimenti l'entita letta
     */
    public function read($id);

    /**
     * Questo metodo aggiunge un record
     * @param $model mixed record da aggiungere
     * @return bool true o false in base a se ha inserito il valore
     */
    public function insert($model): bool;

    /**
     * Questo metodo aggiorna un record
     * @param $model mixed record da aggiornare
     * @return bool true o false in base a se ha aggiornato il valore
     */
    public function update($model): bool;

    /**
     * Questo metodo eliminare un record colelgato all'id fornito
     * @param $id mixed id del record da eliminare
     * @return bool true o false in base a se ha elimato il valore
     */
    public function delete($id): bool;
}