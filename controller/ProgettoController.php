<?php
require_once "controller/BaseController.php";
require_once "model/dao/ProgettoDAO.php";
require_once "util/Authorization.php";

class ProgettoController implements BaseController
{
    private $dao;
    private $authorization;

    public function __construct()
    {
        $this->dao = new ProgettoDAO();
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
    public function read($idProgetto)
    {
        if($this->authorization->checkAuthorization(array("ADMIN","USER"), $_COOKIE['token'])) {
            return $this->dao->read($idProgetto);
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function insert($model)
    {
        if($this->authorization->checkAuthorization("ADMIN",$_COOKIE['token'])) {
            $this->dao->insert($model);
        }
        return "unauthorized.php";
    }

    /**
     * @inheritDoc
     */
    public function update($model)
    {
        if($this->authorization->checkAuthorization("ADMIN")) {
            $this->dao->update($model);
        }
        return "unauthorized.php";
    }

    /**
     * @inheritDoc
     */
    public function delete($idProgetto)
    {
        if($this->authorization->checkAuthorization("ADMIN",$_COOKIE['token'])) {
            $this->dao->delete($idProgetto);
        }
    }

    public function getAllByQuestionario($questionario) {
        if($this->authorization->checkAuthorization(array("ADMIN","USER"),$_COOKIE['token'])) {
            return $this->dao->getAllByQuestionario($questionario);
        }
    }
}