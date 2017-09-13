<?php

namespace UFT\PdiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoria
 *
 * @ORM\Table(name="categoria")
 * @ORM\Entity(repositoryClass="UFT\PdiBundle\Repository\CategoriaRepository")
 */
class Categoria
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
	 * Many Users have Many Groups.
	 * @ORM\ManyToMany(targetEntity="Tarefa", inversedBy="departamentos")
	 * @ORM\JoinTable(name="tarefa_categoria")
	 */
	private $tarefas;

	/**
	 * Many Features have One Product.
	 * @ORM\ManyToOne(targetEntity="PDI", inversedBy="categorias")
	 * @ORM\JoinColumn(name="pdi_id", referencedColumnName="id")
	 */
	private $pdi;

	/**
	 * One Category has Many Categories.
	 * @ORM\OneToMany(targetEntity="Categoria", mappedBy="pai")
	 */
	private $filhos;

	/**
	 * Many Categories have One Category.
	 * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="filhos")
	 * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
	 */
	private $pai;

	/**
	 * Categoria constructor.
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
     * @return Categoria
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
}
