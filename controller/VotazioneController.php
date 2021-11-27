<?php
require_once "controller/BaseController.php";
require_once "model/dao/VotazioneDAO.php";
require_once "util/Authorization.php";

class VotazioneController implements BaseController
{
    private $dao;

    private $authorization;

    public function __construct()
    {
        $this->dao = new VotazioneDAO();
        $this->authorization = new Authorization();
    }

    /**
     * @inheritDoc
     */
    public function getAll()
    {
        if($this->authorization->checkAuthorization("ADMIN")) {
            return $this->dao->getAll();
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function read($id)
    {
        if($this->authorization->checkAuthorization("ADMIN")) {
            return $this->dao->read($id);
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function insert($model)
    {
        if($this->authorization->checkAuthorization(array("ADMIN","USER"),$_COOKIE['token'])) {
            return $this->dao->insert($model);
        }
        return "unauthorized.php";
    }

    /**
     * @inheritDoc
     */
    public function update($model)
    {
        if($this->authorization->checkAuthorization("ADMIN")) {
            return $this->dao->update($model);
        }
        return "unauthorized.php";
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        if($this->authorization->checkAuthorization("ADMIN")) {
            return $this->dao->delete($id);
        }
        return "unauthorized.php";
    }
}