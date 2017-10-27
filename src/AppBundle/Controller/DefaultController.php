<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Procedimento;
use AppBundle\Entity\Setor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $numberItem = 12;
        $pacientes = $this->getDoctrine()->getRepository(Procedimento::class )->findBy([],['setor'=>'ASC','id'=>'DESC']);
        $pages = ceil(count($pacientes)/$numberItem);
        return $this->render('@App/Default/pacientes.html.twig',['acompanhamentos'=>$pacientes,'pages'=>$pages,'number_item'=>$numberItem]);
    }

    /**
     * @Route("/atualiza", name="atualiza")
     */
    public function atualizaPacientesAction(Request $request){
        $numberItem = 12;
        $pacientes = $this->getDoctrine()->getRepository(Procedimento::class )->findBy([],['setor'=>'ASC','id'=>'DESC']);
        $pages = ceil(count($pacientes)/$numberItem);
        return $this->render('@App/Default/pacientes.html.twig',['acompanhamentos'=>$pacientes,'pages'=>$pages,'number_item'=>$numberItem]);
    }
}
