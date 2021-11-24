<?php
require_once "controller/BaseController.php";
require_once "model/dao/QuestionarioDAO.php";
require_once "util/Authorization.php";

class QuestionarioController implements BaseController
{
    private $dao;
    private $authorization;

    public function __construct()
    {
        $this->dao = new QuestionarioDAO();
        $this->authorization = new Authorization();
    }

    /**
     * @inheritDoc
     */
    public function getAll()
    {
        if($this->authorization->checkAuthorization("ADMIN", $_COOKIE['token'])) {
            return $this->dao->getAll();
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function read($idQuestionario)
    {
        if($this->authorization->checkAuthorization(array("ADMIN","USER"),$_COOKIE['token'])) {
            return $this->dao->read($idQuestionario);
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function insert($model)
    {
        if($this->authorization->checkAuthorization("ADMIN", $_COOKIE['token'])) {
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
    public function delete($idQuestionario)
    {
        if($this->authorization->checkAuthorization("ADMIN")) {
            return $this->dao->delete($idQuestionario);
        }
    }

    public function getAllByClasse($classe) {
        if($this->authorization->checkAuthorization(array("ADMIN","USER"),$_COOKIE['token'])) {
            return $this->dao->getAllFromClasse($classe);
        }
    }
}