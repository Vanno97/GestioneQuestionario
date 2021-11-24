<?php
require_once "model/dao/ProgettoDAO.php";
$dao = new ProgettoDAO();
var_dump($dao->getAllByQuestionario('V0750019'));