<?php

class Votazione
{
    /**
     * @var int
     */
    private $id_votazione;

    /**
     * @var Questionario
     */
    private $id_questionario;

    /**
     * @var Progetto
     */
    private $id_progetto;

    /**
     * @var Utenti
     */
    private $utente_votante;

    /**
     * @param int $id_votazione
     * @param Questionario $id_questionario
     * @param Progetto $id_progetto
     * @param int $utente_votante
     */
    public function __construct(int $id_votazione, Questionario $id_questionario, Progetto $id_progetto, int $utente_votante)
    {
        $this->id_votazione = $id_votazione;
        $this->id_questionario = $id_questionario;
        $this->id_progetto = $id_progetto;
        $this->utente_votante = $utente_votante;
    }

    /**
     * @return int
     */
    public function getIdVotazione(): int
    {
        return $this->id_votazione;
    }

    /**
     * @param int $id_votazione
     */
    public function setIdVotazione(int $id_votazione): void
    {
        $this->id_votazione = $id_votazione;
    }

    /**
     * @return Questionario
     */
    public function getIdQuestionario(): Questionario
    {
        return $this->id_questionario;
    }

    /**
     * @param Questionario $id_questionario
     */
    public function setIdQuestionario(Questionario $id_questionario): void
    {
        $this->id_questionario = $id_questionario;
    }

    /**
     * @return Progetto
     */
    public function getIdProgetto(): Progetto
    {
        return $this->id_progetto;
    }

    /**
     * @param Progetto $id_progetto
     */
    public function setIdProgetto(Progetto $id_progetto): void
    {
        $this->id_progetto = $id_progetto;
    }

    /**
     * @return int
     */
    public function getUtenteVotante(): int
    {
        return $this->utente_votante;
    }

    /**
     * @param int $utente_votante
     */
    public function setUtenteVotante(int $utente_votante): void
    {
        $this->utente_votante = $utente_votante;
    }
}