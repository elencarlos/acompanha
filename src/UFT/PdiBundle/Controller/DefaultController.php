<?php

namespace UFT\PdiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        //return $this->render('PdiBundle:Default:index.html.twig');
        return $this->redirectToRoute('sonata_admin_dashboard');
    }

    /**
     * @Route("/login")
     */
    public function loginAction()
    {
        return $this->redirectToRoute('sonata_admin_dashboard');
    }

}
