<?php

namespace UFT\PdiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Indicador
 *
 * @ORM\Table(name="indicador")
 * @ORM\Entity(repositoryClass="UFT\PdiBundle\Repository\IndicadorRepository")
 */
class Indicador
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
     * @ORM\Column(name="descricao", type="text", nullable=true)
     */
    private $descricao;

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
	 * Many Users have Many Groups.
	 * @ORM\ManyToMany(targetEntity="Tarefa", inversedBy="indicadores")
	 * @ORM\JoinTable(name="tarefa_indicador")
	 */
	private $tarefas;

	/**
	 * One Category has Many Categories.
	 * @ORM\OneToMany(targetEntity="Indicador", mappedBy="pai")
	 */
	private $filhos;

	/**
	 * Many Categories have One Category.
	 * @ORM\ManyToOne(targetEntity="Indicador", inversedBy="filhos")
	 * @ORM\JoinColumn(name="indicador_id", referencedColumnName="id")
	 */
	private $pai;

	/**
	 * Many Features have One Product.
	 * @ORM\ManyToOne(targetEntity="Pessoa", inversedBy="indicadoresResponsavel")
	 * @ORM\JoinColumn(name="pessoa_id", referencedColumnName="id")
	 */
	private $responsavel;

	/**
	 * Many Groups have Many Users.
	 * @ORM\ManyToMany(targetEntity="Pessoa", mappedBy="indicadores")
	 */
	private $pessoas;

	/**
	 * Many Features have One Product.
	 * @ORM\ManyToOne(targetEntity="PDI", inversedBy="indicadores")
	 * @ORM\JoinColumn(name="pdi_id", referencedColumnName="id")
	 */
	private $pdi;

	/**
	 * Indicador constructor.
	 */
	public function __construct()
	{
		$this->tarefas = new ArrayCollection();
		$this->filhos = new ArrayCollection();
	}


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
     * @return Indicador
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
     * @return Indicador
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
     * @return Indicador
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
     * @return Indicador
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
