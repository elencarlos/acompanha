<?php

namespace UFT\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use FR3D\LdapBundle\Model\LdapUserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="usuario",
 * uniqueConstraints={@ORM\UniqueConstraint(name="usuario_cpf_unique", columns={"cpf"})}
 * )
 */
class Usuario extends BaseUser implements LdapUserInterface
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
     * @ORM\Column(name="first_name", type="string", nullable=true)
     */
    private $firstName;

    /**
     * @var string
     * @ORM\Column(name="last_name", type="string", nullable=true)
     */
    private $lastName;

    /**
     * @var string
     * @ORM\Column(name="nome", type="string", nullable=true)
     */
    private $gecos;

    /**
     * @var int
     * @ORM\Column(name="cpf", type="bigint", columnDefinition="BIGINT(11) UNSIGNED ZEROFILL")
     */
    private $cpf;

    /**
     * @var integer
     * @ORM\Column(name="idpessoa", type="integer", nullable=true)
     */
    private $idpessoa;


    public function __construct()
    {
        // Mantener esta línea para llamar al constructor
        // de la clase padre
        parent::__construct();
        $this->addRole('ROLE_USER');
    }

    /**
     * @return int
     */
    public function getIddocente()
    {
        return $this->iddocente;
    }

    /**
     * @param int $iddocente
     */
    public function setIddocente($iddocente)
    {
        $this->iddocente = $iddocente;
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

    function getIdpessoa()
    {
        return $this->idpessoa;
    }

    function setIdpessoa($idpessoa)
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
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
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
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * @param int $matricula
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
    }

    /**
     * @return int
     */
    public function getIsProfessor()
    {
        return $this->isProfessor;
    }

    /**
     * @return int
     */
    public function IsProfessor()
    {
        return $this->isProfessor;
    }
    /**
     * @param int $isProfessor
     */
    public function setIsProfessor($isProfessor)
    {
        $this->isProfessor = $isProfessor;
    }

    /**
     * @return int
     */
    public function getIsAluno()
    {
        return $this->isAluno;
    }

    /**
     * @return int
     */
    public function IsAluno()
    {
        return $this->isAluno;
    }

    /**
     * @param int $isAluno
     */
    public function setIsAluno($isAluno)
    {
        $this->isAluno = $isAluno;
    }

    /**
     * @return int
     */
    public function getIsFuncionario()
    {
        return $this->isFuncionario;
    }

    /**
     * @return int
     */
    public function IsFuncionario()
    {
        return $this->isFuncionario;
    }

    /**
     * @param int $isFuncionario
     */
    public function setIsFuncionario($isFuncionario)
    {
        $this->isFuncionario = $isFuncionario;
    }

    /**
     * @return bigint
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param bigint $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }



    function __toString()
    {
        return $this->username;
    }


}
