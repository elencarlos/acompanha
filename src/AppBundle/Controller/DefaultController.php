<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Procedimento;
use AppBundle\Entity\Setor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $pacientes = $this->getDoctrine()->getRepository(Procedimento::class )->findBy([],['setor'=>'ASC','id'=>'DESC']);
        return $this->render('@App/Default/index.html.twig',['acompanhamentos'=>$pacientes]);
    }
}
