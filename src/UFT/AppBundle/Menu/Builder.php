<?php

namespace UFT\AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware {

    public function mainMenu(FactoryInterface $factory, array $options) {
        $menu = $factory->createItem('root');

        $menu->setChildrenAttribute('class', 'sidebar-menu');
        $menu->addChild('Ações')->setAttribute('class', 'header');
//        $menu->addChild('Ficha Catalográfica', array('route' => 'projeto_ficha_ficha'))->setAttribute('class', '');
        if ($this->container->get('security.context')->isGranted(array('ROLE_ADMIN', 'ROLE_USER'))) {

//            $menu->addChild('Cadastrar Campus' ,array('route' => 'campus'))->setAttribute('class', '')->setAttribute('icon', 'fa fa-file-text-o');
//
//
//
//            $menu->addChild('Cadastrar Campus', array('route' => 'campus'))->setAttribute('class', '')->setAttribute('icon', 'fa fa-university');
//
//            $menu->addChild('Cadastrar Programas e Cursos', array('route' => 'programacurso'))->setAttribute('icon', 'fa fa-graduation-cap');
//
//            $menu->addChild('Cadastrar Tipos de Programas', array('route' => 'tipoprogramacurso'))->setAttribute('icon', 'fa fa-plus-square');
//
//            $menu->addChild('Cadastrar Tipos de trabalho', array('route' => 'tipotrabalho'))->setAttribute('icon', 'fa fa-plus-square');


        }

//        $menu->addChild('Projects', array('route' => 'campus'))
//                ->setAttribute('icon', 'glyphicon glyphicon-list');
//
//        $menu->addChild('Campus', array('route' => 'campus'))
//                ->setAttribute('icon', 'icon-group');

        return $menu;
    }

    public function userMenu(FactoryInterface $factory, array $options) {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav pull-right navbar-nav');

        $username = "Visitante";
        if (is_object($this->container->get('security.context')->getToken()->getUser())) {
            $username = $this->container->get('security.context')->getToken()->getUser()->getUserName();
        }
        $menu->addChild('User', array('label' => 'Olá ' . $username))
                ->setAttribute('dropdown', true)
                ->setAttribute('icon', 'glyphicon glyphicon-user');


        if ($this->container->get('security.context')->isGranted(array('ROLE_ADMIN', 'ROLE_USER'))) {
            $menu['User']->addChild('Alterar perfil', array('route' => 'fos_user_profile_show'))
                    ->setAttribute('icon', 'glyphicon glyphicon-edit');
             if ($this->container->get('security.context')->isGranted(array('ROLE_ADMIN'))) {
                 $menu['User']->addChild('Cadastrar Usuário', array('route' => 'fos_user_registration_register'))
                    ->setAttribute('icon', 'glyphicon glyphicon-plus');
             }
            $menu['User']->addChild('Sair', array('route' => 'fos_user_security_logout'))
                    ->setAttribute('icon', 'glyphicon glyphicon-log-out');
        } else {
            $menu['User']->addChild('Entrar', array('route' => 'fos_user_security_login'))
                    ->setAttribute('icon', 'glyphicon glyphicon-log-in');
        }

        return $menu;
    }

}
