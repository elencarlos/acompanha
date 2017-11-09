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
    const NUMBER_ITEMS = 12;
    const TOTAL_LIMIT = 12*3;
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $pacientes = $this->getDoctrine()->getRepository(Procedimento::class )->findBy([],['setor'=>'ASC','id'=>'DESC'],self::TOTAL_LIMIT);
        $pages = ceil(count($pacientes)/self::NUMBER_ITEMS);
        return $this->render('@App/Default/pacientes.html.twig',['acompanhamentos'=>$pacientes,'pages'=>$pages,'number_item'=>self::NUMBER_ITEMS]);
    }

    /**
     * @Route("/atualiza", name="atualiza")
     */
    public function atualizaPacientesAction(Request $request){
        $pacientes = $this->getDoctrine()->getRepository(Procedimento::class )->findBy([],['setor'=>'ASC','id'=>'DESC'],self::TOTAL_LIMIT);
        $pages = ceil(count($pacientes)/self::NUMBER_ITEMS);
        return $this->render('@App/Default/pacientes.html.twig',['acompanhamentos'=>$pacientes,'pages'=>$pages,'number_item'=>self::NUMBER_ITEMS]);
    }
}
