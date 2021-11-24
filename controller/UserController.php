<?php
require_once "controller/BaseController.php";

class UserController implements BaseController
{
    private $dao;
    private $authorization;

    public function __construct()
    {
        $this->dao = new UtentiDao();
        $this->authorization = new Authorization();
    }

    /**
     * @inheritDoc
     */
    public function getAll()
    {
        if($this->authorization->checkAuthorization("ADMIN")) {
            $this->dao->getAll();
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function read($idUtente)
    {
        if($this->authorization->checkAuthorization("ADMIN")) {
            $this->dao->read($idUtente);
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function insert($model)
    {
        // TODO: Implement insert() method.
    }

    /**
     * @inheritDoc
     */
    public function update($model)
    {
        // TODO: Implement update() method.
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * Metodo utilizzato per il login dell'utente
     * @param $username string Username dell'utente
     * @param $password string Password dell'utente
     * @return bool|Utenti false se il login fallisce, l'oggeto dell'utente altrimenti
     */
    public function login(string $username, string $password) {
        if($this->authorization->checkAuthorization(array("USER","ADMIN"))) {
            return $this->dao->login($username,$password);
        }
        return false;
    }
}