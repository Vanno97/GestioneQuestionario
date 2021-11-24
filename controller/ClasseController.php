<?php
require_once "controller/BaseController.php";
require_once "model/dao/ClasseDAO.php";
require_once "util/Authorization.php";

class ClasseController implements BaseController
{
    private $dao;
    private $authorization;

    public function __construct()
    {
        $this->dao = new ClasseDAO();
        $this->authorization = new Authorization();
    }

    /**
     * @inheritDoc
     */
    public function getAll()
    {
        if($this->authorization->checkAuthorization("ADMIN", $_COOKIE['token'])) {
            return $this->dao->getAll();
        } else {
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function read($idClasse)
    {
        if($this->authorization->checkAuthorization("ADMIN", $_COOKIE['token'])) {
            return $this->dao->read($idClasse);
        } else {
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function insert($model)
    {
        if($this->authorization->checkAuthorization("ADMIN", $_COOKIE['token'])) {
            return $this->dao->insert($model);
        } else {
            return "unauthorized.php";
        }
    }

    /**
     * @inheritDoc
     */
    public function update($model)
    {
        if($this->authorization->checkAuthorization("ADMIN")) {
            return $this->dao->update($model);
        } else {
            return "unauthorized.php";
        }
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        if($this->authorization->checkAuthorization("ADMIN")) {
            return $this->dao->delete($id);
        } else {
            return "unauthorized.php";
        }
    }
}