<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ProcedimentoAdmin extends AbstractAdmin
{

    protected $translationDomain = 'AppBundle';
    protected $baseRoutePattern = 'pct';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('paciente');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $set     = $this->modelManager->findBy('AppBundle:Setor');
        $setores = [];
        foreach ($set as $s) {
            $setores[$s->getId()] = $s->getNome();
        }

        $listMapper
//            ->add('id')

            ->add('paciente', 'string', ['label' => 'Nome do Paciente'])
            ->add('setor', 'choice', array(
                    'editable'            => true,
                    'class'               => 'AppBundle:Setor',
                    'choices'             => $setores,
                    'associated_property' => 'name',
                    'label'               => 'Nome do Setor'
                )
            )
//            ->add('nome', 'text', array('label' => 'Descrição Procedimento(Observações)'))
//            ->add('tempoEstimado')
            ->add('_action', null, array(
                'label'   => 'Ações',
                'actions' => array(
                    'edit'   => array(),
                    'delete' => array(),
                ),
            ));
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('paciente', 'text', ['label' => 'Nome do Paciente','required' => false])
            ->add('setor', EntityType::class, array(
                'class'    => 'AppBundle:Setor',
                'property' => 'nome',
                'required' => false
            ))
//            ->add('tempoEstimado','text',['required' => false])
//            ->add('nome', 'text', ['label' => 'Descrição Procedimento(Observações)','required' => false])
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('nome')
            ->add('tempoEstimado')
            ->add('paciente.nome')
            ->add('setor.name');
    }

    protected function configureRoutes(RouteCollection  $collection)
    {
    }

    public function getBatchActions()
    {
        $actions = parent::getBatchActions();
        unset($actions['delete']);

        return $actions;
    }
}
