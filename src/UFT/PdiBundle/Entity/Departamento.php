<?php

namespace UFT\PdiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Departamento
 *
 * @ORM\Table(name="departamento")
 * @ORM\Entity(repositoryClass="UFT\PdiBundle\Repository\DepartamentoRepository")
 */
class Departamento
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
     * @ORM\Column(name="nome", type="string", length=255)
     */
    private $nome;

	/**
	 * Many Users have Many Groups.
	 * @ORM\ManyToMany(targetEntity="Tarefa", inversedBy="departamentos")
	 * @ORM\JoinTable(name="tarefa_departamento")
	 */
	private $tarefas;

	/**
	 * Many Tarefas have One Tarefa.
	 * @ORM\ManyToOne(targetEntity="Departamento", inversedBy="filhos")
	 * @ORM\JoinColumn(name="departamento_id", referencedColumnName="id")
	 */
	private $pai;

	/**
	 * One Category has Many Tarefa.
	 * @ORM\OneToMany(targetEntity="Departamento", mappedBy="pai")
	 */
	private $filhos;

	/**
	 * One Product has Many Features.
	 * @ORM\OneToMany(targetEntity="UG", mappedBy="departamento")
	 */
	private $ugs;

	/**
	 * Departamento constructor.
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
     * Set nome
     *
     * @param string $nome
     * @return Departamento
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }
}
