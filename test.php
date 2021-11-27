<?php
require_once "model/dao/UtentiDAO.php";
$dao = new UtentiDao();
var_dump($dao->read(1));