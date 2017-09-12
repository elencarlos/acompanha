<?php

namespace UFT\PdiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UG
 *
 * @ORM\Table(name="ug")
 * @ORM\Entity(repositoryClass="UFT\PdiBundle\Repository\UGRepository")
 */
class UG
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
	 * Many Features have One Product.
	 * @ORM\ManyToOne(targetEntity="Checklist", inversedBy="ugs")
	 * @ORM\JoinColumn(name="pdi_id", referencedColumnName="id")
	 */
	private $pdi;

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
     * @return UG
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
