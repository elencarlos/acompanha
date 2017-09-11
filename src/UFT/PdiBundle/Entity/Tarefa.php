<?php

namespace UFT\PdiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tarefa
 *
 * @ORM\Table(name="tarefa")
 * @ORM\Entity(repositoryClass="UFT\PdiBundle\Repository\TarefaRepository")
 */
class Tarefa
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="solicitacao", type="text")
     */
    private $solicitacao;

    /**
     * @var int
     *
     * @ORM\Column(name="nivel", type="integer")
     */
    private $nivel;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_inicio", type="datetime", nullable=true)
     */
    private $dataInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_fim", type="datetime", nullable=true)
     */
    private $dataFim;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set solicitacao
     *
     * @param string $solicitacao
     * @return Tarefa
     */
    public function setSolicitacao($solicitacao)
    {
        $this->solicitacao = $solicitacao;

        return $this;
    }

    /**
     * Get solicitacao
     *
     * @return string 
     */
    public function getSolicitacao()
    {
        return $this->solicitacao;
    }

    /**
     * Set nivel
     *
     * @param integer $nivel
     * @return Tarefa
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }

    /**
     * Get nivel
     *
     * @return integer 
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Set dataInicio
     *
     * @param \DateTime $dataInicio
     * @return Tarefa
     */
    public function setDataInicio($dataInicio)
    {
        $this->dataInicio = $dataInicio;

        return $this;
    }

    /**
     * Get dataInicio
     *
     * @return \DateTime 
     */
    public function getDataInicio()
    {
        return $this->dataInicio;
    }

    /**
     * Set dataFim
     *
     * @param \DateTime $dataFim
     * @return Tarefa
     */
    public function setDataFim($dataFim)
    {
        $this->dataFim = $dataFim;

        return $this;
    }

    /**
     * Get dataFim
     *
     * @return \DateTime 
     */
    public function getDataFim()
    {
        return $this->dataFim;
    }
}
