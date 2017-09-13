<?php

namespace UFT\PdiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PDI
 *
 * @ORM\Table(name="pdi")
 * @ORM\Entity(repositoryClass="UFT\PdiBundle\Repository\PDIRepository")
 */
class PDI
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
     * @ORM\Column(name="ano_inicio", type="datetime")
     */
    private $anoInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ano_fim", type="datetime")
     */
    private $anoFim;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ano_vigente", type="datetime")
     */
    private $anoVigente;

	/**
	 * Many Users have Many Groups.
	 * @ORM\ManyToMany(targetEntity="Tarefa", inversedBy="pdi")
	 * @ORM\JoinTable(name="pdi_tarefa")
	 */
	private $tarefas;

	/**
	 * Many Users have Many Groups.
	 * @ORM\ManyToMany(targetEntity="UG", inversedBy="pdis")
	 * @ORM\JoinTable(name="pdi_ug")
	 */
	private $ugs;

	/**
	 * Many Users have Many Groups.
	 * @ORM\ManyToMany(targetEntity="Categoria", inversedBy="pdi")
	 * @ORM\JoinTable(name="pdi_categoria")
	 */
	private $categorias;
	/**
	 * Many Users have Many Groups.
	 * @ORM\ManyToMany(targetEntity="Indicador", inversedBy="pdi")
	 * @ORM\JoinTable(name="pdi_indicador")
	 */
	private $indicadores;

	/**
	 * PDI constructor.
	 */
	public function __construct()
	{
		$this->tarefas = new ArrayCollection();
		$this->ugs = new ArrayCollection();
		$this->categorias = new ArrayCollection();
	}


	/**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return PDI
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
     *
     * @return PDI
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
     * Set anoInicio
     *
     * @param \DateTime $anoInicio
     *
     * @return PDI
     */
    public function setAnoInicio($anoInicio)
    {
        $this->anoInicio = $anoInicio;

        return $this;
    }

    /**
     * Get anoInicio
     *
     * @return \DateTime
     */
    public function getAnoInicio()
    {
        return $this->anoInicio;
    }

    /**
     * Set anoFim
     *
     * @param \DateTime $anoFim
     *
     * @return PDI
     */
    public function setAnoFim($anoFim)
    {
        $this->anoFim = $anoFim;

        return $this;
    }

    /**
     * Get anoFim
     *
     * @return \DateTime
     */
    public function getAnoFim()
    {
        return $this->anoFim;
    }

    /**
     * Set anoVigente
     *
     * @param \DateTime $anoVigente
     *
     * @return PDI
     */
    public function setAnoVigente($anoVigente)
    {
        $this->anoVigente = $anoVigente;

        return $this;
    }

    /**
     * Get anoVigente
     *
     * @return \DateTime
     */
    public function getAnoVigente()
    {
        return $this->anoVigente;
    }
}

