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
     * @var array Lista di classi a cui appartiene l'utente
     */
    private $classi;

    /**
     * @param int $idUtente
     * @param string $username
     * @param string $password
     * @param string $type
     * @param array $classi
     */
    public function __construct(int $idUtente, string $username, string $password, string $type, array $classi)
    {
        $this->idUtente = $idUtente;
        $this->username = $username;
        $this->password = $password;
        $this->type = $type;
        $this->classi = $classi;
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
     * @return array
     */
    public function getClassi(): array
    {
        return $this->classi;
    }

    /**
     * @param array $classi
     */
    public function setClassi(array $classi)
    {
        $this->classi = $classi;
    }
}