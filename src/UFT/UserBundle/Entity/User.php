<?php

namespace UFT\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use FR3D\LdapBundle\Model\LdapUserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="usuario")
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="password",
 *          column=@ORM\Column(
 *              name     = "pdi_password",
 *              type = "string"
 *          )
 *      ),
 *      @ORM\AttributeOverride(name="locale",
 *          column=@ORM\Column(
 *              name     = "pdi_locale",
 *              type = "string",
 *              length=8,
 *              nullable=true,
 *              options={"default" = null}
 *          )
 *      )
 *      }
 *     )
 */
class User extends BaseUser implements LdapUserInterface
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Ldap Object Distinguished Name
     * @var string $dn
     */
    private $dn;

    /**
     * @var string
     * @ORM\Column(name="nome", type="string", nullable=true)
     */
    private $gecos;

    /**
     * @var int
     * @ORM\Column(name="cpf", type="string", length=11, nullable=true)
     */
    private $cpf;

    /**
     * @var integer
     * @ORM\Column(name="idpessoa", type="integer", nullable=true)
     */
    private $idpessoa;

    /**
     * @var boolean
     * @ORM\Column(name="flag_estudante", type="boolean", nullable=true)
     */
    private $flagEstudante;


    public function __construct()
    {
        // Mantener esta línea para llamar al constructor
        // de la clase padre
        parent::__construct();
        $this->addRole('ROLE_USER');
    }


    /**
     * {@inheritDoc}
     */
    public function getDn()
    {
        return $this->dn;
    }

    /**
     * {@inheritDoc}
     */
    public function setDn($dn)
    {
        $this->dn = $dn;
    }

    function getIdPessoa()
    {
        return $this->idpessoa;
    }

    function setIdPessoa($idpessoa)
    {
        $this->idpessoa = $idpessoa;
    }

    function getId()
    {
        return $this->id;
    }


    function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return string
     */
    public function getGecos()
    {
        return $this->gecos;
    }

    /**
     * @param string $gecos
     */
    public function setGecos($gecos)
    {
        $this->gecos = $gecos;
    }

    /**
     * @return int
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param int $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    /**
     * @return bool
     */
    public function isFlagEstudante()
    {
        return $this->flagEstudante;
    }

    /**
     * @param bool $flagEstudante
     */
    public function setFlagEstudante($flagEstudante)
    {
        $this->flagEstudante = $flagEstudante;
    }

    function __toString()
    {
        return (string)$this->username;
    }


}
