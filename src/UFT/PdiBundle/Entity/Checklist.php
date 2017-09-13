<?php

namespace UFT\PdiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Checklist
 *
 * @ORM\Table(name="checklist")
 * @ORM\Entity(repositoryClass="UFT\PdiBundle\Repository\ChecklistRepository")
 */
class Checklist
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
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="text")
     */
    private $descricao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_inicio", type="datetime")
     */
    private $dataInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_fim", type="datetime", nullable=true)
     */
    private $dataFim;

    /**
     * @var float
     *
     * @ORM\Column(name="valor", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $valor;

    /**
     * @var bool
     *
     * @ORM\Column(name="ativo", type="boolean", nullable=true)
     */
    private $ativo;

	/**
	 * Many Features have One Product.
	 * @ORM\ManyToOne(targetEntity="Tarefa", inversedBy="checklists")
	 * @ORM\JoinColumn(name="tarefa_id", referencedColumnName="id")
	 */
	private $tarefa;

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
     * Set titulo
     *
     * @param string $titulo
     * @return Checklist
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     * @return Checklist
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string 
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set dataInicio
     *
     * @param \DateTime $dataInicio
     * @return Checklist
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
     * @return Checklist
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

    /**
     * Set valor
     *
     * @param float $valor
     * @return Checklist
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return float 
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set ativo
     *
     * @param boolean $ativo
     * @return Checklist
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;

        return $this;
    }

    /**
     * Get ativo
     *
     * @return boolean 
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

	/**
	 * @return mixed
	 */
	public function getTarefa()
	{
		return $this->tarefa;
	}

	/**
	 * @param mixed $tarefa
	 */
	public function setTarefa($tarefa)
	{
		$this->tarefa = $tarefa;
	}


}
