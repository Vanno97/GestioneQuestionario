<?php

interface BaseController
{
    /**
     * Questo metodo resituisce la lista di tutti model, false se non siamo autorizzati
     * @return array|bool
     */
    public function getAll();

    /**
     * Questo metodo restituisce un singolo model collegato all'id fornito come parametro, false se non siamo autorizzati
     * @param $id mixed Id del model da recuperare
     * @return mixed|bool Model recuperato
     */
    public function read($id);

    /**
     * Questo metodo serve per inserire un nuovo model e restituisce true o false in base all'esito
     * @param $model mixed Model da inserire
     * @return bool|string Esito dell'inserimento oppure il messagio di erratta autenticazione
     */
    public function insert($model);

    /**
     * Questo metodo serve per aggiornare un model e restituisce true o false in abse all'esito
     * @param $model mixed Model da aggiornare
     * @return bool|string Esito dell'inserimento oppure il messagio di erratta autenticazione
     */
    public function update($model);

    /**
     * Questo metodo serve per eliminare un model collegatto all'id fornito e restituisce true o false in base all'esito
     * @param $id mixed Id del model da eliminare
     * @return bool|string Esito dell'inserimento oppure il messagio di erratta autenticazione
     */
    public function delete($id);
}