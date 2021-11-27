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
    private $questionario;

    /**
     * @var Progetto
     */
    private $progetto;

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
        $this->questionario = $id_questionario;
        $this->progetto = $id_progetto;
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
    public function getQuestionario(): Questionario
    {
        return $this->questionario;
    }

    /**
     * @param Questionario $questionario
     */
    public function setQuestionario(Questionario $questionario): void
    {
        $this->questionario = $questionario;
    }

    /**
     * @return Progetto
     */
    public function getProgetto(): Progetto
    {
        return $this->progetto;
    }

    /**
     * @param Progetto $progetto
     */
    public function setProgetto(Progetto $progetto): void
    {
        $this->progetto = $progetto;
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