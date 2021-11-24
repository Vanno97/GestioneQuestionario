<?php

/**
 * Classe model che mappa la tabella classe
 */
class Classe
{
    /**
     * @var int Id della classe
     */
    private $idClasse;

    /**
     * @var string Nome della classe
     */
    private $nomeClasse;

    /**
     * @param int $idClasse
     * @param string $nomeClasse
     */
    public function __construct(int $idClasse, string $nomeClasse)
    {
        $this->idClasse = $idClasse;
        $this->nomeClasse = $nomeClasse;
    }

    /**
     * @return int
     */
    public function getIdClasse(): int
    {
        return $this->idClasse;
    }

    /**
     * @param int $idClasse
     */
    public function setIdClasse(int $idClasse)
    {
        $this->idClasse = $idClasse;
    }

    /**
     * @return string
     */
    public function getNomeClasse(): string
    {
        return $this->nomeClasse;
    }

    /**
     * @param string $nomeClasse
     */
    public function setNomeClasse(string $nomeClasse)
    {
        $this->nomeClasse = $nomeClasse;
    }
}