<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Setor
 *
 * @ORM\Table(name="setor")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SetorRepository")
 */
class Setor
{
    const ENCAMINHADO = 4;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255)
     */
    private $nome;

    public function setId($id){
        $this->id = $id;
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
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getImageName(){
        $valor = strtolower(str_replace(" ","_",preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($this->nome)))));
        return $valor?$valor:"";
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->nome?$this->nome:"";
    }
}
