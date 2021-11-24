<?php

/**
 * Classe model che mappa la tabella progetto
 */
class Progetto
{
    /**
     * @var int
     */
    private $id_progetto;

    /**
     * @var string
     */
    private $nome_progetto;

    /**
     * @var string
     */
    private $dettagliImplementativi;

    /**
     * @var Questionario
     */
    private $questionario;

    /**
     * @param int $id_progetto
     * @param string $nome_progetto
     * @param string $dettagliImplementativi
     * @param Questionario $questionario
     */
    public function __construct(int $id_progetto, string $nome_progetto, string $dettagliImplementativi, Questionario $questionario)
    {
        $this->id_progetto = $id_progetto;
        $this->nome_progetto = $nome_progetto;
        $this->dettagliImplementativi = $dettagliImplementativi;
        $this->questionario = $questionario;
    }

    /**
     * @return int
     */
    public function getIdProgetto(): int
    {
        return $this->id_progetto;
    }

    /**
     * @param int $id_progetto
     */
    public function setIdProgetto(int $id_progetto)
    {
        $this->id_progetto = $id_progetto;
    }

    /**
     * @return string
     */
    public function getNomeProgetto(): string
    {
        return $this->nome_progetto;
    }

    /**
     * @param string $nome_progetto
     */
    public function setNomeProgetto(string $nome_progetto)
    {
        $this->nome_progetto = $nome_progetto;
    }

    /**
     * @return string
     */
    public function getDettagliImplementativi(): string
    {
        return $this->dettagliImplementativi;
    }

    /**
     * @param string $dettagliImplementativi
     */
    public function setDettagliImplementativi(string $dettagliImplementativi)
    {
        $this->dettagliImplementativi = $dettagliImplementativi;
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
    public function setQuestionario(Questionario $questionario)
    {
        $this->questionario = $questionario;
    }
}