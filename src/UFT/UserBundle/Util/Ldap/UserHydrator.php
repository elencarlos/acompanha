<?php

namespace UFT\UserBundle\Util\Ldap;

use Symfony\Component\Config\Definition\Exception\Exception;
use UFT\AnaliseBundle\Entity\Estudante;
use FR3D\LdapBundle\Hydrator\HydratorInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use UFT\UserBundle\Entity\User;

class UserHydrator implements HydratorInterface
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * Popula um usuário com informações do LDAP
     *
     * @param array $entradaLdap Informação do LDAP como Array Multidimensional.
     *
     * @return UserInterface
     */
    public function hydrate(array $entradaLdap)
    {
        $usuario = new User();
        try{
            $usuario->setUsername($entradaLdap['uid'][0]);
            $usuario->setFirstName($entradaLdap['cn'][0]);
            $usuario->setLastName($entradaLdap['sn'][0]);
            foreach ($entradaLdap['mail'] as $mail){
                if ((strpos($mail, '@uft') !== false || strpos($mail, '@mail.uft') !== false) ) {
                    $usuario->setEmail($mail);
                    break;
                }
            }
            $usuario->setEnabled(true);
            if (array_key_exists("schacdateofbirth", $entradaLdap)) $usuario->setDateOfBirth(\DateTime::createFromFormat('dmY', $entradaLdap['schacdateofbirth'][0]));
            $usuario->setPassword("");
            $usuario->addRole('ROLE_USER');
            if (array_key_exists("telephonenumber", $entradaLdap)) $usuario->setPhone($entradaLdap['telephonenumber'][0]);
            array_key_exists("brpersoncpf", $entradaLdap) ? $usuario->setCpf($entradaLdap['brpersoncpf'][0]) : $usuario->setCpf($entradaLdap['cpf'][0]);
            if(!isset($entradaLdap['idpessoa']))
                return $this->hydrateException();
            $usuario->setIdPessoa($entradaLdap['idpessoa'][0]);
            if(isset($entradaLdap['aluno']) && $entradaLdap['aluno'][0] == 1){
                $usuario->setFlagEstudante(true);
                $usuario->addRole('ROLE_ESTUDANTE');

            }
            return $usuario;
        }catch (\ErrorException $e) {
           return $this->hydrateException();
        }

    }

    public function hydrateException()
    {
        $session = $this->container->get('session');
        $session->getFlashBag()->add('warning', 'Certifique-se de ter feito o recadastramento no SLU para prosseguir. <a href="https://sistemas.uft.edu.br/slu/login">Clique aqui para ir para o SLU</a>');
        return null;
    }
}
