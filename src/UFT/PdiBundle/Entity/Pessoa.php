<?php

namespace UFT\PdiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Pessoa
 *
 * @ORM\Table(name="pessoa")
 * @ORM\Entity(repositoryClass="UFT\PdiBundle\Repository\PessoaRepository")
 */
class Pessoa
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
	 * @ORM\ManyToMany(targetEntity="Tarefa", inversedBy="pessoas")
	 * @ORM\JoinTable(name="pessoa_tarefa")
	 */
	private $tarefas;

	/**
	 * Many Users have Many Groups.
	 * @ORM\ManyToMany(targetEntity="Cargo", inversedBy="pessoas")
	 * @ORM\JoinTable(name="pessoa_cargo")
	 */
	private $cargos;

	/**
	 * Many Users have Many Groups.
	 * @ORM\ManyToMany(targetEntity="Indicador", inversedBy="pessoas")
	 * @ORM\JoinTable(name="pessoa_indicador")
	 */
	private $indicadores;

	/**
	 * One Product has Many Features.
	 * @ORM\OneToMany(targetEntity="Indicador", mappedBy="responsavel")
	 */
	private $indicadoresResponsavel;

	/**
	 * Pessoa constructor.
	 */
	public function __construct()
	{
		$this->tarefas = new ArrayCollection();
		$this->cargos = new ArrayCollection();
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
     * @return Pessoa
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
