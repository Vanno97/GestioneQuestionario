<?php
session_start();
require_once "model/dao/UtentiDAO.php";

class Authentication
{

    /**
     * Metodo per generare l'autenticazione. Prende nome utente e password, esegue il login e se i dati sono correti
     * setta il token di autenticazione in sessione e lo restituisce. Se i dati sono sbagli restituisce false
     * @param $username
     * @param $password
     * @return string|bool
     */
    public function login($username, $password) {
        $utentiDao = new UtentiDao();
        $utente = $utentiDao->login($username,md5($password));
        if($utente) {
            $seed = "bMPkx1c4V43oTOoU9o3Jr+fRigGOl8sMJtE5xwI8Z/sGbIoK5dg3Qf8aPZXEwCLAColWzTKKQpuDaFOoG7OnJA==";
            $passwordEncrypted = md5($utente->getPassword());
            $tempToken = str_split($seed.$passwordEncrypted);
            $tempTokenCoded = '';
            foreach ($tempToken as $char) {
                $tempTokenCoded = $tempTokenCoded . $char . rand(0,100);
            }
            $defToken = md5($tempTokenCoded);
            $_SESSION['token'] = $defToken;
            $_SESSION['ruolo'] = $utente->getType();
            $_SESSION['username'] = $utente->getUsername();
            $utente->setPassword("");
            var_dump("hey");
            var_dump($utente);
            setcookie('classe',$utente->getClassi()[0],time()+1200);
            return $defToken;
        }
        return false;
    }
}