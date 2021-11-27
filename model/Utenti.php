<?php

/**
 * Classe model che mappa la tabella utenti
 */
class Utenti
{
    /**
     * @var int Id dell'utente
     */
    private $idUtente;

    /**
     * @var string Username dell'utente
     */
    private $username;

    /**
     * @var string Password dell'utente
     */
    private $password;

    /**
     * @var string Tipologia dell'utente
     */
    private $type;

    /**
     * @var Classe Lista di classi a cui appartiene l'utente
     */
    private $classe;

    /**
     * @param int $idUtente
     * @param string $username
     * @param string $password
     * @param string $type
     * @param Classe $classe
     */
    public function __construct(int $idUtente, string $username, string $password, string $type, Classe $classe)
    {
        $this->idUtente = $idUtente;
        $this->username = $username;
        $this->password = $password;
        $this->type = $type;
        $this->classe = $classe;
    }

    /**
     * @return int
     */
    public function getIdUtente(): int
    {
        return $this->idUtente;
    }

    /**
     * @param int $idUtente
     */
    public function setIdUtente(int $idUtente)
    {
        $this->idUtente = $idUtente;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return Classe
     */
    public function getClasse(): Classe
    {
        return $this->classe;
    }

    /**
     * @param Classe $classe
     */
    public function setClasse(Classe $classe)
    {
        $this->classe = $classe;
    }
}