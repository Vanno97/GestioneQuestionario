<?php

/**
 * Classe model che mappa la tabella questionario
 */
class Questionario
{
    /**
     * @var string Id del questionario
     */
    private $idQuestionario;

    /**
     * @var string Nome del questionario
     */
    private $nomeQuestionario;

    /**
     * @var Classe Classe a cui è associatto il questionario
     */
    private $classe;

    /**
     * @param string $idQuestionario
     * @param string $nomeQuestionario
     * @param Classe $classe
     */
    public function __construct(string $idQuestionario, string $nomeQuestionario, Classe $classe)
    {
        $this->idQuestionario = $idQuestionario;
        $this->nomeQuestionario = $nomeQuestionario;
        $this->classe = $classe;
    }

    /**
     * @return string
     */
    public function getIdQuestionario(): string
    {
        return $this->idQuestionario;
    }

    /**
     * @param string $idQuestionario
     */
    public function setIdQuestionario(string $idQuestionario)
    {
        $this->idQuestionario = $idQuestionario;
    }

    /**
     * @return string
     */
    public function getNomeQuestionario(): string
    {
        return $this->nomeQuestionario;
    }

    /**
     * @param string $nomeQuestionario
     */
    public function setNomeQuestionario(string $nomeQuestionario)
    {
        $this->nomeQuestionario = $nomeQuestionario;
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