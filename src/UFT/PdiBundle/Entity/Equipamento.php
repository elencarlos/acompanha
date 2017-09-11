<?php

namespace UFT\PdiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipamento
 *
 * @ORM\Table(name="equipamento")
 * @ORM\Entity(repositoryClass="UFT\PdiBundle\Repository\EquipamentoRepository")
 */
class Equipamento
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
     * @ORM\Column(name="patrimonio", type="string", length=45)
     */
    private $patrimonio;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="text")
     */
    private $descricao;

	/**
	 * Many Features have One Product.
	 * @ORM\ManyToOne(targetEntity="Tarefa", inversedBy="equipamentos")
	 * @ORM\JoinColumn(name="tarefa_id", referencedColumnName="id")
	 */
	private $tarefa;

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
     * Set patrimonio
     *
     * @param string $patrimonio
     * @return Equipamento
     */
    public function setPatrimonio($patrimonio)
    {
        $this->patrimonio = $patrimonio;

        return $this;
    }

    /**
     * Get patrimonio
     *
     * @return string 
     */
    public function getPatrimonio()
    {
        return $this->patrimonio;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     * @return Equipamento
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
}
