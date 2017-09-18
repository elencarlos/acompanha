<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Setores;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ProcedimentoAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('nome')
            ->add('paciente.nome')
//            ->add('setor.nome')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $set = $this->modelManager->findBy('AppBundle:Setor');
        $setores = [];
        foreach ($set as  $s){
            $setores[$s->getId()] = $s->getNome();
        }

        $listMapper
            ->add('id')
            ->add('nome','string',array('label'=>'Procedimento'))
            ->add('tempoEstimado')
            ->addIdentifier('paciente.nome','string', ['label' => 'Nome do Paciente'])
            ->add('setor', 'choice', array(
                    'editable' => true,
                    'class' => 'AppBundle:Setor',
                    'choices'  => $setores,
                    'associated_property'=>'nome',
                    'label' => 'Nome do Setor'
                )
            )
            ->add('_action', null, array(
                'label' =>'Ações',
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
            ->add('nome')
            ->add('tempoEstimado')
            ->add('paciente', 'sonata_type_model', array(
                'class'    => 'AppBundle:Paciente',
                'property' => 'nome'
            ))
            ->add('setor', 'sonata_type_model', array(
                'class'    => 'AppBundle:Setor',
                'property' => 'nome'
            ));
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
            ->add('setor.nome');
    }
}
