<?php
require_once "controller/VotazioneController.php";
$dao = new VotazioneController();
echo "<pre>";
var_dump($dao->getRisultati());
echo "</pre>";