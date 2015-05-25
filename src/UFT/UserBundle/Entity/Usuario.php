<?php

namespace UFT\UserBundle\Entity;

use FR3D\LdapBundle\Model\LdapUserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Usuario")
 */
class Usuario extends BaseUser implements LdapUserInterface {

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
     * @var integer
     * @ORM\Column(name="idpessoa", type="integer")
     */
    private $idpessoa;


    public function __construct() {
        // Mantener esta línea para llamar al constructor
        // de la clase padre
        parent::__construct();
        $this->addRole('ROLE_USER');
    }

    /**
     * {@inheritDoc}
     */
    public function setDn($dn) {
        $this->dn = $dn;
    }

    /**
     * {@inheritDoc}
     */
    public function getDn() {
        return $this->dn;
    }

    function getIdpessoa() {
        return $this->idpessoa;
    }

    function setIdpessoa($idpessoa) {
        $this->idpessoa = $idpessoa;
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

}
