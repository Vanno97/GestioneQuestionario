<?php
class Authorization
{
    /**
     * Questo metodo ci dice se siamo autorizzati
     * @param $roleToCheck string|array ruolo/ruoli che ci interessa per consentire l'accesso
     * @return bool Esito del controllo
     */
    public function checkAuthorization($roleToCheck, $token): bool
    {
        if(isset($_SESSION['token'])) {
            if($token == $_SESSION['token']) {
                if (isset($_SESSION['ruolo'])) {
                    if (is_array($roleToCheck)) {
                        if (in_array($_SESSION['ruolo'], $roleToCheck)) { //se il ruolo in sessione è presente nell'array fornito
                            return true;
                        }
                    } else {
                        if ($roleToCheck == $_SESSION['ruolo']) {
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }
}