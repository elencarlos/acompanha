<?php

namespace UFT\PdiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
	 * Many Groups have Many Users.
	 * @ORM\ManyToMany(targetEntity="Pessoa", mappedBy="tarefas")
	 */
	private $pessoas;

	/**
	 * Many Groups have Many Users.
	 * @ORM\ManyToMany(targetEntity="Departamento", mappedBy="tarefas")
	 */
	private $departamentos;

	/**
	 * Many Groups have Many Users.
	 * @ORM\ManyToMany(targetEntity="Categoria", mappedBy="tarefas")
	 */
	private $categorias;

	/**
	 * Many Groups have Many Users.
	 * @ORM\ManyToMany(targetEntity="Indicador", mappedBy="tarefas")
	 */
	private $indicadores;

	/**
	 * Many Tarefas have One Tarefa.
	 * @ORM\ManyToOne(targetEntity="Tarefa", inversedBy="filhos")
	 * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
	 */
	private $pai;

	/**
	 * One Category has Many Categories.
	 * @ORM\OneToMany(targetEntity="Tarefa", mappedBy="pai")
	 */
	private $filhos;

	/**
	 * One Product has Many Features.
	 * @ORM\OneToMany(targetEntity="Equipamento", mappedBy="tarefas")
	 */
	private $equipamentos;

	/**
	 * One Product has Many Features.
	 * @ORM\OneToMany(targetEntity="Anexo", mappedBy="tarefas")
	 */
	private $anexos;

	/**
	 * Tarefa constructor.
	 */
	public function __construct()
	{
		$this->pessoas = new ArrayCollection();
		$this->departamentos = new ArrayCollection();
		$this->categorias = new ArrayCollection();
		$this->indicadores = new ArrayCollection();
		$this->equipamentos = new ArrayCollection();
	}



	/**
	 * @return mixed
	 */
	public function getPessoas()
	{
		return $this->pessoas;
	}

	/**
	 * @param mixed $pessoas
	 */
	public function setPessoas($pessoas)
	{
		$this->pessoas = $pessoas;
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
	 * Get solicitacao
	 *
	 * @return string
	 */
	public function getSolicitacao()
	{
		return $this->solicitacao;
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
	 * Get nivel
	 *
	 * @return integer
	 */
	public function getNivel()
	{
		return $this->nivel;
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
	 * Get dataInicio
	 *
	 * @return \DateTime
	 */
	public function getDataInicio()
	{
		return $this->dataInicio;
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
	 * Get dataFim
	 *
	 * @return \DateTime
	 */
	public function getDataFim()
	{
		return $this->dataFim;
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
}
